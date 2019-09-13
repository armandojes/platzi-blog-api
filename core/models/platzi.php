<?php
class Platzi extends Model {

  private $html_raw;
  private $posts;
  private $primary;
  private $latest_post;

  public function get_comments ($url){
    $html_raw = file_get_contents("https://platzi.com/blog/$url");
    if ($html_raw === false) return false;

    //primer filtro
    $start_pos = strpos($html_raw, '<section class="CommentList"');

    // si no encunetra esta etiqueta esque no hay commentarios en el post
    if (!$start_pos) return '';
    $end_pos = strrpos($html_raw, '</section></div></div></div><section class="RelatedPosts');
    $length = ($end_pos - $start_pos);
    $html_raw = substr($html_raw,$start_pos, ($length - 32));
    return parser_comments($html_raw);
  }

  // public functions
  public function get_posts($page = 1){
    if (($page != 1) || !$this->posts){
      $this->load_data($page);
    }

    return $this->posts;
  }

  public function get_primary(){
    if (!$this->primary) $this->load_data(1);
    $data = $this->primary;
    $data['created_at'] = strtotime($data['created_at']);
    return $data;
  }

  public function get_latest_post(){
    if (!$this->latest_post) $this->load_data(1);
    return $this->latest_post['created_at'];
  }

  public function merge_post ($post_primary){
    $post_single = $this->get_post($post_primary['slug']);
    $post_full_data = [
      'title' => $post_primary['title'],
      'author_id' => $post_primary['author_id'],
      'votes' => (int) $post_primary['n_stars'],
      'comments' => (int) $post_primary['n_responses'],
      'username' => $post_single['username'],
      'avatar' => $post_single['avatar'],
      'points' => $post_single['points'],
      'course' => $post_single['course'],
      'body' => $post_single['body'],
      'id_platzi' => $post_primary['id'],
      'created_at' => $post_primary['created_at'],
      'cover' => $post_primary['cover_image'],
      'url' => $post_primary['slug'],
      'description' => $post_primary['content'],
    ];

    return $post_full_data;
  }

  public function get_post ($url){
    $Dom = new simple_html_dom();
    $html_raw = file_get_contents("https://platzi.com/blog/$url");
    $Dom->load($html_raw);
    $data = [];
    $data['title'] = $Dom->find('h1.Discussion-title-text')[0]->innertext;
    $user = $Dom->find('div.DiscussionInfo-content')[0];
    $data['username'] = $user->find('a')[0]->innertext;
    $data['avatar'] = !empty($user->find('img')[0]->attr['data-cfsrc']) ? $user->find('img')[0]->attr['data-cfsrc'] : $user->find('img')[0]->attr['src'];
    $data['course'] = !empty($Dom->find('a.CourseBanner-url')[0]->outertext) ? $Dom->find('a.CourseBanner-url')[0]->outertext : null;
    $data['points'] = $user->find('span')[0]->innertext;
    //obtener solo body
    $position_start =  strpos($html_raw, '<body>');
    $lenght =  (strrpos($html_raw, '</body>') - $position_start);
    $html_raw = substr($html_raw, $position_start, $lenght + 7);

    //obtener section primary
    $position_start =  strpos($html_raw, '<section');
    $lenght =  (strrpos($html_raw, '</section>') - $position_start);
    $html_raw = substr($html_raw, $position_start + 10, $lenght - 10);

    //siguente  section con etiquetas
    $position_start =  strpos($html_raw, '<section');
    $lenght =  (strrpos($html_raw, '</section>') - $position_start);
    $html_raw = substr($html_raw, $position_start , $lenght);


    //eliminar segundo seccions hermano
    $lenght =  strrpos($html_raw, '<section');
    $html_raw = substr($html_raw,0, $lenght);


    //eliminar div hermano
    $lenght =  strrpos($html_raw, '<div class="DiscusionDetail-comments"');
    $html_raw = substr($html_raw,0, $lenght);


    //obtener ultimo div
    $position_start =  strrpos($html_raw, '<div class="MainDiscussion-body"');
    $html_raw = substr($html_raw,$position_start, -10);

    //obtener solo el contenido
    $position_start =  strpos($html_raw, '<div class="Discussion-content"');
    $lenght =  (strrpos($html_raw, '</div><div class="col-md-1"') - $position_start);
    $html_raw = substr($html_raw, $position_start, $lenght);

    //quitar ultimo class
    $html_raw = str_replace('class="Discussion-content"', '', $html_raw);

    //agregar al array
    $data['body'] = $html_raw;

    return $data;
  }


  //private functions
  private function load_data ($page){
    $this->html_raw = file_get_contents("https://platzi.com/blog/?contribution_filter=new&contribution_page=$page&search=");
    $data = $this->parse();
    [$items, $primary] = $this->filter_posts($data['initialState']['entities']['contributions'], $data['initialState']['order']);
    $this->posts = $items;
    $this->primary = $primary;
    if ($page == 1) {
      $this->latest_post = $this->posts[0];
    }
  }

  private function parse (){
    $position_start = strrpos($this->html_raw, '{"initialProps"');
    $html_prepare = substr ($this->html_raw, $position_start);
    $position_end = strrpos($html_prepare, '</script><script type="application/json" id="user">');
    $html_prepare = substr ($this->html_raw , $position_start, $position_end);
    $data_joson = json_decode($html_prepare, true);
    return $data_joson;

  }

  private function filter_posts($posts, $order){
    $post_filter = [];
    $post_destacado = null;
    foreach ($posts as $post) {
      if (in_array($post['id'], $order)){
        $post['created_at'] = strtotime($post['created_at']);
        array_push($post_filter, $post);
      } else {
        $post_destacado = $post;
      }
    }
    return [$post_filter, $post_destacado];
  }
}

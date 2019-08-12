<?php
class Platzi extends Model {

  private $html_raw;
  private $posts;
  private $primary;
  private $latest_post;

  // public functions
  public function get_posts($page = 1){
    if (($page != 1) || !$this->posts){
      $this->load_data($page);
    }

    return $this->posts;
  }

  public function get_primary(){
    if (!$this->primary) $this->load_data(1);
    return $this->primary;
  }

  public function get_latest_post(){
    if (!$this->latest_post) $this->load_data(1);
    return $this->latest_post;
  }

  public function merge_post ($post_primary){
    $post_single = $this->get_post($post_primary['slug']);
    $post_full_data = [
      'title' => $post_primary['title'],
      'votes' => (int) $post_single['votes'],
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
    $data['votes'] = $Dom->find('div.MainDiscussion-top')[0]->find('span.Star-number')[0]->innertext;
    $user = $Dom->find('div.DiscussionInfo-content')[0];
    $data['username'] = $user->find('a')[0]->innertext;
    $data['avatar'] = !empty($user->find('img')[0]->attr['data-cfsrc']) ? $user->find('img')[0]->attr['data-cfsrc'] : $user->find('img')[0]->attr['src'];
    $data['points'] = $user->find('span')[0]->innertext;
    $data['course'] = !empty($Dom->find('a.CourseBanner-url')[0]->outertext) ? $Dom->find('a.CourseBanner-url')[0]->outertext : null;
    $data['body'] = $Dom->find('div.Discussion-content')[0]->innertext;
    $data['coments'] = !empty($Dom->find('section.CommentList')[0]->outertext) ? $Dom->find('section.CommentList')[0]->outertext : null;
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
        array_push($post_filter, $post);
      } else {
        $post_destacado = $post;
      }
    }
    return [$post_filter, $post_destacado];
  }


}

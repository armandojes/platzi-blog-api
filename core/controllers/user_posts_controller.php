<?php {

  class user_posts_controller extends controller {

    public function execute (){
      $Post = new Post();

      $page = (int) $this->params->page;

      $user_posts = $Post->get_posts_user($this->params->username, $page);
      $num_items = $Post->get_num_items_user($this->params->username);
      $num_pages = $Post->get_num_pages_user($this->params->username);

      $this->response([
        'num_pages' => $num_pages,
        'num_items' => $num_items,
        'error' => $user_posts === false ? true : false,
        'items' => $user_posts === false ? [] : $user_posts,
        'error_descript' => $user_posts === false ? 'error interno del servidor' : '',
      ]);

    }

  }

}

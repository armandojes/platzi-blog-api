<?php

class search_controller extends controller {

  public function execute (){
    $Post = new Post();
    $page = (int) $this->params->page;
    $query = $this->params->query;

    $posts_list = $Post->search($query, $page);
    $num_items = $Post->search_num_items($query);
    $num_pages = $Post->search_num_pages($num_items);

    $this->response([
      'error' => false,
      'error_message' => '',
      'items' => $posts_list ? $posts_list : [],
      'num_pages' => $num_pages,
      'num_items' => $num_items,
    ]);
  }

}

<?php


class posts_populars_controller extends controller{

  public function execute (){

    $Post = new Post();

    $posts_list = $Post->get_list_popular($this->params->page);
    $num_pages = $Post->get_num_pages();
    $num_items = $Post->get_num_items();


    $this->response([
      'items' => $posts_list,
      'num_pages' => $num_pages,
      'num_items' => $num_items,
      'error' => empty($posts_list) ? true : false,
      'error_descript' => empty($posts_list) ? 'error interno del servidor' : '',
    ]);

  }


}

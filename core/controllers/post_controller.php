<?php

class post_controller extends controller {
  public function execute (){

    $Post = new Post();

    $post = $Post->get_post_primary_full();
    $post = $this->params->url === $post['url']
      ? $post
      : $Post->get_single($this->params->url);


    $this->response([
      'error' => $post ? false : true,
      'error_message' => $post ? '' : 'error 404 post no encontrado',
      'data' => $post ? $post : [],
    ]);

  }

}

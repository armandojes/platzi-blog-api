<?php

class comments_controller extends controller {

  public function execute (){

    $Post = new Post();

    $post = $Post->get_post_primary_full();
    $comments = $this->params->url === $post['url']
     ? $Post->get_comments_primary()
     : $Post->get_comments($this->params->url);

    $this->response([
      'error' => $comments === false ? true : false,
      'error_message' => $comments === false ? 'error 404 comment not found' : '',
      'data' => $comments === false ? '' : $comments['comments'],
    ]);
  }
}


// $post = $Post->get_post_primary_full();
// $post = $this->params->url === $post['url']
//   ? $post
//   : $Post->get_single($this->params->url);

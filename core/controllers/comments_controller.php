<?php

class comments_controller extends controller {

  public function execute (){

    $comments = get_coments($this->params->url);


    $this->response([
      'error' => $comments === false ? true : false,
      'error_message' => $comments === false ? 'error 404 comment not found' : '',
      'data' => $comments === false ? '' : $comments,
    ]);

  }
}


// $Post = new Post();
//
// $post = $Post->get_post_primary_full();
// $comments = $this->params->url === $post['url']
//  ? $Post->get_comments_primary()
//  : $Post->get_comments($this->params->url);
//
// $this->response([
//   'error' => $comments === false ? true : false,
//   'error_message' => $comments === false ? 'error 404 comment not found' : '',
//   'data' => $comments === false ? '' : $comments['comments'],
// ]);

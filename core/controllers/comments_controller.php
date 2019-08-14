<?php

class comments_controller extends controller {

  public function execute (){

    $Post = new Post();
    $comments = $Post->get_comments($this->params->url);

    $this->response([
      'error' => $comments === false ? true : false,
      'error_message' => $comments === false ? 'error 404 comment not found' : '',
      'data' => $comments === false ? '' : $comments['comments'],
    ]);
  }
}

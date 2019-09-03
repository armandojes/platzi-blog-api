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

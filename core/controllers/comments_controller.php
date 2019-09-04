<?php

class comments_controller extends controller {

  public function execute (){
    $Platzi = new Platzi();

    $comments = $Platzi->get_comments($this->params->url);
    $comments = $comments ? filter($comments) : $comments;

    $this->response([
      'error' => $comments === false ? true : false,
      'error_message' => $comments === false ? 'error 404 comment not found' : '',
      'data' => $comments === false ? '' : $comments,
    ]);

  }
}

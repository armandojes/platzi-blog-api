<?php

class postsprimary_controller extends controller {
  public function execute (){

    $Post = new Post();

    $post_primary = $Post->get_post_primary();

    $this->response([
      'error' => false,
      'error_message' => '',
      'data' => $post_primary,
    ]);
  }

}

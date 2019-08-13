<?php

class update_controller extends controller {
  public function execute (){

    $Platzi = new Platzi();
    $Post = new Post();
    $Sync = new Sync();

    $lates_date_platzi = $Platzi->get_latest_post();
    $latest_date_local = $Post->get_latest();
    if ($lates_date_platzi <= $latest_date_local) return false;
    $posts_nuevos = [];
    $Posts_platzi = $Platzi->get_posts();
    foreach ($Posts_platzi as $post_platzi) {
      if ($post_platzi['created_at'] <= $latest_date_local) break;
      array_push ($posts_nuevos, $Platzi->merge_post($post_platzi));
    }

    //insert database
    $posts_nuevos = array_reverse($posts_nuevos);
    foreach ($posts_nuevos as $post_nuevos) {
      $Post->create($post_nuevos);
    }

  }
}

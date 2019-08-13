<?php

class update_controller extends controller {
  public function execute (){

    $Platzi = new Platzi();
    $Post = new Post();
    $Sync = new Sync();

    $lates_date_platzi = $Platzi->get_latest_post();
    $latest_date_local = $Post->get_latest();
    $Posts_platzi = $Platzi->get_posts();

    if ($lates_date_platzi > $latest_date_local) {
      $posts_nuevos = [];
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

    //post primary
    $primary_post_platzi = $Platzi->get_primary();
    $local_post_primary = $Post->get_post_primary();
    if ($local_post_primary['created_at'] != $primary_post_platzi['created_at']){
      $full_primary_post_platzi = $Platzi->merge_post($primary_post_platzi);
      $Post->update_primary($full_primary_post_platzi);
    }

  }
}

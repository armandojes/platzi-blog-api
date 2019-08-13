<?php

class Sync extends Model {

  public function copy_page($page){
    $Platzi = new Platzi();
    $Post = new Post();

    $posts = array_reverse($Platzi->get_posts($page));
    foreach ($posts as $post) {
      $full_post = $Platzi->merge_post($post);
      $Post->create($full_post);
    }
  }

  public function update_sync () {
    $state = $this->Connect->set("UPDATE sync SET latest = '$this->date' WHERE id = 1");
    return $state;
  }

  public function time_past (){
    $latest = $this->Connect->fetch("SELECT latest FROM sync WHERE id = 1 LIMIT 1");
    $latest = (int) $latest['latest'];
    $diff_seconds = $this->date - $latest;
    return $diff_seconds > 3600 ? true : false;
  }


}

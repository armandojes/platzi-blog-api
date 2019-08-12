<?php

class Post extends Model {
  private $result_for_page;


  public function create ($data){
    $title = $this->prepare($data['title']);
    $votes = $this->prepare($data['votes']);
    $username = $this->prepare($data['username']);
    $avatar = $this->prepare($data['avatar']);
    $points = $this->prepare($data['points']);
    $course = $this->prepare($data['course']);
    $body = $this->prepare($data['body']);
    $id_platzi = $this->prepare($data['id_platzi']);
    $created_at = $this->prepare($data['created_at']);
    $cover = $this->prepare($data['cover']);
    $url = $this->prepare($data['url']);
    $description = $this->prepare($data['description']);

    $id_created = $this->Connect->create("INSERT INTO posts (title, votes, username, avatar, points, course, body, id_platzi, created_at, cover, url, description) VALUES ('$title',$votes,'$username','$avatar',$points,'$course','$body',$id_platzi,'$created_at','$cover','$url','$description')");
    return $id_created;
  }

  public function copy_page($page){
    $Platzi = new Platzi();
    $posts = array_reverse($Platzi->get_posts($page));
    foreach ($posts as $post) {
      $full_post = $Platzi->merge_post($post);
      $this->create($full_post);
    }
  }

  public function get_list ($page = 1){
    
  }
}

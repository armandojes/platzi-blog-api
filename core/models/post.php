<?php

class Post extends Model {
  private $itemsforpage = 10;


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



  public function get_list ($page = 1){
    $this->set_list(true);
    $initialfetch = (($page - 1) * $this->itemsforpage);
    $posts = $this->fetch("SELECT id, title, votes, username,avatar, points, created_at, url, description FROM posts ORDER BY id DESC LIMIT $initialfetch, $this->itemsforpage ");
    return $posts;
  }


  public function get_num_items (){
    $data = $this->Connect->fetch("SELECT id FROM posts");
    return count($data);
  }

  public function get_num_pages (){
    $count = $this->get_num_items();
    $count = ($count / $this->itemsforpage);
    return (int) ceil($count);
  }

  public function get_latest (){
    $post_latest = $this->Connect->fetch("SELECT created_at FROM posts ORDER BY id DESC LIMIT 1");
    return (int) $post_latest['created_at'];
  }
}

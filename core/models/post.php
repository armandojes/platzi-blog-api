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
    $comments = $this->prepare($data['comments']);
    $author_id = $this->prepare($data['author_id']);

    $id_created = $this->Connect->create("INSERT INTO posts (title, votes, username, author_id, avatar, points, course, body, comments, id_platzi, created_at, cover, url, description) VALUES ('$title',$votes,'$username','$author_id','$avatar',$points,'$course','$body','$comments',$id_platzi,'$created_at','$cover','$url','$description')");
    return $id_created;
  }

  public function get_list ($page = 1){
    $this->set_list(true);
    $initialfetch = (($page - 1) * $this->itemsforpage);
    $posts = $this->fetch("SELECT id, title, votes, username,avatar, points, created_at, url, description, cover, author_id, comments FROM posts ORDER BY id DESC LIMIT $initialfetch, $this->itemsforpage ");
    return $posts;
  }

  public function get_list_popular ($page = 1){
    $this->set_list(true);
    $initialfetch = (($page - 1) * $this->itemsforpage);
    $posts = $this->fetch("SELECT id, title, votes, username,avatar, points, created_at, url, description, cover, author_id, comments FROM posts ORDER BY votes DESC LIMIT $initialfetch, $this->itemsforpage ");
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

  public function update_primary ($data){
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
    $comments = $this->prepare($data['comments']);
    $author_id = $this->prepare($data['author_id']);

    $state = $this->Connect->set("UPDATE post_primary SET title = '$title', votes = $votes, username = '$username', avatar = '$avatar', points = $points, course = '$course', body = '$body', comments = '$comments', id_platzi = $id_platzi, created_at = '$created_at', cover = '$cover', url = '$url', description = '$description', author_id = '$author_id'");
    return $state;
  }

  public function get_post_primary (){
    $data = $this->Connect->fetch("SELECT id, title, votes, username,avatar, points, created_at, url, description, cover, author_id, comments FROM post_primary WHERE id = 1");
    return $data;
  }

  public function get_post_primary_full (){
    $post = $this->Connect->fetch("SELECT * FROM post_primary WHERE id = 1");
    if (!$post) return false;
    $post['body'] = filter($post['body']);
    return $post;
  }

  public function search ($query, $page){
    $initialFetch = ($page -1) * $this->itemsforpage;
    $this->set_list(true);
    $posts_list = $this->Connect->fetch("SELECT id, title, votes, username, avatar, points, created_at, url, description, cover, author_id, comments, MATCH(title) AGAINST('$query') AS relevancia FROM posts WHERE MATCH(title) AGAINST('$query') ORDER BY relevancia DESC LIMIT $initialFetch,$this->itemsforpage");
    return $posts_list;
  }

  public function search_num_items ($query){
    $this->set_list(true);
    $posts_list = $this->Connect->fetch("SELECT id FROM posts WHERE MATCH(title) AGAINST('$query')");
    return $posts_list ? count($posts_list) : 0;

  }

  public function search_num_pages ($num_items){
    $count = ($num_items / $this->itemsforpage);
    return (int) ceil($count);
  }

  public function get_single($url){
    $post = $this->Connect->fetch("SELECT id, title, votes, username,avatar, points, created_at, url, description, body, cover, author_id, comments FROM posts WHERE url = '$url' LIMIT 1");
    if (!$post) return false;
    $post['body'] = filter($post['body']);
    return $post;
  }
}

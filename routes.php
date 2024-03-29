<?php
$Router = new Router();


$Router->get('/test', 'test_controller');
$Router->get('/clone', 'clone_controller');
$Router->get('/update', 'update_controller');
$Router->get('/posts/{page}', 'posts_controller');
$Router->get('/posts/popular/{page}', 'posts_populars_controller');
$Router->get('/postprimary', 'postsprimary_controller');
$Router->get('/search/{query}/{page}', 'search_controller');
$Router->get('/post/{url}', 'post_controller');
$Router->get('/comments/{url}', 'comments_controller');
$Router->get('/user/posts/{username}/{page}', 'user_posts_controller');


$Router->dispatch();

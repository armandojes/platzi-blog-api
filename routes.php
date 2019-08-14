<?php
$Router = new Router();


$Router->get('/test', 'test_controller');
$Router->get('/update', 'update_controller');
$Router->get('/posts/{page}', 'posts_controller');
$Router->get('/postprimary', 'postsprimary_controller');
$Router->get('/search/{query}/{page}', 'search_controller');
$Router->get('/post/{url}', 'post_controller');



$Router->dispatch();

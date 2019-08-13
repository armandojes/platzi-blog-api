<?php
$Router = new Router();


$Router->get('/test', 'test_controller');
$Router->get('/update', 'update_controller');
$Router->get('/posts/{page}', 'posts_controller');



$Router->dispatch();

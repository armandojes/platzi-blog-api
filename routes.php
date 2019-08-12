<?php
$Router = new Router();


$Router->get('/test', 'test_controller');
$Router->get('/state', 'state_controller');
$Router->get('/list', 'list_controller');
$Router->post('/save', 'save_controller');


$Router->dispatch();

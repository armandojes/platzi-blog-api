<?php
/*
* archvos de configuracion
*/
define('runtime','development' );  // development || production


header("Content-type: text/html");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers: Content-Type, *");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

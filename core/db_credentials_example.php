<?php
//rename this file to "db_credentials.php"
//define your credentials db 

if (runtime === 'production'){
  //define production database
  define('DB_NAME', '');
  define('DB_HOST', '');
  define('DB_USER','');
  define('DB_PASS', '');
  define('DB_CHARSET','utf8mb4');
} else {
  //define localhost database
  define('DB_NAME', 'localhost');
  define('DB_HOST', '');
  define('DB_USER','');
  define('DB_PASS', '');
  define('DB_CHARSET','utf8mb4');
}

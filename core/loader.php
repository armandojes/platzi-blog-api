<?php
require 'config.php';
require 'db_credentials.php';

//function
require 'functions/filter.php';

//system
require 'system/router.php';
require 'system/controller.php';
require 'system/connect.php';
require 'system/model.php';

//models
require 'models/Dom.php';
require 'models/Platzi.php';
require 'models/Post.php';
require 'models/Sync.php';

//controller
require 'controllers/test_controller.php';
require 'controllers/posts_controller.php';
require 'controllers/update_controller.php';
require 'controllers/postsprimary_controller.php';
require 'controllers/search_controller.php';
require 'controllers/post_controller.php';
require 'controllers/comments_controller.php';
require 'controllers/posts_populars_controller.php';


//routes
require 'routes.php';

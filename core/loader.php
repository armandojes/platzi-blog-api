<?php
require 'config.php';
require 'db_credentials.php';

//function
require 'functions/filter.php';
require 'functions/time_elapsed.php';
require 'functions/time_elapsed_list.php';
require 'functions/parser_comments.php';

//system
require 'system/router.php';
require 'system/controller.php';
require 'system/connect.php';
require 'system/model.php';

//models
require 'models/dom.php';
require 'models/platzi.php';
require 'models/post.php';
require 'models/sync.php';

//controller
require 'controllers/test_controller.php';
require 'controllers/posts_controller.php';
require 'controllers/update_controller.php';
require 'controllers/postsprimary_controller.php';
require 'controllers/search_controller.php';
require 'controllers/post_controller.php';
require 'controllers/comments_controller.php';
require 'controllers/posts_populars_controller.php';
require 'controllers/clone_controller.php';
require 'controllers/user_posts_controller.php';


//routes
require 'routes.php';

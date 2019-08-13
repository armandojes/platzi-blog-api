<?php
require 'config.php';

//system
require 'system/router.php';
require 'system/controller.php';
require 'system/connect.php';
require 'system/model.php';

//models
require 'models/dom.php';
require 'models/platzi.php';
require 'models/Post.php';
require 'models/Sync.php';

//controller
require 'controllers/test_controller.php';
require 'controllers/posts_controller.php';
require 'controllers/update_controller.php';
require 'controllers/postsprimary_controller.php';


//routes
require 'routes.php';

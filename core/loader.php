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

//controller
require 'controllers/test_controller.php';


//routes
require 'routes.php';

<?php

# Cors
require_once '../../cors.php';

require_once '../../utils/checkAuth.php';

# Controllers
require_once '../../controllers/users.php';
use Controller\Users\UserController;

UserController::getUserData();
<?php

# Cors
require_once '../../cors.php';

# Controllers
require_once '../../controllers/users.php';
use Controller\Users\UserController;

UserController::logout();
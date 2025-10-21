<?php

# Cors
require_once '../../cors.php';

require_once '../../utils/checkAuth.php';

# Controllers
require_once '../../controllers/books.php';
use Controller\Books\BookController;

BookController::getAllUserBooks();
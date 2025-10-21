<?php

# Cors
require_once '../../cors.php';

# Controllers
require_once '../../controllers/books.php';
use Controller\Books\BookController;

BookController::getBookLikes();
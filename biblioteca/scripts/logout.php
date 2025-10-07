<?php

if(session_status() === PHP_SESSION_ACTIVE){
    session_destroy();
}

header('Location: http://localhost/biblioteca/login.php');
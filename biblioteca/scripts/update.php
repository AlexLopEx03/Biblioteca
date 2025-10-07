<?php

require_once "connection.php";

try{
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    

    header('Location: http://localhost/biblioteca/dashboard.php');

}catch(InvalidArgumentException $error){
    $error = $error -> getMessage();
    echo "
        <script>
            alert('Error while updating book: $error')
            location = 'http://localhost/biblioteca/dashboard.php'
        </script>
    ";
}catch(Exception $error){
    echo "Fatal error, Unexpected error at login: $error";
}
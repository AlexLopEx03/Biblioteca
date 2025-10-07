<?php
require_once "connection.php";

try{
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    
    if(!$_POST['userName'] || strlen($_POST['userName']) < 3 || strlen($_POST['userName']) > 40){
        throw new InvalidArgumentException("Invalid user name");
    }

    if(!$_POST['userEmail'] || !filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL) || strlen($_POST['userEmail']) < 10 || strlen($_POST['userEmail']) > 200){
        throw new InvalidArgumentException("Invalid email");
    }

    if(!$_POST['userPassword'] || strlen($_POST['userPassword']) < 5 || strlen($_POST['userPassword']) > 40){
        throw new InvalidArgumentException("Invalid password");
    }

    $statement = $connection -> prepare(
    "INSERT INTO users(user_email, user_name, user_password) VALUES(?, ?, ?)"
    );

    $statement -> execute([
        $_POST['userEmail'],
        $_POST['userName'],
        password_hash($_POST['userPassword'], PASSWORD_DEFAULT)
    ]);

    echo "
        <script>
            alert('Register successfull')
            location = 'http://localhost/biblioteca/login.php'
        </script>
    ";

}catch(InvalidArgumentException $error){
    $error = $error -> getMessage();
    echo "
        <script>
            alert('Unexpected error at register: $error')
            location = 'http://localhost/biblioteca/register.php'
        </script>
    ";
}catch(Exception $error){
    echo "Fatal error, Unexpected error at register: $error";
}
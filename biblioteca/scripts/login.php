<?php
require_once "connection.php";

try{
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    if(!$_POST['userName'] || strlen($_POST['userName']) < 3 || strlen($_POST['userName']) > 40){
        throw new InvalidArgumentException("Invalid user name");
    }
    $_SESSION['userName'] = $_POST['userName'];

    if(!$_POST['userEmail'] || !filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL) || strlen($_POST['userEmail']) < 10 || strlen($_POST['userEmail']) > 200){
        throw new InvalidArgumentException("Invalid email");
    }

    if(!$_POST['userPassword'] || strlen($_POST['userPassword']) < 5 || strlen($_POST['userPassword']) > 40){
        throw new InvalidArgumentException("Invalid password");
    }

    $statement = $connection -> prepare(
    "SELECT id, user_email, user_password FROM users WHERE user_email = (?) AND user_name = (?)"
    );
    $statement -> execute([
        $_POST['userEmail'],
        $_POST['userName']
    ]);
    $result = $statement -> fetch(PDO::FETCH_ASSOC);

    if($result === false){
        throw new InvalidArgumentException("User does not exist");
    }

    if(!$result['id'] || !$result['user_email'] || !$result['user_password']){
        throw new InvalidArgumentException("User data incomplete");
    }

    if(!password_verify($_POST['userPassword'], $result['user_password'])){
        throw new InvalidArgumentException("Invalid password");
    }

    $_SESSION['userId'] = $result['id'];

    header('Location: http://localhost/biblioteca/dashboard.php');

}catch(InvalidArgumentException $error){
    $error = $error -> getMessage();
    echo "
        <script>
            alert('Unexpected error at login: $error')
            location = 'http://localhost/biblioteca/login.php'
        </script>
    ";
}catch(Exception $error){
    echo "Fatal error, Unexpected error at login: $error";
}
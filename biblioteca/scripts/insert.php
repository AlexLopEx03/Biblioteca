<?php

require_once "connection.php";

try{
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    $imageUrl = rand(0, 999000) . '_' .  $_FILES['image']['name'];
    if(!move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $imageUrl)){
        throw new InvalidArgumentException("Error loading image");
    }

    $statement = $connection -> prepare(
    "INSERT INTO books (user_id, title, description, author, image, category, url, year) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $statement -> execute([
        $_SESSION['userId'],
        $_POST['title'],
        $_POST['description'],
        $_POST['author'],
        '/biblioteca/images/' . $imageUrl,
        $_POST['category'],
        $_POST['url'],
        $_POST['year'],
    ]);

    echo "
        <script>
            alert('Book created successfully')
            location = 'http://localhost/biblioteca/dashboard.php'
        </script>
    ";

}catch(InvalidArgumentException $error){
    $error = $error -> getMessage();
    echo "
        <script>
            alert('Error while creating book: $error')
            location = 'http://localhost/biblioteca/dashboard.php'
        </script>
    ";
}catch(Exception $error){
    echo "Fatal error, Unexpected error at login: $error";
}

<?php

try{
    $connection = new PDO("mysql:host=localhost;dbname=biblioteca", "root", "");
    $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $error){
    echo "Connection error: " . $error -> getMessage();
}
<?php

namespace Utils;

use PDO, PDOException;

class Database{
    public static function getConnection(){
        try{
            $connection = new PDO('mysql:host=localhost;dbname=biblioteca', 'root', '');
            $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        }catch(PDOException){
            throw new PDOException('Connection error');
        }
    }
}
<?php

namespace Utils;

class Validation{
    public static function validateUserName(string $name): bool{
        return strlen($name) >= 3 || strlen($name) <= 40;
    }
    public static function validateUserPassword($password): bool{
        if(strlen($password) < 8 || strlen($password) > 64) return false;
        if(!preg_match('/[a-zñ]/', $password)) return false;
        if(!preg_match('/[A-ZÑ]/', $password)) return false;
        if(!preg_match('/[0-9]/', $password)) return false;
        if(!preg_match('/[^a-zA-Z0-9]/', $password)) return false;
        if(preg_match('/\s/', $password)) return false;
        return true;
    }
    public static function validateUserEmail(string $email): bool{
        if(strlen($email) < 8 || strlen($email) > 200) return false;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        return true;
    }
    public static function validateImage($image): bool{
        return true;
    }
}
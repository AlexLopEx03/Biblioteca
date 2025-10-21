<?php

namespace Utils;

use Exception;

class CookieDecoder{
    public static function getIdFromCookie(): string | bool{
        try{
            if(isset($_COOKIE['token'])){
                list($userId, $hmac) = explode('|', $_COOKIE['token'] , 2);
                return $userId;
            }else{
                return false;
            }
        }catch(Exception){
            return false;
        }
    }
}
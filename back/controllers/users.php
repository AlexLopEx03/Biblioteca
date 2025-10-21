<?php

namespace Controller\Users;

use Exception, InvalidArgumentException;

# Validation
require_once '../../utils/validation.php';
use Utils\Validation;

# Crud
require_once '../../crud/users.php';
use Crud\Users\Users;

require_once '../../utils/cookieDecoder.php';
use Utils\CookieDecoder;

class UserController{
    public static function register(){
        try{
            $data = json_decode(file_get_contents('php://input'), true);
            if(
                !$data || !$data['userName'] || !$data['userPassword'] || !$data['userEmail'] ||
                !Validation::validateUserName($data['userName']) ||
                !Validation::validateUserPassword($data['userPassword']) ||
                !Validation::validateUserEmail($data['userEmail'])
            ){
                throw new InvalidArgumentException('Invalid data');
            }
            if(Users::checkIfUserExists($data['userName']) || Users::checkIfEmailExists($data['userEmail'])){
                throw new InvalidArgumentException('Invalid data');
            }

            Users::createUser($data['userName'], $data['userPassword'], $data['userEmail']);

            http_response_code(201);
            echo json_encode([
                'success' => true,
                'message' => 'User created successfully'
            ]);
        }catch(InvalidArgumentException $error){
            http_response_code(422);
            echo json_encode([
                'success' => false,
                'message' => $error -> getMessage()
            ]);
        }catch(Exception $error){
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Unexpected error at register'
            ]);
        }
    }
    public static function login(){
        try{
            $data = json_decode(file_get_contents('php://input'), true);
            if(
                !$data || !$data['userName'] || !$data['userPassword'] ||
                !Validation::validateUserName($data['userName']) ||
                !Validation::validateUserPassword($data['userPassword'])
            ){
                throw new InvalidArgumentException('Invalid data');
            }
            if(!Users::checkIfUserExists($data['userName'])){
                throw new InvalidArgumentException('Invalid data');
            }
            $password = Users::getPasswordByName($data['userName']);
            if(!password_verify($data['userPassword'], $password)){
                throw new InvalidArgumentException('Invalid data');
            }
            (string)$userId = Users::getUserIdByName($data['userName']);
            $token = hash_hmac('sha256', (string)$userId, base64_decode('q7Vf8aX1L+8nHkZb9sP2y0B2vR1u5KJzFj0rH3vN+8M='));
            setcookie('token', (string)$userId . '|' . $token, [
                'expires' => time() + 86400, // 1 Day
                'path' => '/',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'None'
            ]);
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'message' => 'Login successfull'
            ]);
        }catch(InvalidArgumentException $error){
            http_response_code(422);
            echo json_encode([
                'success' => false,
                'message' => $error -> getMessage()
            ]);
        }catch(Exception $error){
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Unexpected error at login'
            ]);
        }
    }
    public static function logout(){
        try{
            if(isset($_COOKIE['token'])){
                setcookie('token', '', [
                    'expires' => time() - 3600,
                    'path' => '/',
                    'secure' => true,
                    'httponly' => true,
                    'samesite' => 'None'
                ]);
                unset($_COOKIE['token']);
            }
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'message' => 'Logout successfull'
            ]);
        }catch(Exception $error){
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Unexpected error at logout'
            ]);
        }
    }
    public static function getUserData(){
        try{
            $userData = Users::getUserData(CookieDecoder::getIdFromCookie());
            http_response_code(200);
            echo json_encode([
                'userName' => $userData['user_name'],
                'userEmail' => $userData['user_email'],
                'userImage' => $userData['image'],
                'success' => true,
                'message' => ''
            ]);
        }catch(Exception){
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Unexpected error at getUserData'
            ]);
        }
    }
}
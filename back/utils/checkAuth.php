<?php

try{
    if(!isset($_COOKIE['token'])){
        throw new Exception('Unauthorized');
    }
    list($userId, $hmac) = explode('|', $_COOKIE['token'] , 2);
    $tokenExpected = hash_hmac('sha256', (string)$userId, base64_decode('q7Vf8aX1L+8nHkZb9sP2y0B2vR1u5KJzFj0rH3vN+8M='));

    if(!hash_equals($tokenExpected, $hmac)){
        throw new Exception('Unauthorized');
    }
}catch(Exception $error){
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'message' => $error -> getMessage()
    ]);
    exit;
}
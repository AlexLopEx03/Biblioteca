<?php

namespace Controller\Books;

use Exception;

# Crud
require_once '../../crud/books.php';
use Crud\Books\Books;

# Utils
require_once '../../utils/cookieDecoder.php';
use Utils\CookieDecoder;

use InvalidArgumentException;

class BookController{
    public static function getAllBooks(){
        try{
            $books = Books::getAllBooks();
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'message' => '',
                'books' => $books
            ]);
        }catch(Exception){
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Unexpected error at getAllBooks'
            ]);
        }
    }
    public static function getAllUserBooks(){
        try{
            $books = Books::getAllUserBooks(CookieDecoder::getIdFromCookie());
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'message' => '',
                'books' => $books
            ]);
        }catch(Exception){
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Unexpected error at getAllUserBooks'
            ]);
        }
    }
    public static function addBookVisit(){
        try{
            $data = json_decode(file_get_contents('php://input'), true);
            if(!$data || !$data['bookId'] || !is_numeric($data['bookId'])){
                throw new InvalidArgumentException('Error adding visit');
            }else{
                Books::addBookVisit($data['bookId']);
                http_response_code(201);
                echo json_encode([
                    'success' => true,
                    'message' => 'Visits added successfully'
                ]);
            }
        }catch(InvalidArgumentException $error){
            http_response_code(response_code: 409);
            echo json_encode([
                'success' => false,
                'message' => $error -> getMessage()
            ]);
        }catch(Exception $error){
            http_response_code(response_code: 500);
            echo json_encode([
                'success' => false,
                'message' => 'Unexpected error at addBookVisit  ' . $error -> getMessage()
            ]);
        }
    }
    public static function searchBooks(){
        try{
            $data = json_decode(file_get_contents('php://input'), true);
            if(isset($_COOKIE['token'])){
                require_once '../../utils/checkAuth.php';
                $books = Books::getAllUserBooks(CookieDecoder::getIdFromCookie());
                $sugestedBooks = [];
                for($i = 0; $i < sizeof($books); $i++){
                    if(str_contains($books[$i]['title'], $data['text'])){
                        array_push($sugestedBooks, $books[$i]['title']);
                    }
                }
                http_response_code(200);
                echo json_encode([
                    'sugestedBoojs' => $sugestedBooks,
                    'success' => true,
                    'message' => 'Search successfull'
                ]);
            }else{
                $books = Books::getAllBooks();
                $sugestedBooks = [];
                for($i = 0; $i < sizeof($books); $i++){
                    if(str_contains($books[$i]['title'], $data['text'])){
                        array_push($sugestedBooks, $books[$i]);
                    }
                }
                http_response_code(200);
                echo json_encode([
                    'sugestedBooks' => $sugestedBooks,
                    'success' => true,
                    'message' => 'Search successfull'
                ]);
            }
        }catch(Exception){
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'Unexpected error at searchBooks'
            ]);
        }
    }
    public static function getBookLikes(){
        try{
            $data = json_decode(file_get_contents('php://input'), true);
            $likes = Books::getBookLikes($data['bookId']);
            http_response_code(200);
            echo json_encode([
                'likes' => $likes,
                'success' => true,
                'message' => 'Query successfull'
            ]);
        }catch(Exception){
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Unexpected error at getBookLikes'
            ]);
        }
    }
    public static function addBookLike(){
        try{
            $data = json_decode(file_get_contents('php://input'), true);
            Books::addBookLike(CookieDecoder::getIdFromCookie(), $data['bookId']);
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'message' => 'Like added successfully'
            ]);
        }catch(Exception){
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Unexpected error at addBookLike'
            ]);
        }
    }
}
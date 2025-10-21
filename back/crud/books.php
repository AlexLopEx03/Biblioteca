<?php

namespace Crud\Books;

require_once '../../utils/connection.php';
use \Utils\Database;

use PDO;

class Books{
    public static function getAllBooks(): array{
        $connection = Database::getConnection();
        $statement = $connection -> prepare(
            "SELECT * FROM books"
        );
        $statement -> execute();
        $books = $statement -> fetchAll(PDO::FETCH_ASSOC);
        return $books;
    }
    public static function getAllUserBooks(string $userId): array{
        $connection = Database::getConnection();
        $statement = $connection -> prepare(
            "SELECT * FROM books WHERE user_id = (?)"
        );
        $statement -> execute([$userId]);
        $books = $statement -> fetchAll();
        return $books;
    }
    public static function addBookVisit(int $bookId){
        $connection = Database::getConnection();
        $statement = $connection -> prepare(
            "UPDATE books SET visits = visits + 1 WHERE id = (?)"
        );
        $statement -> execute([$bookId]);
    }
    public static function getBookLikes(int $bookId): int{
        $connection = Database::getConnection();
        $statement = $connection -> prepare(
            "SELECT COUNT(*) FROM book_likes WHERE book_id = (?)"
        );
        $statement -> execute([$bookId]);
        $result = $statement -> fetchColumn();
        return $result;
    }
    public static function addBookLike(int $userId, int $bookId){
        $connection = Database::getConnection();
        $statement = $connection -> prepare(
            "INSERT IGNORE INTO book_likes(user_id, book_id) VALUES(?, ?)"
        );
        $statement -> execute([$userId, $bookId]);
    }
}
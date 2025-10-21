<?php

namespace Crud\Users;

require_once '../../utils/connection.php';
use Utils\Database;

use PDO;

class Users{
    public static function createUser(string $userName, string $userPassword, string $userEmail): bool{
        $connection = Database::getConnection();
        $statement = $connection -> prepare(
        "INSERT INTO users(user_name, user_password, user_email) VALUES(?, ?, ?)"
        );
        $success = $statement -> execute([
            $userName,
            password_hash($userPassword, PASSWORD_DEFAULT),
            $userEmail
        ]);
        return $success;
    }
    public static function checkIfUserExists(string $name): bool{
        $connection = Database::getConnection();
        $statement = $connection -> prepare(
            "SELECT 1 FROM users WHERE user_name = (?) LIMIT 1"
        );
        $statement -> execute([$name]);
        return (bool) $statement -> fetchColumn();
    }
    public static function checkIfEmailExists(string $email): bool{
        $connection = Database::getConnection();
        $statement = $connection -> prepare(
            "SELECT 1 FROM users WHERE user_email = (?) LIMIT 1"
        );
        $statement -> execute([$email]);
        return (bool) $statement -> fetchColumn();
    }
    public static function getUserIdByName(string $name): ?string{
        $connection = Database::getConnection();
        $statement = $connection -> prepare(
            "SELECT id FROM users WHERE user_name = (?) LIMIT 1"
        );
        $statement -> execute([$name]);
        $result = $statement -> fetch(PDO::FETCH_ASSOC);
        return $result['id'] ?? null;
    }
    public static function getPasswordByName(string $name): ?string{
        $connection = Database::getConnection();
        $statement = $connection -> prepare(
            "SELECT user_password FROM users WHERE user_name = (?) LIMIT 1"
        );
        $statement -> execute([$name]);
        $result = $statement -> fetch(PDO::FETCH_ASSOC);
        return $result['user_password'] ?? null;
    }
    public static function getUserData(string $userId): array{
        $connection = Database::getConnection();
        $statement = $connection -> prepare(
            "SELECT user_name, user_email, image FROM users WHERE id = (?) LIMIT 1"
        );
        $statement -> execute([$userId]);
        $result = $statement -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
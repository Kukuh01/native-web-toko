<?php

class DB {
    private static $pdo = null;
    public static function get() {
        if (self::$pdo === null) {
            $host = getenv('DB_HOST') ?: 'db';
            $db
            = getenv('DB_NAME') ?: 'pentestlab';
            $user = getenv('DB_USER') ?: 'admin';
            $pass = getenv('DB_PASS') ?: 'admin';
            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            self::$pdo = new PDO($dsn, $user, $pass, $opt);
        }
        return self::$pdo;
    }
}
<?php
require_once dirname(__FILE__, 3) . '/config.php';
require_once BASE_PATH . '/api/utils/server.php';

function getDatabaseConnection(): PDO {
    try {
        $host = 'localhost';
        $db = 'vikings';
        $user = 'root';
        $pass = '';
        $port = '3306';
        $charset = 'utf8mb4';
        
        $dsn = "mysql:host=$host;dbname=$db;port=$port;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        returnError(500, 'Could not connect to the database. ' . $e->getMessage());
        die();
    }
}
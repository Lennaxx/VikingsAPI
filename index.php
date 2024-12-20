<?php
require_once __DIR__ . '/config.php';
require_once BASE_PATH . '/api/utils/database.php';

try {
    $db = getDatabaseConnection();
    echo "Hello dear Viking!";
} catch (PDOException $e) {
    echo "Could not connect to the database. " . $e->getMessage();
}
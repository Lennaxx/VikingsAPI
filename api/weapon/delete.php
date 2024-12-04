<?php
require_once '../utils/database.php';

$id = $_GET['id'] ?? null;
if ($id === null) {
    http_response_code(400);
    echo json_encode(['error' => 'ID is required']);
    exit;
}

$db = getDatabaseConnection();
$query = $db->prepare('DELETE FROM weapon WHERE id = :id');
$query->execute(['id' => $id]);

echo json_encode(['message' => 'Weapon deleted']);
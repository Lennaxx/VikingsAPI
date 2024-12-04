<?php
require_once '../utils/database.php';

$id = $_GET['id'] ?? null;
if ($id === null) {
    http_response_code(400);
    echo json_encode(['error' => 'ID is required']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
if (empty($data)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

$db = getDatabaseConnection();
$fields = [];
$params = ['id' => $id];

foreach ($data as $key => $value) {
    $fields[] = "$key = :$key";
    $params[$key] = $value;
}

$query = $db->prepare('UPDATE weapons SET ' . implode(', ', $fields) . ' WHERE id = :id');
$query->execute($params);

echo json_encode(['message' => 'Weapon updated']);
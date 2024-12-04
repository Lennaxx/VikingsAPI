<?php
require_once '../utils/database.php';

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['name']) || !isset($data['type']) || !isset($data['damage'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

$db = getDatabaseConnection();
$query = $db->prepare('INSERT INTO weapon (name, type, damage) VALUES (:name, :type, :damage)');
$query->execute([
    'name' => $data['name'],
    'type' => $data['type'],
    'damage' => $data['damage'],
]);

http_response_code(201);
echo json_encode(['message' => 'Weapon created']);
// 1. findOne.php
<?php
require_once '../utils/database.php';

$id = $_GET['id'] ?? null;
if ($id === null) {
    http_response_code(400);
    echo json_encode(['error' => 'ID is required']);
    exit;
}

$db = getDatabaseConnection();
$query = $db->prepare('SELECT * FROM weapon WHERE id = :id');
$query->execute(['id' => $id]);
$result = $query->fetch(PDO::FETCH_ASSOC);

if ($result) {
    echo json_encode($result);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Weapon not found']);
}

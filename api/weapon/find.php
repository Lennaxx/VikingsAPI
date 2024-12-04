<?php
require_once '../utils/database.php';

$limit = $_GET['limit'] ?? 10;
$offset = $_GET['offset'] ?? 0;

$db = getDatabaseConnection();
$query = $db->prepare('SELECT * FROM weapon LIMIT :limit OFFSET :offset');
$query->bindValue('limit', (int)$limit, PDO::PARAM_INT);
$query->bindValue('offset', (int)$offset, PDO::PARAM_INT);
$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($results);
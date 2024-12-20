<?php
require_once dirname(__FILE__, 3) . '/config.php';
require_once BASE_PATH . '/api/dao/viking.php';
require_once BASE_PATH . '/api/utils/server.php';

header('Content-Type: application/json');

if (!methodIsAllowed('read')) {
    returnError(405, 'Method not allowed');
    return;
}

if (!isset($_GET['id'])) {
    returnError(400, 'Missing parameter : id');
}

$viking = findOneViking($_GET['id']);
if (!$viking) {
    returnError(404, 'Viking not found');
}
echo json_encode($viking);

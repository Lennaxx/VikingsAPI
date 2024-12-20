<?php
require_once dirname(__FILE__, 3) . '/config.php';
require_once BASE_PATH . '/api/dao/viking.php';
require_once BASE_PATH . '/api/utils/server.php';
require_once BASE_PATH . '/api/viking/service.php';

header('Content-Type: application/json');

if (!methodIsAllowed('create')) {
    returnError(405, 'Method not allowed');
    return;
}

$data = getBody();

if (validateMandatoryParams($data, ['name', 'health', 'attack', 'defense'])) {
    verifyViking($data);

    $newVikingId = createViking($data['name'], $data['health'], $data['attack'], $data['defense']);
    if (!$newVikingId) {
        returnError(500, 'Could not create the viking');
    }
    echo json_encode(['id' => $newVikingId]);
    http_response_code(201);
} else {
    returnError(412, 'Mandatory parameters : name, health, attack, defense');
}
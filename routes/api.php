<?php
require_once __DIR__.'/../controllers/TaskController.php';

$controller = new TaskController();

$uri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$uri_parts = explode('/', trim($uri, '/'));


if ($uri_parts[0] === 'task-manager') {
    array_shift($uri_parts);
}

if ($uri_parts[0] === 'index.php') {
    array_shift($uri_parts);
}
$method = $_SERVER['REQUEST_METHOD'];
if(isset($uri_parts[0]) && $uri_parts[0] === 'api' && isset($uri_parts[1]) && $uri_parts[1] === 'tasks'){

    $id = isset($uri_parts[2]) ? (int)$uri_parts[2] : null;

    switch ($method) {
        case 'GET':
            if ($id) {
                $controller->show($id);
            } else {
                $controller->index();
            }
            break;

        case 'POST':
            $controller->store();
            break;

        case 'PUT':
            if ($id) {
                $controller->update($id); 
            } else {
                http_response_code(400);
                echo json_encode(['is_success' => false, 'message' => 'Task ID is required for update']);
            }
            break;

        case 'DELETE':
            if ($id) {
                $controller->delete($id);
            } else {
                http_response_code(400);
                echo json_encode(['is_success' => false, 'message' => 'Task ID is required for delete']);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(['is_success' => false, 'message' => 'Method Not Allowed']);
            break;
    }
} else {
    http_response_code(404);
    echo json_encode(['is_success' => false, 'message' => 'Endpoint Not Found']);

}
?>
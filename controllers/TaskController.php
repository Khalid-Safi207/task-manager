<?php
require_once __DIR__.'/../models/Task.php';

class TaskController {
    private $task;

    public function __construct()
 {
        $this->task = new Task();
    }

    public function index() {
        $result = $this->task->readAll();
        $this->sendResponse( $result );

    }

    public function show( $id ) {
        $this->task->id = $id;
        $result = $this->task->readOne();
        $this->sendResponse( $result );
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data['title'])) {
            $this->sendResponse([
                'is_success' => false,
                'data' => null,
                'message' => 'Title is required.'
            ]);
            return;
        }

        $this->task->title = $data['title'];
        $this->task->description = $data['description'] ?? '';
        $this->task->status = $data['status'] ?? 'pending';
        $this->task->priority = $data['priority'] ?? 'low';

        $result = $this->task->create();
        $this->sendResponse($result);
    }

    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->task->id = $id;
        $this->task->title = $data['title'] ?? $this->task->title;
        $this->task->description = $data['description'] ?? $this->task->description;
        $this->task->status = $data['status'] ?? $this->task->status;
        $this->task->priority = $data['priority'] ?? $this->task->priority;

        $result = $this->task->update();
        $this->sendResponse($result);
    }

     public function delete($id) {
        $this->task->id = $id;
        $result = $this->task->delete();
        $this->sendResponse($result);
    }


    public function sendResponse( $response ) {
        header( 'Content-Type: application/json' );
        echo json_encode( $response );
        exit();
    }
}
?>
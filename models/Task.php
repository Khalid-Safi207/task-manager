<?php
require_once  __DIR__.'/../config/Database.php' ;
require_once  __DIR__.'/../includes/Validator.php' ;
class Task {
    private $db;
    private $validator; 
    private $status_array = [
        'is_success' => '',
        'data' => '',
        'message' => ''
    ];
    public $id;
    public $title;
    public $description;
    public $status = 'pending';
    public $priority = 'low';

    public function __construct()
    {
        $this->db = ( new Database() )->connect_db();
        
    }
    private function validate(){
        if(isset($this->title) && isset($this->description)){
            $this->validator =  new Validator($this->title,$this->description);
            $this->title = $this->validator->getTitle();
            $this->description = $this->validator->getDesc();
        }

    }
    public function readAll() {
        $stmt = $this->db->prepare( 'SELECT * FROM tasks' );

        if ( $stmt->execute() ) {
            $result = $stmt->fetchAll( PDO::FETCH_ASSOC );
            $this->status_array[ 'is_success' ] = true;
            $this->status_array[ 'data' ] = $result;
            $this->status_array[ 'message' ] = 'These are all the tasks.';
            return $this->status_array;
        } else {
            $this->status_array[ 'is_success' ] = false;
            $this->status_array[ 'data' ] = null;
            $this->status_array[ 'message' ] = 'Please try again later. There was an error.';
            return $this->status_array;
        }
    }

    public function readOne() {
        $stmt = $this->db->prepare( 'SELECT * FROM tasks WHERE id = :id' );
        $stmt->bindParam( ':id', $this->id );
        if ( $stmt->execute() ) {
            $result = $stmt->fetch( PDO::FETCH_ASSOC );
            if ( $result ) {
                $this->status_array[ 'is_success' ] = true;
                $this->status_array[ 'data' ] = $result;
                $this->status_array[ 'message' ] = 'This is the task that was requested.';
                return $this->status_array;
            } else {
                $this->status_array[ 'is_success' ] = true;
                $this->status_array[ 'data' ] = $result;
                $this->status_array[ 'message' ] = 'Task not found.';
                return $this->status_array;
            }
        } else {
            $this->status_array[ 'is_success' ] = false;
            $this->status_array[ 'data' ] = null;
            $this->status_array[ 'message' ] = 'Please try again later. There was an error.';
            return $this->status_array;
        }
    }

    public function create() {
        $this->validate();
        $stmt = $this->db->prepare( 'INSERT INTO tasks(title, description, status, priority) VALUES(:title, :description, :status, :priority)' );
        $stmt->bindParam( ':title', $this->title );
        $stmt->bindParam( ':description', $this->description );
        $stmt->bindParam( ':status', $this->status );
        $stmt->bindParam( ':priority', $this->priority );
        if ( $stmt->execute() ) {
            $this->status_array[ 'is_success' ] = true;
            $this->status_array[ 'data' ] = null;
            $this->status_array[ 'message' ] = 'A new task has been added.';
            return $this->status_array;
        } else {
            $this->status_array[ 'is_success' ] = false;
            $this->status_array[ 'data' ] = null;
            $this->status_array[ 'message' ] = 'The task has not been added.';
            return $this->status_array;
        }
    }

    public function update() {
        $this->validate();
        $stmt = $this->db->prepare( 'UPDATE tasks SET title= :title, description= :description, status= :status, priority= :priority WHERE id = :id' );
        $stmt->bindParam( ':id', $this->id );
        $stmt->bindParam( ':title', $this->title );
        $stmt->bindParam( ':description', $this->description );
        $stmt->bindParam( ':status', $this->status );
        $stmt->bindParam( ':priority', $this->priority );
        if ( $stmt->execute() ) {
            $this->status_array[ 'is_success' ] = true;
            $this->status_array[ 'data' ] = null;
            $this->status_array[ 'message' ] = 'The task was successfully updated.';
            return $this->status_array;
        } else {
            $this->status_array[ 'is_success' ] = false;
            $this->status_array[ 'data' ] = null;
            $this->status_array[ 'message' ] = 'The task was not successfully updated.';
            return $this->status_array;
        }
    }

    public function delete() {
        $stmt = $this->db->prepare( 'DELETE FROM tasks WHERE id= :id' );
        $stmt->bindParam( ':id', $this->id );
        if ( $stmt->execute() ) {
            $this->status_array[ 'is_success' ] = true;
            $this->status_array[ 'data' ] = null;
            $this->status_array[ 'message' ] = 'The task was successfully deleted.';
            return $this->status_array;
        } else {
            $this->status_array[ 'is_success' ] = false;
            $this->status_array[ 'data' ] = null;
            $this->status_array[ 'message' ] = 'The task was not successfully deleted.';
            return $this->status_array;
        }
    }

}

?>
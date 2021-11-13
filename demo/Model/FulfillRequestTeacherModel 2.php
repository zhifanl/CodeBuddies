<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";

class FulfillRequestTeacherModel extends Database
{
    public function getFulfillRequestTeacher($limit)
    {
        return $this->select("SELECT * FROM fulfill_request_teacher LIMIT ?", ["i", $limit]);
    }

    public function updateFulfillRequestTeacher($request_id,$teacher_id)
    {
        try {
            $query = "UPDATE fulfill_request_teacher as p 
            SET p.teacher_id = '$teacher_id'
            WHERE p.request_id='$request_id'";

            $stmt = $this->connection->prepare($query);
            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "teacher_id updated successfully";
            } else {
                $this->connection->close();
                return "Error updating teacher_id: " . $this->connection->error;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteFulfillRequestTeacher(){
        $request_id=$_GET['request_id'];
        try{
            
            $query =   "DELETE FROM fulfill_request_teacher 
                        WHERE request_id ='$request_id'";

            $stmt = $this->connection->prepare($query);

            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "fulfill_request_id deleted successfully";
                
            } else {
                $this->connection->close();
                return "Error deleting fulfill_request_id: " .$this->connection->error;
            }
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
    }

    public function postFulfillRequestTeacher(){
        $rest_json = file_get_contents('php://input');

        $_POST = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO fulfill_request_teacher(request_id, teacher_id) VALUES (?, ?)");

        /* Prepared statement, stage 2: bind and execute */
        $request_id = $_POST['request_id'];
        $teacher_id = $_POST['teacher_id'];

        $stmt->bind_param("is", $request_id, $teacher_id); // "is" means that $id is bound as an integer and $label as a string
        
        if($stmt->execute()===TRUE){

            $this->connection->close();
            return "fulfill_request_teacher added successfully";
            
        } else {
            $this->connection->close();
            return "Error adding record: " .$this->connection->error;
        }
    }
}
?>

<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";

class MakeRequestModel extends Database
{
    public function getMakeRequest($limit)
    {
        return $this->select("SELECT * FROM make_request LIMIT ?", ["i", $limit]);
    }

    public function updateMakeRequest($student_id, $request_id)
    {
        try {
            $query = "UPDATE make_request as p 
            SET p.request_id='$request_id' 
            WHERE p.student_id='$student_id'";

            $stmt = $this->connection->prepare($query);
            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "make_request updated successfully";
            } else {
                $this->connection->close();
                return "Error updating make_request: " . $this->connection->error;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteMakeRequest(){
        $request_id=$_GET['request_id'];
        try{
            
            $query =   "DELETE FROM make_request
                        WHERE request_id ='$request_id' ";

            $stmt = $this->connection->prepare($query);

            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "make_request deleted successfully";
                
            } else {
                $this->connection->close();
                return "Error deleting make_request: " .$this->connection->error;
            }
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
    }

    public function postMakeRequest(){
        $rest_json = file_get_contents('php://input');

        $_POST = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO make_request(student_id,request_id ) VALUES (?, ?)");

        /* Prepared statement, stage 2: bind and execute */
        $student_id = $_POST['student_id'];
        $request_id = $_POST['request_id'];

        $stmt->bind_param("ss", $student_id, $request_id); // "is" means that $id is bound as an integer and $label as a string
        
        if($stmt->execute()===TRUE){

            $this->connection->close();
            return "make_request added successfully";
            
        } else {
            $this->connection->close();
            return "Error adding record: " .$this->connection->error;
        }
    }
}
?>

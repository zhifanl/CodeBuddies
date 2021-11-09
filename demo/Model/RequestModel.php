<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";
 
class RequestModel extends Database
{
    public function getRequest($limit)
    {
        return $this->select("SELECT * FROM request LIMIT ?", ["i", $limit]);
    }

    // param need to be in order: course_name, description
    public function updateRequest($request_id, $email,$client_name, $teacher_name,$course_name)
    {
        try {
            $query="UPDATE request as p 
            SET p.request_id='$request_id',p.email='$email',p.client_name='$client_name', p.teacher_name='$teacher_name', p.course_name='$course_name'
            WHERE p.request_id=$request_id";

            $stmt = $this->connection->prepare($query);
            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "Record updated in list successfully";
                
            } else {
                $this->connection->close();
                return "Error updating record: " .$this->connection->error;
            }
            
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
        
    }

    public function deleteRequest(){
        
        try{
            $request_id=$_GET['request_id'];
            
            $query ="DELETE FROM request 
            WHERE request_id= '$request_id'";
            


            $stmt = $this->connection->prepare($query);

            if ($stmt->execute() === TRUE) {
                $stmt->close();
                $this->connection->close();
                return "Course Record deleted from list successfully";
                
            } else {
                $stmt->close();
                $this->connection->close();
                return "Error deleting Course Record: " .$this->connection->error;
            }
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
    }

    public function postRequest(){
        $rest_json = file_get_contents('php://input');

        $_POST = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO request(email,client_name, teacher_name,course_name) VALUES (?,?,?,?)");

        $stmt->bind_param("ssss", $email, $client_name, $teacher_name, $course_name); // "ssss" means that $id is bound as an integer and $label as a string
        

        /* Prepared statement, stage 2: bind and execute */
        $email = $_POST['email'];
        $client_name = $_POST['client_name'];
        $course_name = $_POST['course_name'];
        $teacher_name = $_POST['teacher_name'];
        

        if($stmt->execute()===TRUE){

            $this->connection->close();
            return "Course Record added to list successfully";
            
        } else {
            $this->connection->close();
            return "Error adding record to list: " .$this->connection->error;
        }
    }
        
}
?>
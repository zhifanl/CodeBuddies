<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";
 
class TeacherModel extends Database
{
    public function getTeacher($limit)
    {
        return $this->select("SELECT * FROM teacher LIMIT ?", ["i", $limit]);
    }

    // param need to be in order: course_name, description
    public function updateTeacher($teacher_name,$admin_id)
    {
        try {
            $query="UPDATE teacher as p 
            SET p.teacher_name='$teacher_name', p.admin_id='$admin_id'
            WHERE p.teacher_name='$teacher_name'";

            $stmt = $this->connection->prepare($query);
            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "Teacher Record updated in list successfully";
                
            } else {
                $this->connection->close();
                return "Error updating Teacher record: " .$this->connection->error;
            }
            
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
        
    }

    public function deleteTeacher(){
        
        try{
            $teacher_name=$_GET['teacher_name'];
            
            $query ="DELETE FROM teacher 
            WHERE teacher_name= '$teacher_name'";
            


            $stmt = $this->connection->prepare($query);

            if ($stmt->execute() === TRUE) {
                $stmt->close();
                $this->connection->close();
                return "Teacher Record deleted from list successfully";
                
            } else {
                $stmt->close();
                $this->connection->close();
                return "Error deleting Teacher Record: " .$this->connection->error;
            }
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
    }

    public function postTeacher(){
        $rest_json = file_get_contents('php://input');

        $_POST = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO teacher(teacher_name) VALUE (?)");

        $stmt->bind_param("s", $teacher_name ); 
        

        /* Prepared statement, stage 2: bind and execute */
       
        $teacher_name = $_POST['teacher_name'];

        if($stmt->execute()===TRUE){

            $this->connection->close();
            return "Teacher Record added to list successfully";
            
        } else {
            $this->connection->close();
            return "Error adding Teacher to list: " .$this->connection->error;
        }
    }
        
}
?>
<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";
 
class SoftwareCoursesModel extends Database
{
    public function getSoftwareCourses($limit)
    {
        return $this->select("SELECT * FROM software_courses LIMIT ?", ["i", $limit]);
    }

    // param need to be in order: course_name, description
    public function updateSoftwareCourses($course_name,$description)
    {
        try {
            $query="UPDATE software_courses as p 
            SET p.description='$description'  
            WHERE p.course_name='$course_name'";

            $stmt = $this->connection->prepare($query);
            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "Record updated successfully";
                
            } else {
                $this->connection->close();
                return "Error updating record: " .$this->connection->error;
            }
            
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
        
    }

    public function deleteSoftwareCourses(){
        $course_name=$_GET['course_name'];
        try{
            
            $query =   "DELETE FROM software_courses 
                        WHERE course_name ='$course_name' ";

            $stmt = $this->connection->prepare($query);

            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "Software Course deleted successfully";
                
            } else {
                $this->connection->close();
                return "Error deleting record: " .$this->connection->error;
            }
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
    }

    public function postSoftwareCourses(){
        $rest_json = file_get_contents('php://input');

        $_POST = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO software_courses(course_name, description) VALUES (?, ?)");

        /* Prepared statement, stage 2: bind and execute */
        $course_name = $_POST['course_name'];
        $description = $_POST['description'];

        $stmt->bind_param("ss", $course_name, $description); // "is" means that $id is bound as an integer and $label as a string
        
        if($stmt->execute()===TRUE){

            $this->connection->close();
            return "Software Course added successfully";
            
        } else {
            $this->connection->close();
            return "Error adding record: " .$this->connection->error;
        }
    }
        
}
?>
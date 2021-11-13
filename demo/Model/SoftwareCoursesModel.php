<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";
 
class SoftwareCoursesModel extends Database
{

    public function displayList(){
   
    $result=$this->getSoftwareCourses(10);
                    //  echo "<p>".$result."</p>";
                        if(count ($result) > 0){
                            echo '<h2 class="pull-left">Courses</h2>';
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Course Name</th>";
                                        echo "<th>Description</th>";
                                        echo "<th>Tuition Fee</th>";

                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                foreach ($result as $row){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['course_name'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "<td>" . $row['tuition_fee'] . "</td>";

                                        // echo "<td>";
                                        //     echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                        //     echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                        //     echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        // echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
    }
    public function getFeeByName($course_name)
    {
       $result=$this->select("SELECT * FROM software_courses WHERE course_name=?", ["s",$course_name]);
       // result is array here
        //    echo count($result); 
       foreach ($result as $row)
       {
           echo $row['tuition_fee'];
       return $row['tuition_fee'];
        }
    }


    public function getSoftwareCourses($limit)
    {
        return $this->select("SELECT * FROM software_courses LIMIT ?", ["i", $limit]);
    }

    // param need to be in order: course_name, description
    public function updateSoftwareCourses($course_name,$description,$tuition_fee)
    {
        try {
            $query="UPDATE software_courses as p 
            SET p.description='$description' ,p.tuition_fee='$tuition_fee'
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


        $stmt = $this->connection->prepare("INSERT INTO software_courses(course_name, description,tuition_fee) VALUES (?, ?,?)");

        /* Prepared statement, stage 2: bind and execute */
        $course_name = $_POST['course_name'];
        $description = $_POST['description'];
        $tuition_fee = $_POST['tuition_fee'];

        $stmt->bind_param("ssi", $course_name, $description,$tuition_fee); // "is" means that $id is bound as an integer and $label as a string
        
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
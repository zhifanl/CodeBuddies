<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";
 
class SoftwareCoursesModel extends Database
{

    public function displayList(){
   
    $result=$this->getSoftwareCourses(10);
                    //  echo "<p>".$result."</p>";
                        if(count ($result) > 0){
                            echo '<h2 class="table-title">Courses</h2>';
                            if($_SESSION["admin"]==true){
                                echo "<button type='button' class='btn btn-primary btn-lg px-4 me-md-2' onclick='location.href=\"action-pages/add-course.php\"' >Add Course</button>";
                            }
                            echo '<div class="courses">';
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Course Name</th>";
                                        echo "<th>Description</th>";
                                        echo "<th>Tuition Fee</th>";
                                        if($_SESSION["admin"]==true){
                                            echo "<th>Opereate</th>";
                                        }

                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                foreach ($result as $row){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['course_name'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "<td>" . $row['tuition_fee'] . "</td>";
                                        // echo $_SESSION["admin"];
                                        if($_SESSION["admin"]==true){
                                        echo "<td>";
                                            // echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            // echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="./action-pages/delete-course.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                        }
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            echo '</div>';
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

    public function getCourseById($id)
    {
       $result=$this->select("SELECT * FROM software_courses WHERE id=?", ["i",$id]);
       
       foreach ($result as $row)
       {
       return $row;
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

        $data = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO software_courses(course_name, description,tuition_fee) VALUES (?, ?,?)");

        $stmt->bind_param("ssi", $course_name, $description,$tuition_fee); // "is" means that $id is bound as an integer and $label as a string

        /* Prepared statement, stage 2: bind and execute */
        if(!isset($data['course_name']) || !isset($data['description'])){
            if($_POST['course_name']!='' && $_POST['description']!='')
            {
                $course_name = $_POST['course_name'];
                $description = $_POST['description'];
                $tuition_fee = $_POST['tuition_fee'];

                
            }else{
                echo "You did not completely fill the form, please do that again.";
                $this->connection->close();
                return;
            }

        }
        else{
            if($data['course_name']!='' && $data['description']!='')
            {
                $course_name = $data['course_name']; 
                $description = $data['description']; 
                $tuition_fee = $data['tuition_fee']; 

            }else{
                echo "You did not completely fill the form, please do that again.";
                $this->connection->close();
                return;
            }
            
        }

        
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
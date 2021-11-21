<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";
 
class TeacherModel extends Database
{

    public function displayList(){
   
        $result=$this->getTeacher(10);
                            if(count ($result) > 0){
                                echo '<h2 class="table-title">List of Teachers</h2>';
                                if($_SESSION["admin"]==true){
                                    echo "<button type='button' class='btn btn-primary btn-lg px-4 me-md-2' onclick='location.href=\"action-pages/add-teacher.php\"' >Add Teacher</button>";
                                }
                                echo '<div class="courses">';
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>Teacher Name</th>";
                                            if($_SESSION["admin"]==true){
                                                echo "<th>Opereate</th>";
                                            }
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    foreach ($result as $row){
                                        echo "<tr>";
                                            echo "<td>" . $row['teacher_id'] . "</td>";
                                            echo "<td>" . $row['teacher_name'] . "</td>";
                                            if($_SESSION["admin"]==true){
                                            echo "<td>";
                                            //     echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            //     echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                echo '<a href="./action-pages/delete-teacher.php?id='. $row['teacher_id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                            echo "</td>";
                                            }
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                echo '</div>';
                            } else{
                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }
        }

    public function getTeacher($limit)
    {
        return $this->select("SELECT * FROM teacher LIMIT ?", ["i", $limit]);
    }


    public function getTeacherNameById($id)
    {
       $result=$this->select("SELECT * FROM teacher WHERE teacher_id=?", ["i",$id]);
       // result is array here
        //    echo count($result); 
       foreach ($result as $row)
       {
        //    echo $row['ID'];
       return $row['teacher_name'];
        }
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

        $data = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO teacher(teacher_name) VALUE (?)");

        $stmt->bind_param("s", $teacher_name ); 

        if(!isset($data['teacher_name'])){
            if($_POST['teacher_name']!='')
            {
                $teacher_name = $_POST['teacher_name'];
                
            }else{
                echo "You did not completely fill the form, please do that again.";
                $this->connection->close();
                return;
            }

        }
        else{
            if($data['teacher_name']!='')
            {
                $teacher_name = $data['teacher_name']; 
                
            }else{
                echo "You did not completely fill the form, please do that again.";
                $this->connection->close();
                return;
            }
            
        }

        /* Prepared statement, stage 2: bind and execute */
       
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
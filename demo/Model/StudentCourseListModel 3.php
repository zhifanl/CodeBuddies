<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";
 
class StudentCourseListModel extends Database
{
    public function displayList(){
   
        $result=$this->getStudentCourseListById(10);
                        //  echo "<p>".$result."</p>";
                            if(count ($result) > 0){
                                echo '<h2 class="table-title">List of Courses you have</h2>';
                                echo '<div class="courses-list">';
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>Course Name</th>";
                                            echo "<th>Teacher Name</th>";
                                            echo "<th>Description</th>";
                                            echo "<th>Tuition Fee</th>";
                                            echo "<th>Start Date</th>";
                                            echo "<th>End Date</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    foreach ($result as $row){
                                        echo "<tr>";
                                            echo "<td>" . $row['student_id'] . "</td>";
                                            echo "<td>" . $row['course_name'] . "</td>";
                                            echo "<td>" . $row['teacher_name'] . "</td>";
                                            echo "<td>" . $row['description'] . "</td>";
                                            echo "<td>" . $row['tuition_fee'] . "</td>";
                                            echo "<td>" . $row['start_date'] . "</td>";
                                            echo "<td>" . $row['end_date'] . "</td>";
                                            echo "<td>";
                                                echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                echo '</div>';
                            } else{
                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }
        }
    public function getStudentCourseList($limit)
    {
        return $this->select("SELECT * FROM student_course_list LIMIT ?", ["i", $limit]); // need to have where id = ?
    }

    public function getStudentCourseListById()
    {
        return $this->select("SELECT * FROM student_course_list WHERE student_id=?", ["i",$_SESSION['id']]); // need to have where id = ?
    }

    // param need to be in order: course_name, description
    public function updateStudentCourseList($student_id, $tuition_fee,$course_name,$start_date,$end_date,$teacher_name)
    {
        try {
            $query="UPDATE student_course_list as p 
            SET p.tuition_fee='$tuition_fee',p.course_name='$course_name',p.start_date='$start_date', p.end_date='$end_date',p.teacher_name='$teacher_name'
            WHERE p.student_id=$student_id AND p.course_name= '$course_name'";

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

    public function deleteStudentCourseList($course_name_arg,$student_id_arg){
        
        try{
            if(isset($_GET['course_name'])&&isset($_GET['student_id']))
            {
            $course_name=$_GET['course_name'];
            $student_id=$_GET['student_id'];
            }else{
                $course_name=$course_name_arg;
                $student_id=$student_id_arg;

            }
            $query ="DELETE FROM student_course_list 
            WHERE student_id= '$student_id' AND course_name= '$course_name'";
            


            $stmt = $this->connection->prepare($query);

            if ($stmt->execute() === TRUE) {
                $stmt->close();
                $this->connection->close();
                echo "Course Record deleted from list successfully";

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

    public function postStudentCourseList(){ 
        //admin will use this
        $rest_json = file_get_contents('php://input');

        $data = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO student_course_list(student_id, tuition_fee,course_name,start_date,end_date,teacher_name) VALUES (?,?,?,?,?,?)");

        $stmt->bind_param("iissss", $student_id, $tuition_fee, $course_name, $start_date, $end_date, $teacher_name ); // "iissss" means that $id is bound as an integer and $label as a string
        
        if(!isset($data['student_id'])||!isset($data['tuition_fee'])||!isset($data['course_name'])||!isset($data['start_date']) ||!isset($data['end_date'])||!isset($data['teacher_name'])){
            if($_POST['student_id']!=0 && $_POST['tuition_fee']!=0 && $_POST['course_name']!='' && $_POST['teacher_name']!='')
            {
                $student_id = $_POST['student_id'];
                $tuition_fee = $_POST['tuition_fee'];
                $course_name = $_POST['course_name'];
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $teacher_name = $_POST['teacher_name'];

                
            }else{
                echo "You did not completely fill the form, please do that again.";
                return;
            }

        }
        else{
            if($data['student_id']!='' && $data['tuition_fee']!='' && $data['course_name']!='' && $data['teacher_name']!='')
            {
                $student_id = $data['student_id'];
                $tuition_fee = $data['tuition_fee'];
                $course_name = $data['course_name'];
                $start_date = $data['start_date'];
                $end_date = $data['end_date'];
                $teacher_name = $data['teacher_name'];
            }
        }
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
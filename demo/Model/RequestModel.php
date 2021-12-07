<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";
require_once  PROJECT_ROOT_PATH . "/Model/OrderListModel.php";
require_once  PROJECT_ROOT_PATH . "/Model/StudentCourseListModel.php";

 
class RequestModel extends Database
{
    public function displayList(){
   
        $result=$this->getRequest(10);
                            if(count ($result) > 0){
                                echo '<h2 class="pull-left">Requests</h2>';
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>Student email</th>";
                                            echo "<th>Student name</th>";
                                            echo "<th>Teacher name</th>";
                                            echo "<th>Course name</th>";
                                            echo "<th>Operate</th>";

                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    foreach ($result as $row){
                                        echo "<tr>";
                                            echo "<td>" . $row['request_id'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['client_name'] . "</td>";
                                            echo "<td>" . $row['teacher_name'] . "</td>";
                                            echo "<td>" . $row['course_name'] . "</td>";
                                            echo "<td>";
                                                // echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                // echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                echo '<a href="action-pages/delete-request.php?request_id='. $row['request_id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                // Free result set
                            } else{
                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }
    }

    
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

        $data = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO request(email,client_name, teacher_name,course_name) VALUES (?,?,?,?)");

        $stmt->bind_param("ssss", $email, $client_name, $teacher_name, $course_name); // "ssss" means that $id is bound as an integer and $label as a string
        

        /* Prepared statement, stage 2: bind and execute */
        if(!isset($data['email'])||!isset($data['client_name'])||!isset($data['course_name'])||!isset($data['teacher_name'])){
            if($_POST['email']!='' && $_POST['client_name']!='' && $_POST['course_name']!='' && $_POST['teacher_name']!='')
            {
                $email = $_POST['email'];
                $client_name = $_POST['client_name'];
                $course_name = $_POST['course_name'];
                $teacher_name = $_POST['teacher_name'];
                
            }else{
                echo "You did not completely fill the form, please do that again.";
                $this->connection->close();
                return;
            }

        }
        else{
            if($data['email']!='' && $data['client_name']!='' && $data['course_name']!='' && $data['teacher_name']!='')
            {
                $email = $data['email'];
                $client_name = $data['client_name'];
                $course_name = $data['course_name'];
                $teacher_name = $data['teacher_name']; 
                
            }else{
                echo "You did not completely fill the form, please do that again.";
                $this->connection->close();
                return;
            }
            
            
        }

        
        

        if($stmt->execute()===TRUE){

            $this->connection->close();
            return "Request submited successfully";

            // $student_course=new StudentCourseListModel();
            // $admin_order=new OrderListModel();
            // $student_course->postStudentCourseList();
            // $admin_order->postOrderList();
            
        } else {
            $this->connection->close();
            return "Error adding request: " .$this->connection->error;
        }
    }
        
}
?>
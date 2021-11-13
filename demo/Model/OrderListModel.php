<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";
 
class OrderListModel extends Database
{



    public function displayList(){
   
        $result=$this->getOrderList(100);
                            if(count ($result) > 0){
                                echo '<h2 class="pull-left">Orders</h2>';
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>Student name</th>";
                                            echo "<th>Student id</th>";
                                            echo "<th>Course name</th>";
                                            echo "<th>Teacher name</th>";
                                            echo "<th>Start Date</th>";
                                            echo "<th>End Date</th>";
                                            echo "<th>Tutition Fee</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    foreach ($result as $row){
                                        echo "<tr>";
                                            echo "<td>" . $row['order_id'] . "</td>";
                                            echo "<td>" . $row['student_name'] . "</td>";
                                            echo "<td>" . $row['student_id'] . "</td>";
                                            echo "<td>" . $row['course_name'] . "</td>";
                                            echo "<td>" . $row['teacher_name'] . "</td>";
                                            echo "<td>" . $row['start_date'] . "</td>";
                                            echo "<td>" . $row['end_date'] . "</td>";
                                            echo "<td>" . $row['salary'] . "</td>";

                                            echo "<td>";
                                                echo '<a href="approve-request.php?id='. $row['id'] .'" class="mr-3" title="Approve request" data-toggle="tooltip"><span class="fa fa-check"></span></a>';
                                                echo '<a href="delete.php?id='. $row['id'] .'" title="Ignore request" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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


    public function getOrderList($limit)
    {
        return $this->select("SELECT * FROM order_list LIMIT ?", ["i", $limit]);
    }

    // param need to be in order: course_name, description
    public function updateOrderList($order_id, $student_name,$student_id,$course_name, $start_date, $end_date, $salary)
    {
        try {
            $query="UPDATE order_list as p 
            SET p.student_name='$student_name',p.student_id='$student_id',p.course_name='$course_name', p.start_date='$start_date', p.end_date='$end_date', p.salary='$salary'
            WHERE p.order_id=$order_id";

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

    public function deleteOrderList(){
        
        try{
            $order_id=$_GET['order_id'];
            
            $query ="DELETE FROM order_list 
            WHERE order_id= '$order_id'";
            


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

    public function postOrderList(){
        $rest_json = file_get_contents('php://input');

        $data = json_decode($rest_json, true);
        // $student_name,$student_id,$course_name, $start_date, $end_date, $salary

        $stmt = $this->connection->prepare("INSERT INTO order_list(student_name,student_id, course_name,teacher_name, start_date,end_date,salary) VALUES (?,?,?,?,?,?,?)");

        $stmt->bind_param("sissssi", $student_name, $student_id, $course_name, $teacher_name, $start_date, $end_date, $salary); // "ssss" means that $id is bound as an integer and $label as a string
        
        if(!isset($data['student_name'])||!isset($data['student_id'])||!isset($data['course_name'])||!isset($data['teacher_name'])){
            if($_POST['student_name']!='' && $_POST['student_id']!='' && $_POST['course_name']!='' && $_POST['teacher_name']!='')
            {
                $student_name = $_POST['student_name'];
                $student_id = $_POST['student_id'];
                $course_name = $_POST['course_name'];
                $teacher_name = $_POST['teacher_name'];
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $salary = $_POST['salary'];
                
            }else{
                echo "You did not completely fill the form.., please do that again.";
                $this->connection->close();
                return;
            }

        }
        else{
            if($data['student_name']!='' && $data['student_id']!='' && $data['course_name']!='' && $data['teacher_name']!='')
            {
                $student_name = $data['student_name'];
                $student_id = $data['student_id'];
                $course_name = $data['course_name'];
                $teacher_name = $data['teacher_name'];
                $start_date = $data['start_date'];
                $end_date = $data['end_date'];
                $salary = $data['salary'];
                
            }else{
                echo "You did not completely fill the form..., please do that again.";
                $this->connection->close();
                return;
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
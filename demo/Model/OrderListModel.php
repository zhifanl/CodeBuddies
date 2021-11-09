<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";
 
class OrderListModel extends Database
{
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

        $_POST = json_decode($rest_json, true);
        // $student_name,$student_id,$course_name, $start_date, $end_date, $salary

        $stmt = $this->connection->prepare("INSERT INTO order_list(student_name,student_id, course_name,start_date,end_date,salary) VALUES (?,?,?,?,?,?)");

        $stmt->bind_param("sisssi", $student_name, $student_id, $course_name, $start_date, $end_date, $salary); // "ssss" means that $id is bound as an integer and $label as a string
        

        /* Prepared statement, stage 2: bind and execute */
        $student_name = $_POST['student_name'];
        $student_id = $_POST['student_id'];
        $course_name = $_POST['course_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $salary = $_POST['salary'];

        

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
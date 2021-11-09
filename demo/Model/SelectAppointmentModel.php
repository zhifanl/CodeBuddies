<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";
 
class SelectAppointmentModel extends Database
{
    public function getSelectAppointment($limit)
    {
        return $this->select("SELECT * FROM select_appointment LIMIT ?", ["i", $limit]);
    }

    // param need to be in order: course_name, description
    public function updateSelectAppointment($student_id,$appointment_id)
    {
        try {
            $query="UPDATE select_appointment as p 
            SET p.student_id='$student_id', p.appointment_id='$appointment_id'
            WHERE p.appointment_id='$appointment_id'";

            $stmt = $this->connection->prepare($query);
            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "SelectAppointment Record updated in list successfully";
                
            } else {
                $this->connection->close();
                return "Error updating SelectAppointment record: " .$this->connection->error;
            }
            
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
        
    }

    public function deleteSelectAppointment(){
        
        try{
            $appointment_id=$_GET['appointment_id'];
            
            $query ="DELETE FROM select_appointment 
            WHERE appointment_id= '$appointment_id'";
            


            $stmt = $this->connection->prepare($query);

            if ($stmt->execute() === TRUE) {
                $stmt->close();
                $this->connection->close();
                return "SelectAppointment Record deleted from list successfully";
                
            } else {
                $stmt->close();
                $this->connection->close();
                return "Error deleting SelectAppointment Record: " .$this->connection->error;
            }
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
    }

    public function postSelectAppointment(){
        $rest_json = file_get_contents('php://input');

        $_POST = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO select_appointment(student_id, appointment_id) VALUE (?,?)");

        $stmt->bind_param("ii", $student_id, $appointment_id); 
        

        /* Prepared statement, stage 2: bind and execute */
       
        $student_id = $_POST['student_id'];
        $appointment_id = $_POST['appointment_id'];


        if($stmt->execute()===TRUE){

            $this->connection->close();
            return "SelectAppointment Record added to list successfully";
            
        } else {
            $this->connection->close();
            return "Error adding SelectAppointment to list: " .$this->connection->error;
        }
    }
        
}
?>
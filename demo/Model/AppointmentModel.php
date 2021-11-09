<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";

class AppointmentModel extends Database
{
    public function getAppointment($limit)
    {
        return $this->select("SELECT * FROM appointment LIMIT ?", ["i", $limit]);
    }

    public function updateAppointment($id, $date, $admin_id)
    {
        try {
            $query = "UPDATE appointment as p 
            SET p.date='$date', p.admin_id = '$admin_id'
            WHERE p.id='$id'";

            $stmt = $this->connection->prepare($query);
            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "appointment updated successfully";
            } else {
                $this->connection->close();
                return "Error updating appointment: " . $this->connection->error;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteAppointment(){
        $id=$_GET['id'];
        try{
            
            $query =   "DELETE FROM appointment 
                        WHERE id ='$id'";

            $stmt = $this->connection->prepare($query);

            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "appointment deleted successfully";
                
            } else {
                $this->connection->close();
                return "Error deleting appointment: " .$this->connection->error;
            }
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
    }

    public function postAppointment(){
        $rest_json = file_get_contents('php://input');

        $_POST = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO appointment(date, admin_id) VALUES (?, ?)");

        /* Prepared statement, stage 2: bind and execute */
        $date = $_POST['date'];
        $admin_id = $_POST['admin_id'];

        $stmt->bind_param("ss", $date, $admin_id); // "is" means that $id is bound as an integer and $label as a string
        
        if($stmt->execute()===TRUE){

            $this->connection->close();
            return "appointment added successfully";
            
        } else {
            $this->connection->close();
            return "Error adding record: " .$this->connection->error;
        }
    }
}
?>

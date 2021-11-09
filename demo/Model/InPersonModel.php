<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";

class InPersonModel extends Database
{
    public function getInPerson($limit)
    {
        return $this->select("SELECT * FROM in_person LIMIT ?", ["i", $limit]);
    }

    public function updateInPerson($id, $location)
    {
        try {
            $query = "UPDATE in_person as p 
            SET p.location='$location' 
            WHERE p.id='$id'";

            $stmt = $this->connection->prepare($query);
            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "location updated successfully";
            } else {
                $this->connection->close();
                return "Error updating location: " . $this->connection->error;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteInPerson(){
        $id=$_GET['id'];
        try{
            
            $query =   "DELETE FROM in_person
                        WHERE id ='$id' ";

            $stmt = $this->connection->prepare($query);

            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "in_person deleted successfully";
                
            } else {
                $this->connection->close();
                return "Error deleting in_person: " .$this->connection->error;
            }
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
    }

    public function postInPerson(){
        $rest_json = file_get_contents('php://input');

        $_POST = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO in_person(id, location) VALUES (?, ?)");

        /* Prepared statement, stage 2: bind and execute */
        $id = $_POST['id'];
        $location = $_POST['location'];

        $stmt->bind_param("ss", $id, $location); // "is" means that $id is bound as an integer and $label as a string
        
        if($stmt->execute()===TRUE){

            $this->connection->close();
            return "in_person added successfully";
            
        } else {
            $this->connection->close();
            return "Error adding record: " .$this->connection->error;
        }
    }
}
?>

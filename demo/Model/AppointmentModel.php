<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";

class AppointmentModel extends Database
{
    public function displayList(){
   
        $result=$this->getAppointment(100);
                            if(count ($result) > 0){
                                echo '<h2 class="pull-left">Users</h2>';
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>date</th>";
                                            
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    foreach ($result as $row){
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['date'] . "</td>";
                                            
                                            echo "<td>";
                                                echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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

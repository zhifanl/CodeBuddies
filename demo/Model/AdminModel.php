<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";

class AdminModel extends Database
{
    public function getAdmin($limit)
    {
        return $this->select("SELECT * FROM admin LIMIT ?", ["i", $limit]);
    }

    public function updateAdmin($name, $password)
    {
        try {
            $query = "UPDATE admin as p 
            SET p.password='$password' 
            WHERE p.name='$name'";

            $stmt = $this->connection->prepare($query);
            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "password updated successfully";
            } else {
                $this->connection->close();
                return "Error updating password: " . $this->connection->error;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteAdmin(){
        $name=$_GET['name'];
        try{
            
            $query =   "DELETE FROM admin 
                        WHERE name ='$name' ";

            $stmt = $this->connection->prepare($query);

            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "admin deleted successfully";
                
            } else {
                $this->connection->close();
                return "Error deleting admin: " .$this->connection->error;
            }
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
    }

    public function postAdmin(){
        $rest_json = file_get_contents('php://input');

        $_POST = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO admin(name, password) VALUES (?, ?)");

        /* Prepared statement, stage 2: bind and execute */
        $username = $_POST['name'];
        $password = $_POST['password'];
        $param_password = password_hash($password, PASSWORD_BCRYPT );//hashed password

        $stmt->bind_param("ss", $username, $param_password); // "is" means that $id is bound as an integer and $label as a string
        
        if($stmt->execute()===TRUE){

            $this->connection->close();
            return "User added successfully";
            
        } else {
            $this->connection->close();
            return "Error adding record: " .$this->connection->error;
        }
    }
}
?>

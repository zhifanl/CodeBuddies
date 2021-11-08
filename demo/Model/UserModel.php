<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";
 
class UserModel extends Database
{
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM users LIMIT ?", ["i", $limit]);
    }

    // param need to be in order: name, email, uni, major,locaiton, description for the user.
    public function updateUsers($username,$name,$email,$university,$major,$location,$description)
    {
        try {
            $query="UPDATE users as p 
            SET p.name='$name', p.email= '$email', p.university='$university' , p.major= '$major',p.location='$location' ,p.description='$description'  
            WHERE p.username='$username'";

            $stmt = $this->connection->prepare($query);
            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "Record updated successfully";
                
            } else {
                $this->connection->close();
                return "Error updating record: " .$this->connection->error;
            }
            
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
        
    }

    public function deleteUser(){
        $username=$_GET['username'];
        try{
            
            $query =   "DELETE FROM users 
                        WHERE username ='$username' ";

            $stmt = $this->connection->prepare($query);

            if ($stmt->execute() === TRUE) {
                $this->connection->close();
                return "User deleted successfully";
                
            } else {
                $this->connection->close();
                return "Error deleting record: " .$this->connection->error;
            }
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }  
    }

    public function postUser(){
        $rest_json = file_get_contents('php://input');

        $_POST = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO users(username, password) VALUES (?, ?)");

        /* Prepared statement, stage 2: bind and execute */
        $username = $_POST['username'];
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
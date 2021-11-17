<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";
 
class UserModel extends Database
{

    public function displayList(){
   
        $result=$this->getUsers(100);
                        //  echo "<p>".$result."</p>";
                            if(count ($result) > 0){
                                echo '<h2 class="pull-left">Users</h2>';
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>username</th>";
                                            echo "<th>name</th>";
                                            echo "<th>email</th>";
                                            echo "<th>university</th>";
                                            echo "<th>major</th>";
                                            echo "<th>location</th>";
                                            echo "<th>description</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    foreach ($result as $row){
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['university'] . "</td>";
                                            echo "<td>" . $row['major'] . "</td>";
                                            echo "<td>" . $row['location'] . "</td>";
                                            echo "<td>" . $row['description'] . "</td>";
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
    

    public function getIdByUsername($username)
    {
       $result=$this->select("SELECT * FROM users WHERE username=?", ["s",$username]);
       // result is array here
        //    echo count($result); 
       foreach ($result as $row)
       {
        //    echo $row['ID'];
       return $row['ID'];
        }
    }

    public function getRealNameByUsername($username)
    {
       $result=$this->select("SELECT * FROM users WHERE username=?", ["s",$username]);
       // result is array here
        //    echo count($result); 
       foreach ($result as $row)
       {
        //    echo $row['ID'];
       return $row['name'];
        }
    }
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
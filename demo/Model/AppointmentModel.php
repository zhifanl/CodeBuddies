<?php
require_once  PROJECT_ROOT_PATH . "/Model/Database.php";

class AppointmentModel extends Database
{
    public function displayList(){
   
        $result=$this->getAppointment(100);
                            if(count ($result) > 0){
                                echo '<h2 class="pull-left">Appointments</h2>';
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            
                                            echo "<th>email</th>";
                                            echo "<th>user name</th>";
                                            echo "<th>teacher name</th>";
                                            echo "<th>course name</th>";
                                            echo "<th>date</th>";

                                            
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    foreach ($result as $row){
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "<td>" . $row['teacher_name'] . "</td>";
                                            echo "<td>" . $row['course_name'] . "</td>";
                                            echo "<td>" . $row['date'] . "</td>";
                                            echo "<td>";
                                                // echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                // echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                echo '<a href="./action-pages/delete-appointment.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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


    public function displayStudentAppointment(){
   
        $result=$this->getAppointmentByName();
                            if(count ($result) > 0){
                                echo '<h2 class="pull-left">Appointments</h2>';
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            
                                            echo "<th>email</th>";
                                            echo "<th>user name</th>";
                                            echo "<th>teacher name</th>";
                                            echo "<th>course name</th>";
                                            echo "<th>date</th>";

                                            
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    foreach ($result as $row){
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "<td>" . $row['teacher_name'] . "</td>";
                                            echo "<td>" . $row['course_name'] . "</td>";
                                            echo "<td>" . $row['date'] . "</td>";
                                            echo "<td>";
                                                // echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                // echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                echo '<a href="./action-pages/delete-appointment.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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

    public function getAppointmentByName()
    {
        return $this->select("SELECT * FROM appointment WHERE username=?", ["i",$_SESSION["username"]]); // need to have where id = ?
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

        $data = json_decode($rest_json, true);


        $stmt = $this->connection->prepare("INSERT INTO appointment(date, admin_id, email, username, teacher_name, course_name) VALUES (?, ?,?,?,?,?)");

        // echo $_POST['date'];
        // echo $_POST['email'];
        // echo $_POST['user_name'];
        // echo $_POST['teacher_name'];
        // echo $_POST['course_name'];
        // echo $_POST['admin_id'];

        if(!isset($data['date'])||!isset($data['email'])||!isset($data['user_name'])||!isset($data['teacher_name']) ||!isset($data['course_name'])){
                    if($_POST['date']!='' && $_POST['email']!='' && $_POST['user_name']!='' && $_POST['course_name']!='' && $_POST['teacher_name']!='')
                    {
                        $date = $_POST['date'];
                        $email = $_POST['email'];
                        $username = $_POST['user_name'];
                        $teacher_name = $_POST['teacher_name'];
                        $course_name = $_POST['course_name'];
                        $admin_id = $_POST['admin_id'];
                        
                    }else{
                        echo "You did not completely fill the form.., please do that again.";
                        $this->connection->close();
                        return;
                    }
        
        }
        else{
                if($data['date']!='' && $data['email']!='' && $data['user_name']!='' && $data['teacher_name']!='' && $data['course_name']!='')
                    {
                        $date = $data['date'];
                        $email = $data['email'];
                        $username = $data['user_name'];
                        $teacher_name = $data['teacher_name'];
                        $course_name = $data['course_name'];
                        $admin_id = $data['admin_id'];
                        
                    }else{
                        echo "You did not completely fill the form..., please do that again.";
                        $this->connection->close();
                        return;
                    }
            }
        

        $stmt->bind_param("sissss", $date, $admin_id, $email, $username, $teacher_name, $course_name); // "is" means that $id is bound as an integer and $label as a string
        
        if($stmt->execute()===TRUE){

            $this->connection->close();
            return "appointment added successfully";
            
        } else {
            $this->connection->close();
            return "Error adding record: " .$this->connection->error;
        }
    }

    // public function postOrderList(){
    //     $rest_json = file_get_contents('php://input');

    //     $data = json_decode($rest_json, true);
    //     // $student_name,$student_id,$course_name, $start_date, $end_date, $salary

    //     $stmt = $this->connection->prepare("INSERT INTO order_list(student_name,student_id, course_name,teacher_name, start_date,end_date,salary) VALUES (?,?,?,?,?,?,?)");

    //     $stmt->bind_param("sissssi", $student_name, $student_id, $course_name, $teacher_name, $start_date, $end_date, $salary); // "ssss" means that $id is bound as an integer and $label as a string
        
    //     
        

        

    //     if($stmt->execute()===TRUE){

    //         $this->connection->close();
    //         return "Course Record added to list successfully";
            
    //     } else {
    //         $this->connection->close();
    //         return "Error adding record to list: " .$this->connection->error;
    //     }
    // }
}
?>

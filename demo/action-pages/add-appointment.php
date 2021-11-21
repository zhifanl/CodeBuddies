<?php
// Include config file
require __DIR__ . "/../inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/Controller/api/RequestController.php";


if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['email']) && isset($_POST['user_name']) && isset($_POST['teacher_name']) && isset($_POST['course_name']) && isset($_POST['date']))
    {
        if($_POST['email']!='' && $_POST['user_name']!='' && $_POST['teacher_name']!='' && $_POST['course_name']!='' && $_POST['date']!='')
        {
        $request=new AppointmentModel();
        $result=$request->postAppointment(); //add to Request DB
        echo $result;
        echo '<br></br>';
        echo "<a class='w-50 btn btn-lg btn-primary' href='../welcomeAdmin.php'>Go Back</button>";


    }
    }

?>
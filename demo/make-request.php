<?php
// Include config file
require __DIR__ . "/inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/Controller/api/RequestController.php";

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['email']) && isset($_POST['client_name']) && isset($_POST['teacher_name']) && isset($_POST['course_name']))
    {
        $request=new RequestModel();
        $result=$request->postRequest();
        echo $result;
    }
?>
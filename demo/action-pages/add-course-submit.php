<?php
require __DIR__ . "/../inc/bootstrap.php";

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['course_name']) && isset($_POST['description']) && isset($_POST['tuition_fee']))
{
        if($_POST['course_name']!='' && $_POST['description']!='' && $_POST['tuition_fee']!='')
        {
        $request=new SoftwareCoursesModel();
        $result=$request->postSoftwareCourses(); 
        echo $result;
        echo '<br></br>';
        echo "<a class='w-50 btn btn-lg btn-primary' href='../welcomeAdmin.php'>Go Back</button>";
        }
}
?>
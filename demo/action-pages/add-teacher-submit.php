<?php
require __DIR__ . "/../inc/bootstrap.php";

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['teacher_name']))
{
        if($_POST['teacher_name']!='')
        {
        $request=new TeacherModel();
        $result=$request->postTeacher(); //add to Request DB
        echo $result;
        echo '<br></br>';
        echo "<a class='w-50 btn btn-lg btn-primary' href='../welcomeAdmin.php'>Go Back</button>";
        }
}
?>
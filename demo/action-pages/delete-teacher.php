<?php
// Include config file
require __DIR__ . "/../inc/bootstrap.php";
$teacher=new TeacherModel();

$_GET['teacher_name']=$teacher->getTeacherNameById($_GET['id']);

$result=$teacher->deleteTeacher();
echo $result;

echo '<br></br>';
echo "<a class='w-50 btn btn-lg btn-primary' href='../welcomeAdmin.php'>Go Back</button>";
?>


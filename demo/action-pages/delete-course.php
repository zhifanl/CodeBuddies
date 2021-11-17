<?php
// Include config file
require __DIR__ . "/../inc/bootstrap.php";

$id=$_GET['id'];
$course_temp=new SoftwareCoursesModel();
$resultOrder=$course_temp->getCourseById($id);

$course_name=$resultOrder['course_name'];

$_GET['course_name']=$course_name;
echo $_GET['course_name'];
$course_temp->deleteSoftwareCourses();

?>


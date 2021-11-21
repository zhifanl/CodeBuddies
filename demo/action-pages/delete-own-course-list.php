<?php
// Include config file
require __DIR__ . "/../inc/bootstrap.php";

$course_name=$_GET['course_name'];
$student_id=$_GET['student_id'];

$course_list=new StudentCourseListModel();
$course_list->deleteStudentCourseList($course_name, $student_id);

echo '<br></br>';
echo "<a class='w-50 btn btn-lg btn-primary' href='../welcome.php'>Go Back</button>";

?>
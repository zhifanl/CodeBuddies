<?php
// Include config file
require __DIR__ . "/../inc/bootstrap.php";

$id=$_GET['order_id'];
$order_temp=new OrderListModel();
$resultOrder=$order_temp->getOrderById($id);

$student_id=$resultOrder['student_id'];
$course_name=$resultOrder['course_name'];

$order=new OrderListModel();
$order->deleteOrderList();

$course=new StudentCourseListModel();

$_GET['student_id']=$student_id;
$_GET['course_name']=$course_name;

$course->deleteStudentCourseList($course_name ,$student_id);

?>


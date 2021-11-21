<?php
// Include config file
require __DIR__ . "/../inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/Controller/api/RequestController.php";
require PROJECT_ROOT_PATH . "/Controller/api/OrderListController.php";
$id=$_GET['id'];//id for the row that is being approved, will get its content and add to user's list
$order=new OrderListModel();
$resultOrder=$order->getOrderById($id);
$student_id=$resultOrder['student_id'];
$tuition_fee=$resultOrder['salary'];
$course_name=$resultOrder['course_name'];
$start_date=$resultOrder['start_date'];
$end_date=$resultOrder['end_date'];
$teacher_name=$resultOrder['teacher_name'];

$_POST['student_id']=$student_id;
$_POST['tuition_fee']=$tuition_fee;
$_POST['course_name']=$course_name;
$_POST['start_date']=$start_date;
$_POST['end_date']=$end_date;
$_POST['teacher_name']=$teacher_name;


$checkDuplicate=new StudentCourseListModel();
$result=$checkDuplicate->checkDuplicateOrder();
// echo $result;
if($result!=0){
    echo "It is already added to student's list. No need to approve again now.";
}else{
$course=new StudentCourseListModel();
$course->postStudentCourseList();
echo "Approved successfully, Added to client's course list already. ";

}
echo '<br></br>';
echo "<a class='w-50 btn btn-lg btn-primary' href='../welcomeAdmin.php'>Go Back</button>";

?>


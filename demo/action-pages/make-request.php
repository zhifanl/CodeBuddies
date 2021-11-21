<?php
// Include config file
require __DIR__ . "/../inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/Controller/api/RequestController.php";


if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['email']) && isset($_POST['client_name']) && isset($_POST['teacher_name']) && isset($_POST['course_name']))
    {
        if($_POST['email']!='' && $_POST['client_name']!='' && $_POST['teacher_name']!='' && $_POST['course_name']!='')
        {
        $request=new RequestModel();
        $result=$request->postRequest(); //add to Request DB
        echo $result;

        $temp_user=new UserModel();
        echo '<br>';
        echo "Dear ";
        echo $_POST['client_name'];
        

        $client_id=$temp_user->getIdByUsername($_POST['client_name']);
        $client_name=$temp_user->getRealNameByUsername($_POST['client_name']);
        


        $temp_course=new SoftwareCoursesModel();
        $tuition_fee=$temp_course->getFeeByName($_POST['course_name']);
        echo "got tutiton fee : ";
        echo $tuition_fee;
        // echo $client_id;
        $_POST['student_name']=$client_name;
        $_POST['student_id']=$client_id;
        // $_POST['teacher_name']=$_POST['teacher_name'];
        // $_POST['course_name']=$_POST['course_name'];
        $_POST['start_date']='NULL';
        $_POST['end_date']='NULL';
        $_POST['salary']=$tuition_fee;


        $order=new OrderListModel();
        $order->postOrderList();
        echo '<br>';
        echo "Your oder has been added to Admin's order list, it will be confirmed soon ."; 
    }else{
        echo "Form not filled completed, enter them again";
    }
    }
    echo '<br></br>';
    echo "<a class='w-50 btn btn-lg btn-primary' href='../welcome.php'>Go Back</button>";

?>
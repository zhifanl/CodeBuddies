<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/product/">
    <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <title>Welcome</title>
        <link rel="stylesheet" href="./css/welcomeAdmin.css">
        <style>
            body{ font: 12px sans-serif; text-align: center; }
        </style>

</head>

    <body>
        <h2 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
        <p>
            <!-- <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a> -->
            <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        </p>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 1000px;  /* width of the row */
            /* margin: 0 auto; */
            margin-top: 100px;
            margin-bottom: 100px;
            margin-right: 150px;
            margin-left: 80px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-20">
                    <div class="mt-15 mb-15 clearfix">
                        
                     
                    <!-- <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a> -->
                    </div>
                    <?php
                    require_once "./inc/bootstrap.php";
                    require_once "./inc/config.php";
                    require_once "./Model/SoftwareCoursesModel.php"; // for adding deleting courses
                    require_once "./Model/OrderListModel.php"; // for the complete order list
                    require_once "./Model/TeacherModel.php"; // for looking at the available teachers
                    require_once "./Model/UserModel.php"; // for looking for available users
                    require_once "./Model/RequestModel.php"; // for seeing the student's requests.
                    require_once "./Model/RequestModel.php";// for booking appointments, recording them in the database
                    require_once "./Model/AppointmentModel.php";// for booking appointments, recording them in the database
                    
                    $order=new OrderListModel(); // see orders
                    $order->displayList();

                    $request=new RequestModel(); // see requests
                    $request->displayList();

                    echo '<div class="b-example-divider"></div>';

                    $listTeacher=new TeacherModel(); // see teachers
                    $listTeacher->displayList();

                    $listCourses=new SoftwareCoursesModel(); // see courses
                    $listCourses->displayList(); 

                    $listUser=new UserModel();  // see users
                    $listUser->displayList();

                    // $lists=new StudentCourseListModel(); // now it is displaying the whole list of courses for all users.
                    // $lists->displayList();

                    $appointmentList=new AppointmentModel(); // display a list of appointments
                    $appointmentList->displayList();


                    ?>
                </div>
            </div>        
        </div>
    </div>
    <div class='b-example-divider'></div>
    
    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


<!-- <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <div class="bg-light me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 p-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
    </div>
    <div class="bg-light me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 py-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
    </div>
  </div> -->
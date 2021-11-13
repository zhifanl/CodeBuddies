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
        <link rel="stylesheet" href="./css/welcome.css">
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
                    require_once "./Model/SoftwareCoursesModel.php";
                    require_once "./Model/StudentCourseListModel.php";
                    require_once "./Model/TeacherModel.php";

                    $course=new SoftwareCoursesModel();
                    $course->displayList();

                    echo '<div class="b-example-divider"></div>';

                    $listTeacher=new TeacherModel();
                    $listTeacher->displayList();

                    // echo "my id is ".$_SESSION['id']; // for debugging
                    $lists=new StudentCourseListModel();// now it is displaying the whole list. need to modify it later(use a different method)
                    $lists->displayList();

                     
                    ?>
                </div>
            </div>        
        </div>
    </div>
    <div class='b-example-divider'></div>
    <div class="col-md-10 mx-auto col-lg-5">
    <form id="updateForm"class="p-5 p-md-5 border rounded-6 bg-light"  action="update-info.php" method="post">
    <!-- <label for="updateForm" >Update your information</label> -->
    <h2 for="updateForm" >Update your information</h2>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">User Name</label>
            <input name="username" class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder=<?php echo $_SESSION["username"]?>>
            <label for="exampleFormControlTextarea2" class="form-label">Real Name</label>
            <textarea name="name" class="form-control" id="exampleFormControlTextarea2" rows="1"></textarea>
            <label for="exampleFormControlTextarea3" class="form-label">Email</label>
            <textarea name="email" class="form-control" id="exampleFormControlTextarea3" rows="1"></textarea>
            <label for="exampleFormControlTextarea4" class="form-label">University</label>
            <textarea name="university" class="form-control" id="exampleFormControlTextarea4" rows="1"></textarea>
            <label for="exampleFormControlTextarea5" class="form-label">Major</label>
            <textarea name="major" class="form-control" id="exampleFormControlTextarea5" rows="1"></textarea>
            <label for="exampleFormControlTextarea6" class="form-label">Location</label>
            <textarea name="location" class="form-control" id="exampleFormControlTextarea6" rows="1"></textarea>
            <label for="exampleFormControlTextarea7" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="exampleFormControlTextarea7" rows="1"></textarea>
            
        </div>
        <button class="w-60 btn btn-lg btn-primary" type="submit">Submit</button>
          <hr class="my-4">
          <small class="text-muted">Enter all the fields above.</small>
    </form>
    </div>



    <div class="col-md-10 mx-auto col-lg-5">
    <form id="makeRequest"class="p-5 p-md-5 border rounded-6 bg-light"  action="make-request.php" method="post">
    <!-- <label for="updateForm" >Update your information</label> -->
    <h2 for="updateForm" >Order your course here</h2>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1"  class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder=<?php echo $_SESSION["email"]?>>
            <label for="exampleFormControlTextarea2" class="form-label">User Name</label>
            <textarea name="client_name" class="form-control" id="exampleFormControlTextarea2" rows="1"></textarea>
            <label for="exampleFormControlTextarea3" class="form-label">Teacher Name</label>
            <textarea name="teacher_name" class="form-control" id="exampleFormControlTextarea3" rows="1"></textarea>
            <label for="exampleFormControlTextarea4" class="form-label">Course Name</label>
            <textarea name="course_name" class="form-control" id="exampleFormControlTextarea4" rows="1"></textarea>
            
            
        </div>
        <button class="w-60 btn btn-lg btn-primary" type="submit">Submit</button>
          <hr class="my-4">
          <small class="text-muted">Enter all the fields above.</small>
    </form>
    </div>





    <!-- <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-20">
                    <div class="mt-15 mb-15 clearfix">
                        <!-- <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a> -->
                    <!-- </div>
                    <?php
                    require_once "./inc/bootstrap.php";
                    require_once "./inc/config.php";
                    require_once "./Model/RequestModel.php";
                     $request=new RequestModel();
                     $request->displayList();
                    echo '<div class="b-example-divider"></div>';
                    ?>
                </div>
            </div>        
        </div>
    </div>  -->


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
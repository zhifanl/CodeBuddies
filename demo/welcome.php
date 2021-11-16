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
    <link href="./css/table-style.css" rel="stylesheet">


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
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="./index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                <span class="fs-4" >Code Buddies</span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item"><a href="./welcome.php" class="nav-link active"><?php echo "Hi, ".htmlspecialchars($_SESSION["username"]); ?></a></li>
                <li class="nav-item"><a href="./logout.php" class="nav-link">Log out</a></li>
                <li class="nav-item"><a href="./" class="nav-link" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="./courses.php" class="nav-link">Courses</a></li>
                <li class="nav-item"><a href="./about.php" class="nav-link">About</a></li>
            </ul>
            </header>
        </div>
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

                    echo '<div class="divider"></div>';

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
    <div class="col-md-10 mx-auto col-lg-5">
    <form id="updateForm"class="p-5 p-md-5 border rounded-6 bg-light"  action="./action-pages/update-info.php" method="post">
    <!-- <label for="updateForm" >Update your information</label> -->
    <h2 for="updateForm" class="table-title" >Update your information</h2>

        <!-- <div class="mb-3"> -->
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
            
        <!-- </div> -->
        <button class="w-60 btn btn-lg btn-primary" type="submit">Submit</button>
          <hr class="my-4">
          <small class="text-muted">Enter all the fields above.</small>
    </form>
    </div>

    <div class="empty-space"></div>

    <div class="col-md-10 mx-auto col-lg-5">
    <form id="makeRequest"class="p-5 p-md-5 border rounded-6 bg-light"  action="./action-pages/make-request.php" method="post">
    <!-- <label for="updateForm" >Update your information</label> -->
    <h2 for="updateForm" >Order your course here</h2>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1"  class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder=<?php echo $_SESSION["email"]?>>
            <label for="exampleFormControlTextarea2" class="form-label">User Name</label>
            <textarea name="client_name" class="form-control" id="exampleFormControlTextarea2" rows="1" placeholder=<?php echo $_SESSION["username"]?>></textarea>
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
    
    <div class="empty-space"></div>

    <div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
      <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
          <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
        </a>
        <span class="text-muted">Code Buddies; 2021 Company, Inc</span>
      </div>
  
      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
        <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
        <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
      </ul>
    </footer>
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
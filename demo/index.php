<?php
// Include config file
require __DIR__ . "/inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/Controller/api/UserController.php";
require PROJECT_ROOT_PATH . "/Controller/api/SoftwareCoursesController.php";
require PROJECT_ROOT_PATH . "/Controller/api/StudentCourseListController.php";
require PROJECT_ROOT_PATH . "/Controller/api/AdminController.php";
require PROJECT_ROOT_PATH . "/Controller/api/TeacherController.php";
require PROJECT_ROOT_PATH . "/Controller/api/SelectAppointmentController.php";
require PROJECT_ROOT_PATH . "/Controller/api/RequestController.php";
require PROJECT_ROOT_PATH . "/Controller/api/OrderListController.php";
require PROJECT_ROOT_PATH . "/Controller/api/AppointmentController.php";
require PROJECT_ROOT_PATH . "/Controller/api/FulfillRequestTeacherController.php";
require PROJECT_ROOT_PATH . "/Controller/api/InPersonController.php";
require PROJECT_ROOT_PATH . "/Controller/api/MakeRequestController.php";


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );


// localhost/demo/index.php/user/list
if (count($uri)>3 && (isset($uri[3]) && $uri[3] == 'user') && $uri[4] == 'list') {
    $objFeedController = new UserController();
    $strMethodName = $uri[4] . 'Action'; //$uri[3] is list, added Action to call the corresponding method
    $objFeedController->{$strMethodName}($uri);
}

if (count($uri)>3 && (isset($uri[3]) && $uri[3] == 'admin') && $uri[4] == 'list') {
    $objFeedController = new AdminController();
    $strMethodName = $uri[4] . 'Action'; //$uri[3] is list, added Action to call the corresponding method
    $objFeedController->{$strMethodName}($uri);
}

if (count($uri)>3 && (isset($uri[3]) && $uri[3] == 'software_courses') && $uri[4] == 'list') {
    $objFeedController = new SoftwareCoursesController();
    $strMethodName = $uri[4] . 'Action'; //$uri[3] is list, added Action to call the corresponding method
    $objFeedController->{$strMethodName}($uri);
}
if (count($uri)>3 && (isset($uri[3]) && $uri[3] == 'student_course_list') && $uri[4] == 'list') {
    $objFeedController = new StudentCourseListController();
    $strMethodName = $uri[4] . 'Action'; //$uri[3] is list, added Action to call the corresponding method
    $objFeedController->{$strMethodName}($uri);
}

if (count($uri)>3 && (isset($uri[3]) && $uri[3] == 'teacher') && $uri[4] == 'list') {
    $objFeedController = new TeacherController();
    $strMethodName = $uri[4] . 'Action'; //$uri[3] is list, added Action to call the corresponding method
    $objFeedController->{$strMethodName}($uri);
}

if (count($uri)>3 && (isset($uri[3]) && $uri[3] == 'select_appointment') && $uri[4] == 'list') {
    $objFeedController = new SelectAppointmentController();
    $strMethodName = $uri[4] . 'Action'; //$uri[3] is list, added Action to call the corresponding method
    $objFeedController->{$strMethodName}($uri);
}

if (count($uri)>3 && (isset($uri[3]) && $uri[3] == 'request') && $uri[4] == 'list') {
    $objFeedController = new RequestController();
    $strMethodName = $uri[4] . 'Action'; //$uri[3] is list, added Action to call the corresponding method
    $objFeedController->{$strMethodName}($uri);
}

if (count($uri)>3 && (isset($uri[3]) && $uri[3] == 'order_list') && $uri[4] == 'list') {
    $objFeedController = new OrderListController();
    $strMethodName = $uri[4] . 'Action'; //$uri[3] is list, added Action to call the corresponding method
    $objFeedController->{$strMethodName}($uri);
}

if (count($uri)>3 && (isset($uri[3]) && $uri[3] == 'appointment') && $uri[4] == 'list') {
    $objFeedController = new AppointmentController();
    $strMethodName = $uri[4] . 'Action'; //$uri[3] is list, added Action to call the corresponding method
    $objFeedController->{$strMethodName}($uri);
}


if (count($uri)>3 && (isset($uri[3]) && $uri[3] == 'fulfill_request_teacher') && $uri[4] == 'list') {
    $objFeedController = new FulfillRequestTeacherController();
    $strMethodName = $uri[4] . 'Action'; //$uri[3] is list, added Action to call the corresponding method
    $objFeedController->{$strMethodName}($uri);
}

if (count($uri)>3 && (isset($uri[3]) && $uri[3] == 'in_person') && $uri[4] == 'list') {
    $objFeedController = new InPersonController();
    $strMethodName = $uri[4] . 'Action'; //$uri[3] is list, added Action to call the corresponding method
    $objFeedController->{$strMethodName}($uri);
}

if (count($uri)>3 && (isset($uri[3]) && $uri[3] == 'make_request') && $uri[4] == 'list') {
    $objFeedController = new MakeRequestController();
    $strMethodName = $uri[4] . 'Action'; //$uri[3] is list, added Action to call the corresponding method
    $objFeedController->{$strMethodName}($uri);
}




// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username); //bind to stmt, "s" means string type, and the rests are var names; return boolean true or false
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later...";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password); //"ss" means two strings as args.
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_BCRYPT ); // Creates a password hash
            // $param_password=$password;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later....";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>



<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/heroes/">

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

    <!-- Custom styles for this template -->
    <link href="heroes.css" rel="stylesheet">
  </head>
  <body>
<main>

  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="./index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-4">Code Buddies</span>
      </a>

      <ul class="nav nav-pills">
        <li class="nav-item"><a href="./" class="nav-link active" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="./courses.php" class="nav-link">Courses</a></li>
        <li class="nav-item"><a href="./about.php" class="nav-link">About</a></li>
      </ul>
    </header>
  </div>

  
  <div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-xxl-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="./img/CodeBuddies.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="1300" height="1300" loading="lazy">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3">Code Buddies</h1>
        <p class="lead">fast and innovative way to learn about programming</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <button type="button" class="btn btn-primary btn-lg px-4 me-md-2" onclick="location.href='login.php'" >Login</button>
          
          <!-- <button type="button" class="btn btn-outline-secondary btn-lg px-4">Register</button> -->
        </div>
        <!-- <small class="text-muted">Scroll down to register</small> -->
      </div>
    </div>
  </div>

  <div class="b-example-divider"></div>

  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 mb-3">Sign up here</h1>
        <p class="col-lg-10 fs-4">Join our community to boost your programming skills</p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <form class="p-4 p-md-5 border rounded-3 bg-light"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="form-floating mb-3">

            <input type="text" name="username"  id="floatingInput" placeholder="name@example.com" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
            <label for="floatingInput">Username</label>
          </div>

          <div class="form-floating mb-3">
          
            <input type="password" name="password" id="floatingPassword" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
            <label for="floatingPassword">Password</label>

            
          </div>

          <div class="form-floating mb-3">
                <input type="password" name="confirm_password" id="floatingPassword" placeholder="Password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                <label for="floatingPassword">Confirm Password</label>
          </div>

          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <button class="w-50 btn btn-lg btn-primary" type="submit">Sign up</button>
          <p>Already have an account? <a href="login.php">Login here</a></p>
          <hr class="my-4">
          <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
        </form>
      </div>
    </div>
  </div>
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

</main>


  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>

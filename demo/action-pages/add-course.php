<?php
session_start();
if( $_SESSION["admin"] !== true){
    header("location: ../login.php");
    exit;
}

?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Course</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/table-style.css">

    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>


<div class="col-md-10 mx-auto col-lg-5">
    <form id="addTeacher"class="p-5 p-md-5 border rounded-6 bg-light"  action="./add-course-submit.php" method="post">
    <!-- <label for="updateForm" >Update your information</label> -->
    <h2 for="updateForm" >Add Course Here</h2>

        <div class="mb-3">
            <label for="exampleFormControlTextarea3" class="form-label">Course Name</label>
            <textarea name="course_name" class="form-control" id="exampleFormControlTextarea3" rows="1" placeholder="Enter Course Name"></textarea>
            <label for="exampleFormControlTextarea3" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="exampleFormControlTextarea3" rows="1" placeholder="Enter Description"></textarea>
            <label for="exampleFormControlTextarea3" class="form-label">Tuition Fee</label>
            <textarea name="tuition_fee" class="form-control" id="exampleFormControlTextarea3" rows="1" placeholder="Enter Tuition Fee"></textarea>
        
        </div>
        <button class="w-60 btn btn-lg btn-primary" type="submit">Submit</button>
          <hr class="my-4">
          <small class="text-muted">Enter all the fields above.</small>
    </form>
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

</body>
</html>
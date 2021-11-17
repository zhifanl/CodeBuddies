<?php
// Include config file
require __DIR__ . "/inc/bootstrap.php";


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
    <link href="./css/table-style.css" rel="stylesheet">
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
        <li class="nav-item"><a href="./" class="nav-link" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="./courses.php" class="nav-link active">Courses</a></li>
        <li class="nav-item"><a href="./about.php" class="nav-link">About</a></li>
      </ul>
    </header>
  </div>


  
   <?php
   $courseModel= new SoftwareCoursesModel();
   $result=$courseModel->getSoftwareCourses(100);
                       if(count ($result) > 0){
                           echo '<h2 class="course-page-table-title">Courses</h2>';
                           echo '<div class="course-page mx-auto">';
                           echo '<table class="table table-bordered table-striped courses">';
                               echo "<thead>";
                                   echo "<tr>";
                                       echo "<th>#</th>";
                                       echo "<th>Course Name</th>";
                                       echo "<th>Description</th>";
                                       echo "<th>Tuition Fee</th>";

                                   echo "</tr>";
                               echo "</thead>";
                               echo "<tbody>";
                               foreach ($result as $row){
                                   echo "<tr>";
                                       echo "<td>" . $row['id'] . "</td>";
                                       echo "<td>" . $row['course_name'] . "</td>";
                                       echo "<td>" . $row['description'] . "</td>";
                                       echo "<td>" . $row['tuition_fee'] . "</td>";

                                       // echo "<td>";
                                       //     echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                       //     echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                       //     echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                       // echo "</td>";
                                   echo "</tr>";
                               }
                               echo "</tbody>";                            
                           echo "</table>";
                           echo '</div>';
                           // Free result set
                       } else{
                           echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                       }
   ?>

  
  

  
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

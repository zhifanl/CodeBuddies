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
        <link href="./css/about-us.css" rel="stylesheet">

        <title>Add Map</title>

        <link rel="stylesheet" type="text/css" href="./css/map-style.css" />
        <script src="./js/map.js"></script>
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
            <li class="nav-item"><a href="./courses.php" class="nav-link ">Courses</a></li>
            <li class="nav-item"><a href="./about.php" class="nav-link active">About</a></li>
          </ul>
        </header>
      </div>

  

    <body>
      <div class="empty-space"></div>
      <h4 class="map-title">Where we at</h4>
      <!--The div element for the map -->
      <div id="map"></div>
      <div class="empty-space"></div>
      <p class="introduction">Our team is made up with 3 software engineering students at the University of Calgary with 
          professional experience in the job industry and school. All of our team members have excellent grades at school with GPA above 3.90 and
          The solution we have devised is to provide clients with one on one tutoring sessions. 
          This is to aid them when they struggle with a programming problem or if they need further clarification on high yield programming topics. 
          In today’s remote technological age, most businesses are going online and that is exactly how we intend to conduct business. 
          CodeBuddies will enable our clients to make a variety of choices; to make orders, select appointments, and talk to their mentors, ask any problems that they do not understand.

      </p>

    
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
   <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
   <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZzIIBUxobXAOBRLDdFeKjlyIwmpt0F2I&callback=initMap&libraries=&v=weekly"
      async
    ></script>

      
  </body>
</html>

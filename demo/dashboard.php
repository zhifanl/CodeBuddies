<!DOCTYPE html>


<?php 
    session_start();
    $session_value=(isset($_SESSION['user']))?$_SESSION['user']:'';
    $session_value=(isset($_SESSION['id']))?$_SESSION['id']:'';
?>

<html>

    <head>
        <title>My Dashboard</title>
        <meta name="viewport" content="width=device-width", initial scale =1.0>
        <link rel="stylesheet" href="./css/dashboard.css">
        <script type="text/javascript" src="./js/core.js"> </script>

        <script>

            var dashboard = "dashboard";
            var appointments = "appointments"; 
            var tests = "tests";
            var prescriptions = "prescriptions";

        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

        <script>
            var name = "index";
            /* This is for the smooth scroll animation using jquery I included it in this file as it is easier to understand here */
            /* This adds a function on click for tags of a (hyperlinks) with the pound in front i.e. internal links */
            $(document).on('click', 'a[href^="#"]', function (e) {
                /* This prevents the default scrolling behaviour (which is just blinking there) */
                e.preventDefault();
                $('html, body').stop().animate({
                    /* This specifies that we should scroll to the top of the tag with the correct offset in */
                    /* a time of 250 milliseconds with a linear effect */
                    scrollTop: $($(this).attr('href')).offset().top - 80
                }, 250, 'linear');
            });
        </script>
    </head>

    <body>

        <nav id="global_nav">
            <div class="content_desk">

                <div class="sidebar">
                    <span id="scroll_desk"  class="scroll_bar dashboard"></span>
                    <ul class="logo_desk">
                        <h1 class="logo_writing_desk">My Dashboard</h1>
                        <div class="maple_image_desk"></div>
                    </ul>
                    <div class="menu_desk">
                        <div class="dashboard_desk">
                            <div class="dashboard_desk_image"></div>
                            <a class="dashboard_desk_writing" href="#dashboard" onclick="scrollAnimation(scroll_desk, dashboard)">Dashboard</a>
                        </div>
                        <div class="appointments_desk">
                            <div class="appointments_desk_image"></div>
                            <a class="appointments_desk_writing" href="#appointments" onclick="scrollAnimation(scroll_desk, appointments)">Appointments</a>
                        </div>
                        <div class="prescriptions_desk">
                            <div class="prescriptions_desk_image"></div>
                            <a class="prescriptions_desk_writing" href="#prescriptions" onclick="scrollAnimation(scroll_desk, prescriptions)">Prescriptions</a>
                        </div>
                        <div class="tests_desk">
                            <div class="tests_desk_image"></div>
                            <a class="tests_desk_writing" href="#tests" onclick="scrollAnimation(scroll_desk, tests)">Tests</a>
                        </div>
                        <a href='../Database/api/object_methods/account/logout.php' class="logout_desk">Logout</a>
                    </div>
                </div>
            </div>

            </div>
            <!-- For the mobile website -->
            <div class="content_mobile">
                <!-- We want to display this all the time, so we have our logo as well as the menu button -->
                <ul class="content_nav">
                    <ul class="logo_mobile">
                        <h1 class="logo_mobile_writing">My Dashboard</h1>
                        <div class="maple_image_mobile"></div>
                    </ul>
                    <!-- This specifies a function smoothscroll to execute when a user clicks on our menu -->
                    <li onclick="smoothScroll(global_nav, list_menu)" class="menu_mobile" id="nav_menu">
                        <span class="top_button"></span>
                        <span class="bottom_button"></span>
                    </li>
                </ul>
                <!-- The defualt behavior is to hide this menu, an id will be added to the super tag global_nav when this list is expanded and collapsed and when the list is active -->
                <li class="list" id="list_menu">
                    <!-- All the buttons we need in the menu -->
                    <a href=#global_nav class="dashboard_mobile">Dashboard</a>
                    <a href=#appointments class="appoint_mobile">Appointments</a>
                    <a href=#prescriptions class="pres_mobile">Prescriptions</a>
                    <a href=#tests class="tests_mobile">Tests</a>
                    <a href='../Database/api/object_methods/account/logout.php' class="logout_mobile">Logout</a>
                </li>
        </nav>

        <!--
        <header id="dashboard" class="dash_page">
            <h1>Dashboard</h1>
        </header>
        -->

        <div id="header" class="head_desk"></div>

        <div id="dashboard" class="dash_page"></div>

        <div id="appointments" class="appointments_page"></div>

        <div id="prescriptions" class="pers_page"></div>

        <div id="tests" class="test_page"></div>

        <!--
        <section id="appointments" class="appointments_page">
            <h1>Appointments</h1>
        </section>
        -->

        


        <script src="https://unpkg.com/react@17/umd/react.development.js" crossorigin></script>
        <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js" crossorigin></script>
        <script src="https://unpkg.com/react-table@7.6.3/dist/react-table.development.js" crossorigin></script>
        <script src="js/dash.js"></script>

    </body>




</html>
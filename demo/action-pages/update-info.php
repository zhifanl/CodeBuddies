<?php
// Include config file
require __DIR__ . "/../inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/Controller/api/UserController.php";

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['username']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['university']) && isset($_POST['major'])&& isset($_POST['location'])&& isset($_POST['description']))
    {
        if($_POST['username']!='' && $_POST['name']!='' && $_POST['email']!='' && $_POST['university']!='' && $_POST['major']!='' && $_POST['location']!='' && $_POST['description']!='')
        {
        echo "Result updated";
        $user=new UserModel();
        $result=$user->updateUsers($_POST['username'], $_POST['name'],$_POST['email'], $_POST['university'], $_POST['major'], $_POST['location'],$_POST['description']);
        echo "\n";
        echo $result;
        $_SESSION["email"]=$_POST['email'];
        }else{
            echo "Form not filled completed, enter them again";
        }
    }
?>
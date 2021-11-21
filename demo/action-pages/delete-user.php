<?php
// Include config file
require __DIR__ . "/../inc/bootstrap.php";
$user=new UserModel();
$_GET['username']=$user->getUsernameById($_GET['id']);
echo $_GET['id'];
echo $_GET['username'];
$result=$user->deleteUser();
echo $result;

echo '<br></br>';
echo "<a class='w-50 btn btn-lg btn-primary' href='../welcomeAdmin.php'>Go Back</button>";

?>


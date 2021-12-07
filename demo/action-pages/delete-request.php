<?php
// Include config file
require __DIR__ . "/../inc/bootstrap.php";

$id=$_GET['request_id'];
echo "Request: ".$id." is to be deleted.";
$request_temp=new RequestModel();

echo '<br></br>';
echo $request_temp->deleteRequest();

echo '<br></br>';
echo "<a class='w-50 btn btn-lg btn-primary' href='../welcomeAdmin.php'>Go Back</button>";

?>


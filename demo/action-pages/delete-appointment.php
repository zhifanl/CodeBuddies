<?php
// Include config file
require __DIR__ . "/../inc/bootstrap.php";
$appointment=new AppointmentModel();
$result=$appointment->deleteAppointment();
echo $result;
echo '<br></br>';
echo "<a class='w-50 btn btn-lg btn-primary' href='../welcomeAdmin.php'>Go Back</button>";

?>


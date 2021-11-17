<?php
// Include config file
require __DIR__ . "/../inc/bootstrap.php";
$appointment=new AppointmentModel();
$result=$appointment->deleteAppointment();
echo $result;

?>


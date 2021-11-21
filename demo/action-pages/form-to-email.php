<?php
  $name = $_POST['name'];
  $visitor_email = $_POST['email'];
  $message = $_POST['message'];

$email_from = 'zhifanli2000@gmail.com';

$email_subject = "New Appointment Notification";

$email_body = "You have received a new message, $name.\n".
                            "Here is the message:\n $message";

$to = $visitor_email;

$headers = "From: $email_from \r\n";

$headers .= "Reply-To: $visitor_email \r\n";

mail($to,$email_subject,$email_body,$headers);

echo "message sent";
?>
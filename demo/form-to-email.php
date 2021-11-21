<?php

require_once 'sendgrid-php/sendgrid-php.php';
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

echo "About to send ".$visitor_email." an email. ";
$email = new \SendGrid\Mail\Mail();
$email->setFrom("tom@aishading.com", "CodeBuddies Admin");
$email->setSubject("Message From CodeBuddies");
$email->addTo($visitor_email, "User: ".$name);
$email->addContent("text/plain", $message);
echo getenv('SENDGRID_API_KEY');
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
    echo "Email is sent";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
echo '<br></br>';
echo "<a class='w-50 btn btn-lg btn-primary' href='welcomeAdmin.php'>Go Back</button>";
?>


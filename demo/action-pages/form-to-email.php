<?php

require_once '../sendgrid-php/sendgrid-php.php';
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];
$api_key='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';

echo "About to send ".$visitor_email." an email. ";
$email = new \SendGrid\Mail\Mail();
$email->setFrom("tom@aishading.com", "CodeBuddies Admin");
$email->setSubject("Message From CodeBuddies");
$email->addTo($visitor_email, "User: ".$name);
$email->addContent("text/plain", $message);
$sendgrid = new \SendGrid($api_key);
try {
    $response = $sendgrid->send($email);
    // print $response->statusCode() . "\n";
    // print_r($response->headers());
    // print $response->body() . "\n";
    echo "Email is sent";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
echo '<br></br>';
echo "<a class='w-50 btn btn-lg btn-primary' href='../welcomeAdmin.php'>Go Back</button>";
?>


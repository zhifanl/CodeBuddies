<?php

session_start();
session_destroy();
echo "You have logged out.";
echo '<br></br>';
echo "<a class='w-50 btn btn-lg btn-primary' href='index.php'>Go Back</button>";
?>
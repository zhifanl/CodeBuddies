<?php

// Create connection
$con=mysqli_connect("localhost","root","","471");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
if ($_GET["job"] == "update"){

$ID = $_POST["ID"];
$name = $_POST["name"];
$email = $_POST["email"];
 
$result = mysqli_query($con,"update Users set name='".$name. "', email='". $email. "' where ID=". $ID);

} 
  
if ($_GET["job"] == "delete"){
$ID = $_GET["ID"];
$result = mysqli_query($con,"Delete from Users where ID=". $ID );

}

$result = mysqli_query($con,"SELECT * FROM Users");

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['ID'] . "</td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Email'] . "</td>";
  echo "<td><a href='update.php?ID= " . $row['ID'] . "'>Update</a></td>";
  echo "<td><a onClick= \"return confirm('Do you want to delete this user?')\" href='view.php?job=delete&amp;ID= " . $row['ID'] . "'>DELETE</a></td>";
  
  echo "</tr>";
  }
echo "</table>";




mysqli_close($con);
?>

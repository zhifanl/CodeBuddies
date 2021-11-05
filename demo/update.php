
<?php

$ID = $_GET["ID"];

// Create connection
$con=mysqli_connect("localhost","root","","471");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$result = mysqli_query($con,"SELECT * FROM Users where ID=".$ID);

 while($row = mysqli_fetch_array($result))
  {
 
 ?>
 
 <form action="view.php?job=update" method="post">
   <input name="ID" type="hidden" value=<?php echo $row['ID'];?>>
   Name: <input type="text" name="name" value=<?php echo $row['Name'];?>><br>
   E-mail: <input type="text" name="email" value=<?php echo $row['Email'];?>><br>
   <input type="submit" value="Update">
</form>
  
<?php

}

mysqli_close($con);
?>


<?php

include("database.php");
$query = "SELECT * FROM admin WHERE username = 'raj'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$password = $row["password"];

?>
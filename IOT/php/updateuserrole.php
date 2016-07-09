<?php

//Update role of user

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$user=$_POST['user'];
$role=$_POST['role'];
$query="UPDATE users SET user_type='$role' WHERE username='$user'";
$result=mysqli_query($dbc,$query) or die('error querying');
?>
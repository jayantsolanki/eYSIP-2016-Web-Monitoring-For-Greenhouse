<?php

//Delete a schedule

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$id=$_POST['id'];
$query="DELETE FROM tasks WHERE id='$id'";
$result=mysqli_query($dbc,$query);
?>
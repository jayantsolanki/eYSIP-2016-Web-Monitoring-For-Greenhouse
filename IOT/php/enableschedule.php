<?php

//Enable a schedule

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$id=$_POST['id'];
$query="UPDATE tasks set active=0 WHERE id=$id";
$result=mysqli_query($dbc,$query);
?>
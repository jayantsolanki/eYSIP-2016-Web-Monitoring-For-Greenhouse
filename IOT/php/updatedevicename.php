<?php

//Update name of device type

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$id=$_POST['id'];
$name=$_POST['name'];
$query="UPDATE sensors SET name='$name' WHERE id='$id'";
$result=mysqli_query($dbc,$query);
?>
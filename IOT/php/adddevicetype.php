<?php

//Used to add new device type

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');

$name=$_POST['name'];
$query="INSERT INTO sensors(name) VALUES('$name')";
$result=mysqli_query($dbc,$query);
?>

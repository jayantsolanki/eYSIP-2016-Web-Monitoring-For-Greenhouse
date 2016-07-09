<?php

//Used to add new group type

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');

$name=$_POST['name'];
$query="INSERT INTO groups(name) VALUES('$name')";
$result=mysqli_query($dbc,$query);
?>
<?php
require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname);
$name=$_POST['name'];
$query="INSERT INTO sensors(name) VALUES('$name')";
$result=mysqli_query($dbc,$query);
?>

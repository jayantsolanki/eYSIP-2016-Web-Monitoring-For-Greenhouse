<!-- Used to add new group of devices in groups table -->


<?php
require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname);
$name=$_POST['name'];
$query="INSERT INTO groups(name) VALUES('$name')";
$result=mysqli_query($dbc,$query);
?>
<?php

//Used to find various group types

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$query="SELECT * FROM groups";
$result=mysqli_query($dbc,$query);
$result_array=array();
while($row=mysqli_fetch_array($result)){
	$row_array['id']=$row['id'];
	$row_array['name']=$row['name'];
	array_push($result_array, $row_array);
}
echo json_encode($result_array);
?>
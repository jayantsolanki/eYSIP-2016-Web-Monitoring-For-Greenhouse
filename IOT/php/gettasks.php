<?php

//Used to find info about schedules

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$query="SELECT * FROM tasks ";
$result=mysqli_query($dbc,$query);
$result_array=array();
while($row=mysqli_fetch_array($result)){
	$row_array['id']=$row['id'];
	$row_array['groupId']=$row['groupId'];
	
	$row_array['deviceId']=$row['deviceId'];
	$row_array['switchId']=$row['switchId'];	
	$row_array['start']=$row['start'];
	$row_array['stop']=$row['stop'];
	$row_array['type']=$row['type'];
	$row_array['active']=$row['active'];
		
	
array_push($result_array, $row_array);	
}
echo json_encode($result_array);
?>
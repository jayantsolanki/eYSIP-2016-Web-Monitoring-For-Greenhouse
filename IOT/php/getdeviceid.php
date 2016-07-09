<?php

//Obtain name and id of particular device

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$userGroup=$_GET['userGroup'];
//$userGroup=1;
$query="SELECT * FROM devices WHERE groupId='$userGroup'";
$result=mysqli_query($dbc,$query);
$result_array=array();

while($row=mysqli_fetch_array($result))
{
	$row_array['deviceId']=$row['deviceId'];
 	$row_array['deviceName']=$row['name'];
 	//$row_array['']
	array_push($result_array, $row_array);
}
echo json_encode($result_array);
?>
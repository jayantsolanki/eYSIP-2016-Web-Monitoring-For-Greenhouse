<?php

//Used to obtain certain info such as no of switches,devicetype etc. of a device

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$userDevice=$_GET['userDevice'];
$result_array=array();
$query="SELECT * FROM devices WHERE deviceId='$userDevice'";
$result=mysqli_query($dbc,$query);

$row=mysqli_fetch_array($result);

$typeOfDevice=$row['type'];

$row_array['deviceType']=$typeOfDevice;
$row_array['noOfSwitches']=$row['switches'];
$row_array['device_Id']=$row['deviceId'];
if($typeOfDevice==1)
{
	//$row_array['field1']=$row['field1'];
}

elseif ($typeOfDevice==2) 
{
 	
 	$row_array['field1']=$row['field1'];
 	
} 
array_push($result_array, $row_array);
echo json_encode($result_array);
?>
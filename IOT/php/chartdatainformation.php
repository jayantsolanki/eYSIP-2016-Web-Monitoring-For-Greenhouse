<?php

$dbc=mysqli_connect('localhost','root','ankitg444','IOT');
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
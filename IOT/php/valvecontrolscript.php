<?php

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$grpid=$_GET['grpid'];

$query="SELECT groups.id AS gid,devices.id AS deviceid,switches.switchId,switches.groupId,devices.name,switches.action,switches.deviceId AS sdid FROM groups,switches,devices WHERE groups.id=switches.groupId AND switches.deviceId=devices.deviceId AND groups.id='$grpid' " ;
$result=mysqli_query($dbc,$query) or die('Error in Query');
$result_array=array();
while($row=mysqli_fetch_array($result))
{
	$did=$row['sdid'];
	$query1="SELECT * FROM deviceStatus WHERE deviceId='$did' ORDER BY created_At DESC LIMIT 1";
	$result1=mysqli_query($dbc,$query1);
	$row1=mysqli_fetch_array($result1);


	$row_array['devices_id']=$row['deviceid'];
	$row_array['switchId'] = $row['switchId'];
    $row_array['deviceId'] = $row['sdid'];
    $row_array['name'] = $row['name'];
    $row_array['action']=$row['action'];
    $row_array['dstatus']=$row1['status'];
    $row_array['created_At'] = strtotime($row1['created_At']);

	
    
   // $row_array['switchid']=$row['switches.id'];
    
    
   
array_push($result_array, $row_array);
}



echo json_encode($result_array);
 

?>
<?php

//USed to find info about sensor devices

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$group=$_POST['group'];
$query="SELECT * FROM groups WHERE name='$group'";
$result=mysqli_query($dbc,$query);
$row=mysqli_fetch_array($result);
$id=$row['id'];
$result_array=array();
$query="SELECT * FROM devices WHERE groupId=$id AND type=2 ORDER BY deviceId DESC ";
$result=mysqli_query($dbc,$query);
while($row=mysqli_fetch_array($result)){
	
		$devid=$row['deviceId'];
	$row_array['deviceId']=$row['deviceId'];
	$query2="SELECT * FROM feeds WHERE device_id='$devid' ORDER BY created_at DESC LIMIT 1 ";
	$result2=mysqli_query($dbc,$query2);
	$res=mysqli_fetch_array($result2);
	$row_array['type']=$row['field1'];
	if($row['field1']=='b')
	{$row_array['batt']=$res['field3'];
	
	}else if($row['field1']=='bm')
	{
		$row_array['batt']=$res['field3'];
		$row_array['moisture']=$res['field4'];
	}
	else if($row['field1']=='bm')
	{
		$row_array['batt']=$res['field3'];
		$row_array['temp']=$res['field4'];
		$row_array['hum']=$res['field5'];
		$row_array['moisture']=$res['field6'];
		
	}	
	array_push($result_array, $row_array);
	
}
echo json_encode($result_array);
?>
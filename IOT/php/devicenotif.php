<?php

//Retrieve info from deviceNotif table

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$query="SELECT * FROM deviceNotif";
$result_array=array();
$result=mysqli_query($dbc,$query);
while($row=mysqli_fetch_array($result)){
	$devid=$row['deviceId'];
	$row_array['deviceId']=$row['deviceId'];
	$row_array['field1']=$row['field1'];
	$row_array['field2']=$row['field2'];
	$row_array['field3']=$row['field3'];
	$row_array['field6']=$row['field6'];
	$query1="SELECT * FROM devices WHERE deviceId='$devid'";
	$result2=mysqli_query($dbc,$query1);
	$row2=mysqli_fetch_array($result2);
	$row_array['name']=$row2['name'];
	$row_array['type']=$row2['type'];
	$row_array['switches']=$row2['switches'];
	$row_array['senstype']=$row2['field1'];
	if($row2['type']==1){
	$query3="SELECT * FROM feeds WHERE device_id='$devid' ORDER BY created_at DESC LIMIT 1 ";
	$result3=mysqli_query($dbc,$query3);
	$res=mysqli_fetch_array($result3);
	$row_array['prim']=$res['field2'];
	$row_array['sec']=$res['field3'];
	}
	else if($row2['type']==2){
	$query3="SELECT * FROM feeds WHERE device_id='$devid' ORDER BY created_at DESC LIMIT 1 ";
	$result3=mysqli_query($dbc,$query3);
	$res=mysqli_fetch_array($result3);
	$row_array['prim']=$res['field3'];
	$row_array['sec']=$res['field4'];
		
	}
	array_push($result_array,$row_array);
}
echo json_encode($result_array);

?>
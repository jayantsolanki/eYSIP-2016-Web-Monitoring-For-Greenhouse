<?php

//Used to obtain info about valves

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$group=$_POST['group'];
$query="SELECT * FROM groups WHERE name='$group'";
$result=mysqli_query($dbc,$query);
$row=mysqli_fetch_array($result);
$id=$row['id'];
$result_array=array();
$query="SELECT * FROM devices WHERE groupId=$id AND type=1";
$result=mysqli_query($dbc,$query);
while($row=mysqli_fetch_array($result)){
	if($row['switches']<=1){
		$devid=$row['deviceId'];
	$row_array['deviceId']=$row['deviceId'];
	$query2="SELECT * FROM feeds WHERE device_id='$devid' ORDER BY created_at DESC LIMIT 1 ";
	$result2=mysqli_query($dbc,$query2);
	$res=mysqli_fetch_array($result2);
	$row_array['prim']=$res['field2'];
	$row_array['sec']=$res['field3'];
	array_push($result_array, $row_array);
	}
}
echo json_encode($result_array);
?>
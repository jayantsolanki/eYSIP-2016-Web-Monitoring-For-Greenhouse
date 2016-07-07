<?php
$dbc=mysqli_connect('localhost','root','ankitg444','IOT');
$id=$_GET['id'];
$query="SELECT * FROM devices WHERE groupId='$id'";
$result=mysqli_query($dbc,$query);
	$result_array=array();

while($row=mysqli_fetch_array($result)){
	$row_array['id']=$row['id'];
	$row_array['name']=$row['name'];
	$row_array['deviceId']=$row['deviceId'];
	$row_array['typeId']=$row['type'];
	$typeId=$row['type'];
	$query1="SELECT * FROM sensors WHERE id='$typeId'";
	$result1=mysqli_query($dbc,$query1);
	$name=mysqli_fetch_array($result1);
	$row_array['typename']=$name['name'];
	$row_array['switches']=$row['switches'];
		$devid=$row['deviceId'];

	$query2="SELECT * FROM deviceStatus WHERE deviceId='$devid' ORDER BY created_At DESC LIMIT 1 ";
	$result2=mysqli_query($dbc,$query2);
	$res=mysqli_fetch_array($result2);
	$row_array['status']=$res['status'];
	$row_array['created_At'] = strtotime($res['created_At']);
	$query3="SELECT * FROM feeds WHERE device_id='$devid' ORDER BY created_at DESC LIMIT 1 ";
	$result3=mysqli_query($dbc,$query3);
	$res=mysqli_fetch_array($result3);
	$row_array['updated_at'] = strtotime($res['created_at']);
	

	if($row['type']==1){
	$row_array['prim']=$res['field2'];
	$row_array['sec']=$res['field3'];
	array_push($result_array, $row_array);
	}else if($row['type']==2){
		$row_array['sentype']=$res['field1'];
		$row_array['prim']=$res['field3'];
	$row_array['sec']=$res['field4'];
	array_push($result_array, $row_array);
		
	}
}
echo json_encode($result_array);
?>
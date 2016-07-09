<?php
require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$query="SELECT * FROM reactJS";
$result_array=array();
$result=mysqli_query($dbc,$query);
while($row=mysqli_fetch_array($result)){
	$row_array['name']=$row['name'];
	$row_array['id']=$row['id'];
	$grpid=$row['groupId'];
	$query2="SELECT * FROM groups WHERE id='$grpid'";
	$result2=mysqli_query($dbc,$query2);
	$res=mysqli_fetch_array($result2);
	$row_array['group']=$res['name'];
	$row_array['field']=$row['fieldId'];
	$row_array['condition']=$row['conditionCase'];
	$row_array['threshold']=$row['conditionValue'];
	$actid=$row['actionId'];
	$query2="SELECT * FROM actionReact WHERE id='$actid'";
	$result2=mysqli_query($dbc,$query2);
	$res=mysqli_fetch_array($result2);
	$row_array['action']=$res['actionName'];
	array_push($result_array,$row_array);
}
echo json_encode($result_array);
?>
<?php

//Used to obtain count of online and offline devices

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$result_array=array();
$query="SELECT COUNT(*) as count FROM devices ";
$result=mysqli_query($dbc,$query);
$row=mysqli_fetch_array($result);
$row_array['number']=$row['count'];
$query="SELECT * FROM devices ";
$result=mysqli_query($dbc,$query);
$x=0;
$y=0;
while($row=mysqli_fetch_array($result)){
$devid=$row['deviceId'];
$query2="SELECT * FROM deviceStatus WHERE deviceId='$devid' ORDER BY created_At DESC LIMIT 1 ";
	$result2=mysqli_query($dbc,$query2);
	$res=mysqli_fetch_array($result2);
if($res['status']==0){
	$x++;
}
else{
	$y++;
}
}
$row_array['offline']= $x;
 $row_array['online']=$y;
array_push($result_array,$row_array);
echo json_encode($result_array);

?>
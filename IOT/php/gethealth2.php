<?php

//Obtain count of devices having critical and healthy secondary battery

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$query="SELECT * FROM deviceNotif WHERE  field2=0";
$result=mysqli_query($dbc,$query);
$row_array['sec1']=mysqli_num_rows($result);
$query="SELECT * FROM deviceNotif WHERE  field2=1";
$result=mysqli_query($dbc,$query);

$row_array['sec2']=mysqli_num_rows($result);
$result_array=array();
array_push($result_array,$row_array);
echo json_encode($result_array);
?>
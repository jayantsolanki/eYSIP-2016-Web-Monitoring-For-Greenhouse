<?php

//Obtain count of devices having critical and healthy primary battery

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$query="SELECT * FROM deviceNotif WHERE  field1=0";
$result=mysqli_query($dbc,$query);
$row_array['prim1']=mysqli_num_rows($result);
$query="SELECT * FROM deviceNotif WHERE  field1=1";
$result=mysqli_query($dbc,$query);

$row_array['prim2']=mysqli_num_rows($result);
$result_array=array();
array_push($result_array,$row_array);
echo json_encode($result_array);
?>
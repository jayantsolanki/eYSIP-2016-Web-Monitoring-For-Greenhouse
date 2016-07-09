<!-- Used to find the count of those devices whose secondary battery is critical and also of those whose secondary battery is healthy -->

<?php
require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname);
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
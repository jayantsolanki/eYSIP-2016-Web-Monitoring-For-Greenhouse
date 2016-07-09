

<?php

// Used to find the count of those devices whose primary battery is critical and also of those whose primary battery is healthy 

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname);
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
<?php

//Used to obtain count of various types of users

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$query="SELECT COUNT(*) AS count FROM users";
$result_array=array();
$result=mysqli_query($dbc,$query);
$row=mysqli_fetch_array($result);
$row_array['number']=$row['count'];
$query="SELECT * FROM users WHERE user_type=0 ";
$result=mysqli_query($dbc,$query);
$row_array['unactivated']=mysqli_num_rows($result);
$query="SELECT * FROM users WHERE user_type=1 ";
$result=mysqli_query($dbc,$query);
$row_array['admin']=mysqli_num_rows($result);
$query="SELECT * FROM users WHERE user_type=2 ";
$result=mysqli_query($dbc,$query);
$row_array['normal']=mysqli_num_rows($result);
$query="SELECT * FROM users WHERE user_type=3 ";
$result=mysqli_query($dbc,$query);
$row_array['deactivated']=mysqli_num_rows($result);

array_push($result_array, $row_array);
echo json_encode($result_array);
?>
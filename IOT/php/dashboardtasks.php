<?php

//Used to obtain info about tasks

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$result_array=array();
$query="SELECT COUNT(*) AS count FROM tasks";
$result=mysqli_query($dbc,$query);
$row=mysqli_fetch_array($result);
$row_array['number']=$row['count'];
$query2="SELECT * FROM tasks WHERE type=0";
$result2=mysqli_query($dbc,$query2);
$row_array['manual']=(string)mysqli_num_rows($result2);
$query2="SELECT *  FROM tasks WHERE type=1";
$result2=mysqli_query($dbc,$query2);
$row_array['scheduled']=(string)mysqli_num_rows($result2);
$query2="SELECT *  FROM tasks WHERE type=2";
$result2=mysqli_query($dbc,$query2);
$row_array['automated']=(string)mysqli_num_rows($result2);
$query2="SELECT * FROM tasks WHERE type=0 AND active=1";
$result2=mysqli_query($dbc,$query2);
$row_array['manualrunning']=(string)mysqli_num_rows($result2);
$query2="SELECT * FROM tasks WHERE type=1 AND active=1";
$result2=mysqli_query($dbc,$query2);
$row_array['scheduledrunning']=(string)mysqli_num_rows($result2);
$query2="SELECT *  FROM tasks WHERE type=2 AND active=1";
$result2=mysqli_query($dbc,$query2);
$row_array['automatedrunning']=(string)mysqli_num_rows($result2);
array_push($result_array,$row_array);
echo json_encode($result_array);
?>
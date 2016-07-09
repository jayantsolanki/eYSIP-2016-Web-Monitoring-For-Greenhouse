<?php

//Update switch status

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$action=$_POST['action'];
$deviceId=$_POST['deviceId'];
$switchId=$_POST['switchId'];
$duration=$_POST['duration'];
$dur=intval($duration)*60;
$starttime=date('Hi');
$endtime = date("Hi",time() +$dur);

if($action=='1'){
$query="UPDATE switches SET action=1 WHERE deviceId='$deviceId' and switchId='$switchId'";
$result=mysqli_query($dbc,$query);
$query1="INSERT INTO tasks (deviceId,switchId,start,stop,action,type,active) VALUES('$deviceId','$switchId','$starttime','$endtime',0,0,1)";
$result1=mysqli_query($dbc,$query1);
}
else{
$query2="DELETE FROM tasks WHERE deviceId='$deviceId' and switchId='$switchId'";
$result2=mysqli_query($dbc,$query2);
$query3="UPDATE switches SET action=0 WHERE deviceId='$deviceId' and switchId='$switchId'";
$result3=mysqli_query($dbc,$query3);	
}
?>
<?php
$switch=$_POST['switches'];
$deviceId=$_POST['deviceId'];
$group=$_POST['group'];
$dbc=mysqli_connect('localhost','root','ankitg444','IOT');
$query1="SELECT * FROM groups WHERE name='$group'";
$result=mysqli_query($dbc,$query1);
$group=mysqli_fetch_array($result);
$groupId=$group['id'];
$query2="UPDATE switches SET groupId='$groupId' WHERE deviceId='$deviceId'  AND switchId='$switch'";
$result=mysqli_query($dbc,$query2);

?>

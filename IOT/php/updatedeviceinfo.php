<?php
$id=$_POST['id'];
$name=$_POST['name'];
$regionId=$_POST['regionId'];

$description=$_POST['description'];
$group1=$_POST['group1'];
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];
$elevation=$_POST['elevation'];
$dbc=mysqli_connect('localhost','root','ankitg444','IOT');
$query1="SELECT * FROM groups WHERE name='$group1'";
$result=mysqli_query($dbc,$query1);
$group=mysqli_fetch_array($result);
$groupId=$group['id'];
$query2="UPDATE devices SET name='$name',description='$description',groupId='$groupId',latitude='$latitude',longitude='$longitude',elevation='$elevation' WHERE id='$id' ";
$result=mysqli_query($dbc,$query2);

?>

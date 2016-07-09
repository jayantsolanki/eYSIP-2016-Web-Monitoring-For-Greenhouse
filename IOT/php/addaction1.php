<?php
require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$name=$_POST['name'];
$group=$_POST['group'];
$action=$_POST['action'];
$field=$_POST['field'];
$query1="SELECT * FROM groups WHERE name='$group'";
$result1=mysqli_query($dbc,$query1);
$row=mysqli_fetch_array($result1);
$grp=$row['id'];
$query1="SELECT * FROM actionReact WHERE actionName='$action'";
$result1=mysqli_query($dbc,$query1);
$row=mysqli_fetch_array($result1);
$act=$row['id'];

$query="INSERT INTO reactJS(name,groupId,fieldId,actionId) VALUES('$name','$grp','$field','$act')";
$result=mysqli_query($dbc,$query);
?>

<!-- Update group name --> 

<?php
require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname);
$id=$_POST['id'];
$name=$_POST['name'];
$query="UPDATE groups SET name='$name' WHERE id='$id'";
$result=mysqli_query($dbc,$query);
?>

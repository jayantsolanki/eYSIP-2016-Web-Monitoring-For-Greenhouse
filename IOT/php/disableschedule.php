
<!-- Used to disable a schedule -->

<?php
require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname);
$id=$_POST['id'];
$query="UPDATE tasks set active=3 WHERE id=$id";
$result=mysqli_query($dbc,$query);
?>
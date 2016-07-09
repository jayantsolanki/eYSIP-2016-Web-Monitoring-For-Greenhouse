

<!-- Used to enable a schedule -->

<?php
require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname);
$id=$_POST['id'];
$query="UPDATE tasks set active=0 WHERE id=$id";
$result=mysqli_query($dbc,$query);
?>
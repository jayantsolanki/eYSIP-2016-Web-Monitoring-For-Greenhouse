<!-- Used to delete a schedule -->

<?php
require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname);
$id=$_POST['id'];
$query="DELETE FROM tasks WHERE id='$id'";
$result=mysqli_query($dbc,$query);
?>
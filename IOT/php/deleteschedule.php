<?php
$dbc=mysqli_connect('localhost','root','ankitg444','IOT');
$id=$_POST['id'];
$query="DELETE FROM tasks WHERE id='$id'";
$result=mysqli_query($dbc,$query);
?>
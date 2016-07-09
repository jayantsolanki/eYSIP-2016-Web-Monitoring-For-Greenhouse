<?php
$dbc=mysqli_connect('localhost','root','ankitg444','IOT');
$name=$_POST['name'];
$query="INSERT INTO sensors(name) VALUES('$name')";
$result=mysqli_query($dbc,$query);
?>

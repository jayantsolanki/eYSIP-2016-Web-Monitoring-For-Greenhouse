<?php
$dbc=mysqli_connect('localhost','root','ankitg444','IOT');
$id=$_POST['id'];
$name=$_POST['name'];
$query="UPDATE sensors SET name='$name' WHERE id='$id'";
$result=mysqli_query($dbc,$query);
?>
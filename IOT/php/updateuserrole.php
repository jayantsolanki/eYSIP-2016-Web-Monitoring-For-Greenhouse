<?php
$dbc=mysqli_connect('localhost','root','ankitg444','IOT');
$user=$_POST['user'];
$role=$_POST['role'];
$query="UPDATE users SET user_type='$role' WHERE username='$user'";
$result=mysqli_query($dbc,$query) or die('error querying');
?>
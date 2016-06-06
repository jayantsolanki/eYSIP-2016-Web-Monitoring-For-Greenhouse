<?php

$username=$_POST['username'];
$emailid=$_POST['emailid'];
$password=$_POST['password'];

$dbc=mysqli_connect('localhost','root','ankitg444','IOT') or die('error');
$query1="SELECT * from users WHERE username='$username'";
$result1=mysqli_query($dbc,$query1) or die('error querying');
$query2="SELECT * from users WHERE email_id='$emailid'";
$result2=mysqli_query($dbc,$query2) or die('error querying2');
if(mysqli_num_rows($result1)!=0){
	echo '1';

}
else if(mysqli_num_rows($result2)!=0){
	echo '2';

}
else{
	$query3="INSERT INTO users(username,email_id,password) VALUES('$username','$emailid',SHA('$password'))";
		$result3=mysqli_query($dbc,$query3) or die('error querying3');

}
?>
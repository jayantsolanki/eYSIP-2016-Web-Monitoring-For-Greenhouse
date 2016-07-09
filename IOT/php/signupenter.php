<?php

$username=$_POST['username'];
$emailid=$_POST['emailid'];
$password=$_POST['password'];
$sqans=$_POST['sqans'];
$sqoption=$_POST['sqoption'];


require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname);
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
	$query3="INSERT INTO users(username,email_id,password,Security_Question,Security_Question_Answer) VALUES ('$username','$emailid',SHA('$password'),'$sqoption',SHA('$sqans'))";
		$result3=mysqli_query($dbc,$query3) or die('error querying3');
	$query4="SELECT * FROM users WHERE username='$username'";
	$result4=mysqli_query($dbc,$query4);
	$row=mysqli_fetch_array($result4);
	$id=$row['user_id'];

	setcookie('user_id',$id,time()+3600*24,'/');

}
?>
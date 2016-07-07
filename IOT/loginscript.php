<?php

require_once('config.php');

$error_msg="";
		$connection=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) ;
		$username=$_POST['username'];
		$password=$_POST['password'];
		if(!empty($username) && !empty($password))
		{
			$logincheckquery1=" Select * from users where username='$username' and password=SHA('$password' ) ";
			$logincheckquery2=" Select * from users where email_id='$username' and password=SHA('$password') ";
			$query1=mysqli_query($connection,$logincheckquery1) ;
			$query2=mysqli_query($connection,$logincheckquery2) ;
			$row1=mysqli_num_rows($query1);
			$row2=mysqli_num_rows($query2);
			if(($row1==0)  &&  ($row2==0))
			{		
				$error_msg = 'Sorry, you must enter a valid username and password to log in.';
				echo true;
			}
			else if(($row1==0)  &&  ($row2!=0))
			{
				$row = mysqli_fetch_array($query2);
				setcookie('user_id', $row['user_id']);
				setcookie('username', $row['username']);
				echo false;
			}
			else
			{
				
				$row = mysqli_fetch_array($query1);
				setcookie('user_id', $row['user_id']);
				setcookie('username', $row['username']);
				
				echo false;
			}
		}
		else
		{
			$error_msg = 'Sorry, you must enter your username and password to log in.';
		}


?>
<?php
require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$username=$_POST['username'];
$emailid=$_POST['emailid'];
$choice=$_POST['choice'];


if($choice==2)
{
	$sqans=$_POST['sqans'];
	$query="SELECT * from users WHERE username='$username' AND email_id='$emailid' AND Security_Question_Answer=SHA('$sqans')  ";
	$result=mysqli_query($dbc,$query) or die('error querying');
	$row=mysqli_num_rows($result);
	if($row==1)
	{
		echo '1';
	}
	else
	{
		echo '2';
	}

	
}

else if($choice==1)
{

	$query="SELECT * from users WHERE username='$username' AND email_id='$emailid' ";
	$result=mysqli_query($dbc,$query) or die('error querying');
	if(mysqli_num_rows($result)==1)
	{
		$row=mysqli_fetch_array($result);
		$id=$row['Security_Question'];
		$query1="SELECT sq from securtiy_questions WHERE sqoption='$id'";
		$result1=mysqli_query($dbc,$query1) or die('error querying1');
		$row1=mysqli_fetch_array($result1);
		$id1=$row1[0];
		echo $id1;
		
	}
	else
	{
		echo '2';
	}
}

else if($choice==3)
{

	if($_POST['len']==='true')
	{
		$len=TRUE;
	}
	else
	{
		$len=FALSE;
	}
	
	if($_POST['let']==='true')
	{
		$let=TRUE;
	}
	else
	{
		$let=FALSE;
	}

	if($_POST['cap']==='true')
	{
		$cap=TRUE;
	}
	else
	{
		$cap=FALSE;
	}

	if($_POST['number']==='true')
	{
		$number=TRUE;
	}
	else
	{
		$number=FALSE;
	}
	$newpass=$_POST['newpass'];
	$cnewpass=$_POST['cnewpass'];
	if($len==TRUE and $let==TRUE and $cap==TRUE and $number==TRUE)
	{
		if(($newpass==$cnewpass)  )
		{
		//$query="SELECT * from users WHERE username='$username' AND email_id='$emailid' ";
		//$result=mysqli_query($dbc,$query) or die('error querying');
			$query2="UPDATE users SET password=SHA('$newpass') WHERE email_id='$emailid' ; ";
			$result2=mysqli_query($dbc,$query2) or die('error querying2');

			echo $len;
		}
		else
		{
			echo "2"; 
		}
	}
	else
	{
		echo '3';
	}
}

mysqli_close($dbc);

?>
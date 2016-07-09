<?php

//Update info about schedule

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$type=$_POST['type'];
if($type=='1'){
	$group=$_POST['group'];
	$starthrs=$_POST['starthrs'];
	$startmins=$_POST['startmins'];
	$stophrs=$_POST['stophrs'];
	$stopmins=$_POST['stopmins'];
	$start=$starthrs.''.$startmins;
	$stop=$stophrs.''.$stopmins;

	$query1="INSERT INTO tasks(groupId,start,stop,action,type,active,updated_at) VALUES('$group','$start','$stop',1,1,0,NOW()) ";
	$result1=mysqli_query($dbc,$query1);
}
else if($type=='2'){
	$group=$_POST['group'];
	$starthrs=$_POST['starthrs'];
	$startmins=$_POST['startmins'];
	$duration=$_POST['duration'];
	$start=$starthrs.''.$startmins;
	$stopmins=(int)$startmins+(int)$duration;
	$stophrs=(int)$starthrs;
	if($stopmins>=60){
		$stopmins=$stopmins-60;
		if($stopmins<10){
			$stopmins='0'.$stopmins;
		}
		$stophrs=$stophrs+1;
			if($stophrs=='24'){
			$stophrs='0';
		}
	
	}
	$stop=$stophrs.''.$stopmins;
	$query1="INSERT INTO tasks(groupId,start,stop,action,type,active,updated_at) VALUES('$group','$start','$stop',1,1,0,NOW()) ";
	$result1=mysqli_query($dbc,$query1);

}
else if($type=='3'){

	$group=$_POST['group'];
	$starthrs=$_POST['starthrs'];
	$startmins=$_POST['startmins'];
	$duration=$_POST['duration'];
	$start=$starthrs.''.$startmins;
	$stopmins=(int)$startmins+(int)$duration;
	$stophrs=(int)$starthrs;
	if($stopmins>=60){
		$stopmins=$stopmins-60;
		if($stopmins<10){
			$stopmins='0'.$stopmins;
		}
		$stophrs=$stophrs+1;
		if($stophrs=='24'){
			$stophrs='0';
		}
	}
	$stop=$stophrs.''.$stopmins;
	$query1="INSERT INTO tasks(groupId,start,stop,action,type,active,updated_at) VALUES('$group','$start','$stop',1,1,0,NOW()) ";
	$result1=mysqli_query($dbc,$query1);
	$frequency=$_POST['frequency'];
	$starthrs=(int)$starthrs+(int)$frequency;
	while($starthrs<=23){
	$start=$starthrs.''.$startmins;
	$stopmins=(int)$startmins+(int)$duration;
	$stophrs=(int)$starthrs;
	if($stopmins>=60){
		$stopmins=$stopmins-60;
		if($stopmins<10){
			$stopmins='0'.$stopmins;
		}
		$stophrs=$stophrs+1;
		if($stophrs=='24'){
			$stophrs='0';
		}
	
	}
	$stop=$stophrs.''.$stopmins;
		
	$query1="INSERT INTO tasks(groupId,start,stop,action,type,active,updated_at) VALUES('$group','$start','$stop',1,1,0,NOW()) ";
	$result1=mysqli_query($dbc,$query1);
	$starthrs=(int)$starthrs+(int)$frequency;
		
	}
}
?>
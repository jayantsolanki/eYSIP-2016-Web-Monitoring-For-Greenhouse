<?php

// Used to obtain count of open and closed switches

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$query="SELECT * FROM switches";
$result=mysqli_query($dbc,$query);
$row_array['number']=mysqli_num_rows($result);
$result_array=array();
$x=0;
$y=0;
while($row=mysqli_fetch_array($result)){
	if($row['action']==0){
		$x++;
	}
	else{
		$y++;
	}
}
$row_array['on']=$y;
$row_array['off']=$x;
array_push($result_array,$row_array);
echo json_encode($result_array);

?>
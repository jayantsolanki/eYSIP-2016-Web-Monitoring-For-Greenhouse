<?php
$dbc=mysqli_connect('localhost','root','ankitg444','IOT');
$query="SELECT * FROM sensors";
$result=mysqli_query($dbc,$query);
$result_array=array();
while($row=mysqli_fetch_array($result)){
	$row_array['id']=$row['id'];
	$row_array['name']=$row['name'];
	array_push($result_array, $row_array);
}
echo json_encode($result_array);
?>
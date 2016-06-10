<?php
$dbc=mysqli_connect('localhost','root','ankitg444','IOT');
$query='SELECT * FROM users';
$result=mysqli_query($dbc,$query);
$result_array=array();
while($row=mysqli_fetch_array($result)){
	$row_array['username'] = $row['username'];
    $row_array['email_id'] = $row['email_id'];
    $row_array['user_type'] = $row['user_type'];
    $row_array['user_type2']=$row['user_type'];
array_push($result_array, $row_array);
}
echo json_encode($result_array);
?>
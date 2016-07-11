<?php

//Used to obtain info about valves

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$device_id=$_GET['device_id'];
//$device_type=$_GET['device_type'];
$field_value=$_GET['field_value'];
$current_tab=$_GET['current_tab'];
$field_value_int=intval($field_value);
$yaxis=$_GET['yaxis'];
$current_month=$_GET['current_month'];
$current_month_int=intval($current_month);
$current_year=$_GET['current_year'];
$current_year_int=intval($current_year);
$current_week=$_GET['current_week'];
$current_week_int=intval($current_week);
$current_date=$_GET['current_date'];
$current_date_int=intval($current_date);
$fieldFindQuery="SELECT field1 FROM devices WHERE deviceId='$device_id'";
$resultQuery=mysqli_query($dbc,$fieldFindQuery) or die("Error executing fieldquery");
$rowQuery=mysqli_fetch_array($resultQuery);

if($field_value_int==1)
{
	if($current_tab=='1')
	{
		$query="SELECT created_at,field2 FROM feeds WHERE device_id='$device_id' AND EXTRACT(DAY FROM created_at)='$current_date_int' AND EXTRACT(MONTH FROM created_at)='$current_month_int' AND EXTRACT(YEAR FROM created_at)='$current_year_int' AND field2<=$yaxis"; 
		$result=mysqli_query($dbc,$query) or die("Error executing query");
		$result_array=array();
		while($row=mysqli_fetch_array($result))
		{
			$row_array['time']=$row['created_at'];
			$row_array['value']=number_format($row['field2']/1024,3,'.','');
			array_push($result_array, $row_array);
		}
	}
	elseif($current_tab=='2')
	{
		$query="SELECT created_at,(field2) FROM feeds WHERE device_id='$device_id' AND WEEKOFYEAR(created_at)='$current_week_int' AND field2<=$yaxis"; 
		$result=mysqli_query($dbc,$query) or die("Error executing query");
		$result_array=array();
		while($row=mysqli_fetch_array($result))
		{
			$row_array['time']=$row['created_at'];
			$row_array['value']=number_format($row['field2']/1024,3,'.','');
			array_push($result_array, $row_array);
		}
	}
	elseif($current_tab=='3')
	{
		$current_month=$_GET['current_month'];
		$current_month_int=intval($current_month);
		$query="SELECT created_at,field2 FROM feeds WHERE device_id='$device_id' AND MONTH(created_at)='$current_month_int' AND field2<=$yaxis"; 
		$result=mysqli_query($dbc,$query) or die("Error executing query");
		$result_array=array();
		while($row=mysqli_fetch_array($result))
		{	
			$row_array['time']=$row['created_at'];
			$row_array['value']=number_format($row['field2']/1024,3,'.','');
			array_push($result_array, $row_array);
		}
	}
	elseif($current_tab=='4')
	{
		$query="SELECT created_at,field2 FROM feeds WHERE device_id='$device_id' AND YEAR(created_at)='$current_year_int' AND field2<=$yaxis"; 
		$result=mysqli_query($dbc,$query) or die("Error executing query");
		$result_array=array();
		while($row=mysqli_fetch_array($result))
		{
			$row_array['time']=$row['created_at'];
			$row_array['value']=number_format($row['field2']/1024,3,'.','');
			array_push($result_array, $row_array);
		}
	}
}

if($field_value_int==2)
{
	if($current_tab=='1')
	{
		$query="SELECT created_at,field3 FROM feeds WHERE device_id='$device_id' AND EXTRACT(DAY FROM created_at)='$current_date_int' AND EXTRACT(MONTH FROM created_at)='$current_month_int' AND EXTRACT(YEAR FROM created_at)='$current_year_int' AND field3<=$yaxis"; 
		$result=mysqli_query($dbc,$query) or die("Error executing query");
		$result_array=array();
		while($row=mysqli_fetch_array($result))
		{
			$row_array['time']=$row['created_at'];
			$row_array['value']=number_format($row['field3']/137.1428571428571,3,'.','');
			array_push($result_array, $row_array);
		}
	}
	elseif($current_tab=='2')
	{
		$query="SELECT created_at,(field3) FROM feeds WHERE device_id='$device_id' AND WEEKOFYEAR(created_at)='$current_week_int' AND field3<=$yaxis"; 
		$result=mysqli_query($dbc,$query) or die("Error executing query");
		$result_array=array();
		while($row=mysqli_fetch_array($result))
		{
			$row_array['time']=$row['created_at'];
			$row_array['value']=number_format($row['field3']/137.1428571428571,3,'.','');
			array_push($result_array, $row_array);
		}
	}
	elseif($current_tab=='3')
	{
		$current_month=$_GET['current_month'];
		$current_month_int=intval($current_month);
		$query="SELECT created_at,field3 FROM feeds WHERE device_id='$device_id' AND MONTH(created_at)='$current_month_int' AND field3<=$yaxis"; 
		$result=mysqli_query($dbc,$query) or die("Error executing query");
		$result_array=array();
		while($row=mysqli_fetch_array($result))
		{	
			$row_array['time']=$row['created_at'];
			$row_array['value']=number_format($row['field3']/137.1428571428571,3,'.','');
			array_push($result_array, $row_array);
		}
	}
	elseif($current_tab=='4')
	{
		$query="SELECT created_at,field3 FROM feeds WHERE device_id='$device_id' AND YEAR(created_at)='$current_year_int' AND field3<=$yaxis"; 
		$result=mysqli_query($dbc,$query) or die("Error executing query");
		$result_array=array();
		while($row=mysqli_fetch_array($result))
		{
			$row_array['time']=$row['created_at'];
			$row_array['value']=number_format($row['field3']/137.1428571428571,3,'.','');
			array_push($result_array, $row_array);
		}
	}
}



echo json_encode($result_array);
mysqli_close($dbc);
?>
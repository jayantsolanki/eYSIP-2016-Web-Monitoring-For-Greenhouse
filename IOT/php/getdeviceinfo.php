<?php

//Obtain info of device

require_once('config.php');
$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) or die('Error connecting to database');
$query="SELECT * from devices ORDER BY status DESC";
$result=mysqli_query($dbc,$query) or die('error');
$result_array=array();
while($row=mysqli_fetch_array($result))
{
		if($row['switches']<=1){
			$row_array['id']=$row['id'];
			$row_array['description']=$row['description'];
			$row_array['regionId']=$row['regionId'];
			$row_array['latitude']=$row['latitude'];
  			$row_array['longitude']=$row['longitude'];				
			$row_array['field1']=$row['field1'];
  			$row_array['field2']=$row['field2'];
  			$row_array['field3']=$row['field3'];
  			$row_array['field4']=$row['field4'];
  			$row_array['field5']=$row['field5'];
  			$row_array['field6']=$row['field6'];
  			 $row_array['created_at'] = strtotime($row['created_at']);

       
  			$row_array['updated_at']=strtotime($row['updated_at']);				
			$row_array['elevation']=$row['elevation'];
  			$row_array['status']=$row['status'];
			$row_array['deviceId'] = $row['deviceId'];
    		$row_array['name'] = $row['name'];
    		$devtypeid=$row['type'];
    		$query2="SELECT * FROM sensors WHERE id='$devtypeid'";
    		$result2=mysqli_query($dbc,$query2) or die('error');
    		$type=mysqli_fetch_array($result2);
    		$row_array['type']=$type['name'];
    		$row_array['switches']=$row['switches'];
    		if($row['type']==1){
    			$devid=$row['deviceId'];
    			$query1="SELECT * from switches WHERE deviceId='$devid'";
    			$result1=mysqli_query($dbc,$query1) or die('error');
    			$groupid=mysqli_fetch_array($result1);
    			$group=$groupid['groupId'];
    			$query3="SELECT * from groups WHERE id='$group' ";
    			$result3=mysqli_query($dbc,$query3) or die('error');
    			$groupname=mysqli_fetch_array($result3);
    			$row_array['group']=$groupname['name'];
          $query1="SELECT * from devices WHERE deviceId='$devid'";
          $result1=mysqli_query($dbc,$query1) or die('error');
          $groupid=mysqli_fetch_array($result1);
          $group=$groupid['groupId'];
          $query3="SELECT * from groups WHERE id='$group' ";
          $result3=mysqli_query($dbc,$query3);
          $groupname=mysqli_fetch_array($result3);
           $row_array['group1']=$groupname['name'];
        
    		
        }
    		else if($row['type']==2){
    			$devid=$row['deviceId'];
  				$query1="SELECT * from devices WHERE deviceId='$devid'";
    			$result1=mysqli_query($dbc,$query1) or die('error');
    			$groupid=mysqli_fetch_array($result1);
    			$group=$groupid['groupId'];
    			$query3="SELECT * from groups WHERE id='$group' ";
    			$result3=mysqli_query($dbc,$query3);
    			$groupname=mysqli_fetch_array($result3);
    			$row_array['group']=$groupname['name'];
    	     $row_array['group1']=$groupname['name'];
    		}
			array_push($result_array, $row_array);
    	}	
    	else{
    			for ($x = 1; $x <=$row['switches'] ; $x++) {
  							$row_array['id']=$row['id'];
  							$row_array['description']=$row['description'];
  							$row_array['regionId']=$row['regionId'];
  							$row_array['latitude']=$row['latitude'];
  							$row_array['longitude']=$row['longitude'];
  							$row_array['field1']=$row['field1'];
  							$row_array['field2']=$row['field2'];
  							$row_array['field3']=$row['field3'];
  							$row_array['field4']=$row['field4'];
  							$row_array['field5']=$row['field5'];
  							$row_array['field6']=$row['field6'];
  							$row_array['created_at']=strtotime($row['created_at']);
  							$row_array['updated_at']=strtotime($row['updated_at']);				
  							$row_array['elevation']=$row['elevation'];
  							$row_array['status']=$row['status'];
  							$row_array['deviceId'] = $row['deviceId'];
    						$row_array['name'] = $row['name'];
    						$devtypeid=$row['type'];
    						$query5="SELECT * FROM sensors WHERE id='$devtypeid' ";
    						$result5=mysqli_query($dbc,$query5) or die('error');
    						$type=mysqli_fetch_array($result5);
    						$row_array['type']=$type['name'];
    		  				$row_array['switches']=$x;
    		  				$deviceid=$row['deviceId'];

    		  				$query6="SELECT * FROM switches WHERE deviceId='$deviceid' AND switchId='$x'";
    		  				$result6=mysqli_query($dbc,$query6) or die('error');
    		  				$groupid=mysqli_fetch_array($result6);
    		  				$grp=$groupid['groupId'];
    		  				$query7="SELECT * FROM groups WHERE id='$grp' ";
    		  				$result7=mysqli_query($dbc,$query7) or die('error');
    		  				$name=	mysqli_fetch_array($result7);
    		  				$row_array['group']=$name['name'];
    	              $devid=$row['deviceId'];
        
          $query1="SELECT * from devices WHERE deviceId='$devid'";
          $result1=mysqli_query($dbc,$query1) or die('error');
          $groupid=mysqli_fetch_array($result1);
          $group=$groupid['groupId'];
          $query3="SELECT * from groups WHERE id='$group' ";
          $result3=mysqli_query($dbc,$query3);
          $groupname=mysqli_fetch_array($result3);
           $row_array['group1']=$groupname['name'];
      
      						array_push($result_array, $row_array);

				} 
    	}	
}


echo json_encode($result_array);

?>
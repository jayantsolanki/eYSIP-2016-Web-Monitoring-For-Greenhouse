<!doctype html>
<html lang='en' ng-app='dashboardapp' >
<head>
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="menu/demo/css/demo.css" />
<link type="text/css" rel="stylesheet" href="menu/dist/css/jquery.mmenu.all.css" />

       <link href='./bower_components/roboto-fontface/css/roboto/roboto-fontface.css' rel='stylesheet' type='text/css'>
     <title>Dashboard-Greenhouse monitoring</title>
<!-- Bootstrap Core CSS -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Angular material css-->
<link rel="stylesheet" href="./bower_components/angular-material/angular-material.css">

<link rel="stylesheet" type='text/css' href="styles/dashboard.css" >
<!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> -->
 <link href="./bower_components/material-design-icons/iconfont/material-icons.css"
      rel="stylesheet">
<link href="./bower_components/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">

</head>
<body ng-controller='dashboardcontroller'>
<?php
if(isset($_COOKIE['user_id']))		
{
	$id=$_COOKIE['user_id'];	
	require_once('php/config.php');

	$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) ;
	$query="SELECT * FROM users WHERE user_id='$id'";
	$result=mysqli_query($dbc,$query) ;
	$row=mysqli_fetch_array($result);
	$user_type=$row['user_type'];
	$username=$row['username'];
	if($user_type==1 || $user_type==2){
?>

<div style='position:fixed;top:0;left:0;width:100%; z-index:99;'><div ng-include="'menu/demo/advanced.php'"></div></div>
<div class='container-fluid '>
	<div class='row tiles' style='padding-top:50px;'>

		<p style='color:black;padding-left:20px;font-size:24px;'>DASHBOARD</p>
		<div class=' col-md-4 col-xs-12' ng-repeat='x in tasks'>
			<div class='tasks' >
				<div class='tasks_content'>
					<div >

    					<div class="tasks_heading_no">
    						{{x.number}}
    					</div>
    					<div class="tasks_heading_text">
    						Scheduled Tasks
    					</div>	
    					<div class='task_icon_position'>
    						<i class="glyphicon glyphicon-tasks tasks_icon"></i>
						</div>
						    				
    				</div>		
        		</div>	
			</div>	
			<div class='tasks_additional small'>
				<div class="tasks_additional_content">
				<table class='table '>
					<tbody>
						<tr><td>Manual Tasks:</td><td>{{x.manualrunning}} tasks running out of {{x.manual}}</td></tr>	
						<tr><td>Scheduled Tasks:</td><td>{{x.scheduledrunning}} tasks running out of {{x.scheduled}}</td></tr>	
						<tr><td>Automated Tasks:</td><td>{{x.automatedrunning}} tasks running out of {{x.automated}}</td></tr>	
	
					</tbody>
				</table>
				<hr/>
				</div>
			</div>	
			<div class='tasks_footer'>
				<a href='taskscheduling.php'>
				<span class='pull-right'>View Details<i style='padding-left:10px;'class="glyphicon glyphicon-circle-arrow-right"></i></span>
				<div class='clearfix'>
				</div>
				</a>
			</div>	
		</div>
		<div class=' col-md-4 col-xs-12' ng-repeat='x in online'>
			<div class='online' >
				<div class='online_content'>
					<div >

    					<div class="online_heading_no">
    						{{x.number}}
    					</div>
    					<div class="online_heading_text">
    						Devices
    					</div>	
    					<div class='online_icon_position'>
    						<i class="material-icons online_icon">devices</i> 
						</div>
						    				
    				</div>		
        		</div>	
			</div>	
			<div class='online_additional'>
				<div class="online_additional_content">
				<div  id="chartonoff" style="height:130px; width:100%;"></div>
				</div>
			</div>	
			<div class='online_footer'>
				<a href='devicestatus.php'>
				<span class='pull-right'>View Details<i style='padding-left:10px;'class="glyphicon glyphicon-circle-arrow-right"></i></span>
				<div class='clearfix'>
				</div>
				</a>
			</div>	
		</div>
		<div class=' col-md-4 col-xs-12' ng-repeat='x in users'>
			<div class='users' >
				<div class='users_content'>
					<div >

    					<div class="users_heading_no">
    						{{x.number}}
    					</div>
    					<div class="users_heading_text">
    						USERS
    					</div>	
    					<div class='users_icon_position'>
    						<i class="glyphicon glyphicon-user users_icon"></i>
						</div>
						    				
    				</div>		
        		</div>	
			</div>	
			<div class='users_additional small'>
				<div class="users_additional_content">
				<table class='table '>
					<tbody>
						<tr><td>New Users:</td><td>{{x.unactivated}}</td></tr>	
						<tr><td>Normal Users:</td><td>{{x.normal}}</td></tr>	
						<tr><td>Admin Users:</td><td>{{x.admin}}</td></tr>	
						<tr><td>Deactivated Users:</td><td>{{x.deactivated}}</td></tr>	

					</tbody>
				</table>
				<hr/>
				</div>
			</div>	
			<div class='users_footer'>
				<a href='manageusers.php'>
				<span class='pull-right'>View Details<i style='padding-left:10px;'class="glyphicon glyphicon-circle-arrow-right"></i></span>
				<div class='clearfix'>
				</div>
				</a>
			</div>	
		</div>
		
	</div>	
	
	<div class='row tiles1'>
		<div class='col-md-4 col-xs-12'>
			<div class='valveselect'>
				<div class='valveselect_header'>
					<p class='selectvalves'>Select group for valves:</p>
					<div class="btn-group select_dropdown" >
					    <button type="button" class="btn btn-default dropdown-toggle" id="displayGroupButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					        <span style='float:left;'>{{ groupSelected}}</span>
					          <span class="caret" style='float:right; position:relative; top:7px;'></span>
					    </button>
					    <ul class="dropdown-menu">
					      
					      <li ng-repeat='action in groups'>
					        <a ng-click="setAction(action)"  ng-if='action.name!=groupSelected'>{{action.name}}</a>
					      </li>
					    </ul>
					</div>
					<br/>
					<br/>
				</div> 
				<div class='valves_additional small'>
					<div class="valves_additional_content">
						<div style='text-align:center;'ng-repeat='x in valves'>
							<hr/>
							<span style='font-size:16px; font-weight:600;'>{{x.deviceId}}</span></br>
							<span>Primary Battery:{{x.prim}}</span></br>
							<span>Secondary Battery:{{x.sec}}</span></br></br>
						</div>		
					</div>
				</div>	
				<div class='valves_footer'>
				<a href='devicestatus.php'>
				<span class='pull-right'>View Details<i style='padding-left:10px;'class="glyphicon glyphicon-circle-arrow-right"></i></span>
				<div class='clearfix'>
				</div>
				</a>
			</div>
			</div>			
		</div>
		<div class='col-md-4 col-xs-12'>
			<div class='sensorselect'>
				<div class='sensorselect_header'>
					<p class='selectvalves'>Select group for sensors:</p>
					<div class="btn-group select_dropdown" >
					    <button type="button" class="btn btn-default dropdown-toggle" id="displayGroupButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					        <span style='float:left;'>{{ groupSelected1}}</span>
					          <span class="caret" style='float:right; position:relative; top:7px;'></span>
					    </button>
					    <ul class="dropdown-menu">
					      
					      <li ng-repeat='action in groups'>
					        <a ng-click="setAction1(action)"  ng-if='action.name!=groupSelected1'>{{action.name}}</a>
					      </li>
					    </ul>
					</div>
					<br/>
					<br/>
				</div> 
				<div class='sensor_additional small'>
					<div class="sensor_additional_content">
						<div style='text-align:center;'ng-repeat='x in sensors'>
							<hr/>
							<span style='font-size:16px; font-weight:600;'>{{x.deviceId}}</span></br>
							<span>Battery:{{x.batt}}</span></br>
							<span ng-if='x.type!="b"'>Moisture:{{x.moisture}}</br></span>
							<span ng-if='x.type=="bthm"'>Temperature:{{x.temp}}</br></span>
							<span ng-if='x.type=="bthm"'>Humidity:{{x.hum}}</br></span>
							</br>			
						</div>		
					</div>
				</div>	
				<div class='sensor_footer'>
				<a href='devicestatus.php'>
				<span class='pull-right'>View Details<i style='padding-left:10px;'class="glyphicon glyphicon-circle-arrow-right"></i></span>
				<div class='clearfix'>
				</div>
				</a>
			</div>
			</div>			
		</div>
		<div class=' col-md-4 col-xs-12' ng-repeat='x in switches'>
			<div class='switches' >
				<div class='switches_content'>
					<div >

    					<div class="switches_heading_no">
    						{{x.number}}
    					</div>
    					<div class="switches_heading_text">
    						Irrigation Valves
    					</div>	
    					<div class='switches_icon_position'>
    						<i class="glyphicon glyphicon-tint switches_icon"></i>
    					</div>
						    				
    				</div>		
        		</div>	
			</div>	
			<div class='switches_additional'>
				<div class="switches_additional_content small">
					<div id="chartoc" style="height:123px; width:100%;"></div>
							
				</div>
			</div>	
			<div class='switches_footer'>
				<a href='valvecontrol.php'>
				<span class='pull-right'>View Details<i style='padding-left:10px;'class="glyphicon glyphicon-circle-arrow-right"></i></span>
				<div class='clearfix'>
				</div>
				</a>
			</div>	
		</div>
		
	</div>	
	<div class='row tiles' >
			<div class=' col-md-12 col-xs-12' style='margin-top:-20px;' >
			<div class='health' >
				<div class='health_content'>
					<div >

    					<div class="health_heading_text">
    						Health
    					</div>	
    					    				
    				</div>		
        		</div>	
        			<div>
        				<div class='health_additional'>
    						<div  class='row' style='background-color:white; margin:0;'>
    			
								<div class='col-md-3 col-xs-12 right_border' style='padding:20px;' >
									<p style='color:black;'>Primary Battery</p>
									<div id="charthealth1" style="height:120px; width:100%;"></div>

								</div>
								<div class='col-md-3 col-xs-12 right_border' style='padding:20px;' >
										<p style='color:black;'>Secondary Battery</p>
										<div id="charthealth2" style="height:120px; width:100%;"></div>
										<span id="chartlegend2"></span>
										
								</div>
								<div class='col-md-3 col-xs-12 right_border' style='padding:20px;' >
									<p style='color:black;'>Moisture</p>
									<div id="charthealth3" style="height:120px; width:100%;"></div>
									
								</div>
								<div class='col-md-3 col-xs-12 ' style='padding:20px;' >
									<p style='color:black;'>Connectivity</p>
									<div id="charthealth4" style="height:120px; width:100%;"></div>
									
								</div>

							</div>
    					</div>	
        			</div>
        	<div class='health_footer'>
				<a href='valvecontrol.php'>
				<span class='pull-right'>View Details<i style='padding-left:10px;'class="glyphicon glyphicon-circle-arrow-right"></i></span>
				<div class='clearfix'>
				</div>
				</a>
			</div>
			</div>	
			</div>
		
				
	</div>	
	<div class='row tiles'>
		<div class='col-md-12 col-xs-12' style='margin-top:-20px;'>
				<div class='weather' style='margin-bottom:30px; border-radius:4px;'>
				<iframe id="forecast_embed" type="text/html" frameborder="0" height="245" width="90%" src="http://forecast.io/embed/#lat=19.133521&lon=-72.908127&name=IIT Bombay&units=ca"> </iframe> 
				</div>
			</div>
	</div>	
</div>
<div  ng-include="'footer.php'">	
</div>

<?php
	}
	else if($user_type==0){

	
?>

<div style='position:fixed;top:0;left:0;width:100%; z-index:99;'><div ng-include="'menu/demo/advanced.php'"></div></div>
<div  style='padding-top:100px;text-align:center; color:black;font-size:20px;'><p>Your account is under verification! Please visit again later</p></div>
<div style='position:absolute; top:100vh;left:0px;width:100%;'ng-include="'footer.php'"></div>	

<?php	}
	else if($user_type==3){
?>		
<div style='position:fixed;top:0;left:0;width:100%; z-index:99;'><div ng-include="'menu/demo/advanced.php'"></div></div>
<div  style='padding-top:100px;text-align:center; color:black;font-size:20px;'><p>Your account has been de-activated! Contact your administrator</p></div>
<div style='position:absolute; top:100vh;left:0px;width:100%;'ng-include="'footer.php'"></div>	
<?php
	}
}
else{
header("Location:index.php");

}
?>
<!-- jQuery -->
<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<!-- AngularJs -->
<script src="./bower_components/angular/angular.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src='scripts/dashboard.js'></script>

 <!-- Angular Material Scripts --> 
  <script src="./bower_components/angular-aria/angular-aria.js"></script>
    <script src="./bower_components/angular-animate/angular-animate.js"></script>
    <script src="./bower_components/angular-material/angular-material.js"></script>
<script src="./bower_components/amcharts3/amcharts/amcharts.js"></script>
    <script src="./bower_components/amcharts3/amcharts/pie.js"></script>
    <script src="./bower_components/amcharts3/amcharts/plugins/dataloader/dataloader.min.js"></script>



<script type="text/javascript" src="menu/dist/js/jquery.mmenu.all.min.js"></script>
		
</body>

</html>
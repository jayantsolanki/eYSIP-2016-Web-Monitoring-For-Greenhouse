<!doctype html>
<html lang='en' ng-app='devicehealthapp'>
	<head>
		<meta charset='utf-8'>
   		<meta http-equiv="X-UA-Compatible" content="IE=edge">
   		<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Health-Greenhouse Monitoring</title>
<link type="text/css" rel="stylesheet" href="menu/demo/css/demo.css" />
<link type="text/css" rel="stylesheet" href="menu/dist/css/jquery.mmenu.all.css" />
       <link href='./bower_components/roboto-fontface/css/roboto/roboto-fontface.css' rel='stylesheet' type='text/css'>
    
     	<link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Angular material css-->
		<link rel="stylesheet" href="./bower_components/angular-material/angular-material.css">
      
<link rel="stylesheet" href='styles/health.css'>
<link href="./bower_components/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">

	</head>
	<body ng-controller='devicehealthcontroller' style='position:relative;'>
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
<div class='controller'>
<p style='padding-top:60px; font-size:25px; padding-left:20px; text-transform:uppercase;'>System Health and Automation Control</p>
<div >
   <div ng-cloak >
  <md-content >
    <md-tabs md-dynamic-height md-border-bottom>
      <md-tab label="Device Health">
        <md-content >
        <p style='padding-left:25px;padding-top:10px; font-size:20px;' >VALVES<p>
          <div class='container-fluid'>
            <div class='row'>
              <div class='col-md-3 col-xs-12'ng-repeat='x in health' ng-if='x.type==1'>
                <div class='boxes'>
                  <p class='dev_heading' style='border-bottom:1px solid #edeff0;padding-bottom:10px;'>{{x.deviceId}}
            <br/>
            <span class='small ' style='color:#000;'>{{x.name}}</span>
            <span class='small label label-primary ' style='font-size:12px;position:relative;bottom:5px;' ng-if='x.type==1'>valve</span>
            <span class='small label label-primary ' style='font-size:12px;position:relative;bottom:5px;' ng-if='x.type==2'>sensor</span>

            </p>
                  <p ng-class="{'unhealthy':x.field1==1,'healthy':x.field1==0,'notapplicable':x.field1==null}" style='color:#fff;padding:10px;margin:0;margin-top:-10px;margin-left:-15px;margin-right:-15px;border-bottom:1px solid #191919; border-top:1px solid black;'>Primary battery:
                    <span ng-if='x.switches==1'>{{x.prim/1024 | number : 3}} Volts</span><span ng-if='x.switches>1'>N.A</span> </p>
                  <p ng-class="{'unhealthy':x.field2==1,'healthy':x.field2==0,'notapplicable':x.field2==null}" style='color:#fff;padding:10px;margin:0;margin-left:-15px;margin-right:-15px;border-bottom:1px solid #191919;'>Secondary battery:
                    <span  ng-if='x.switches==1'>{{x.sec/137.1428571428571 | number : 3}} Volts</span><span ng-if='x.switches>1'>N.A</span></p>
                  
                  
                  <p ng-class="{'unhealthy':x.field6==1,'healthy':x.field6==0}" style='color:#fff;padding:10px;margin:0;margin-left:-15px;margin-right:-15px;'>Connectivity:
                    <span ng-if='x.field6==1'>Disconnected</span><span ng-if='x.field6==0'>Normal</span></p>
                         </div>
            </div>
          </div>
          <p style='padding-top:10px;  padding-left:10px;font-size:20px;'>SENSORS</p>
            <div class='row'>
              <div class='col-md-3 col-xs-12'ng-repeat='x in health' ng-if='x.type==2'>
                <div class='boxes'>
                  <p class='dev_heading' style='border-bottom:1px solid #edeff0;'>{{x.deviceId}}
            <br/>
            <span class='small ' style='color:#000;'>{{x.name}}</span>
            <span class='small label label-primary ' style='font-size:12px;position:relative;bottom:5px;' ng-if='x.type==1'>valve</span>
            <span class='small label label-primary ' style='font-size:12px;position:relative;bottom:5px;' ng-if='x.type==2'>sensor</span>

            </p>
                 <p ng-class="{'unhealthy':x.field1==1,'healthy':x.field1==0}" style='color:#fff;padding:10px;margin:0;margin-top:-10px;margin-left:-15px;margin-right:-15px;border-bottom:1px solid #191919; border-top:1px solid black;'>Battery:
                    {{x.prim/4096*4 | number : 3}} Volts</p>
                  <p ng-class="{'unhealthy':x.field3==1 || x.field3==null,'healthy':x.field3==0 ,'notapplicable':x.senstype=='b'}" style='color:#fff;padding:10px;margin:0;margin-left:-15px;margin-right:-15px;border-bottom:1px solid #191919;'>Moisture:
                    <span  ng-if="x.senstype!='b' && x.field3!=null">{{x.sec}}</span><span ng-if="x.senstype=='b'">N.A</span>
                    <span ng-if="x.field3==null && x.senstype!='b'">Not Available</span>
                  </p>
                  
                  
                  <p ng-class="{'unhealthy':x.field6==1,'healthy':x.field6==0}" style='color:#fff;padding:10px;margin:0;margin-left:-15px;margin-right:-15px;'>Connectivity:
                    <span ng-if='x.field6==1'>Disconnected</span><span ng-if='x.field6==0'>Normal</span></p>
                         </div>
            
                </div>
            </div>
          </div>
        </md-content>
      </md-tab>
      <md-tab label="Tasks">
        <md-content class="md-padding" >
        <div class='container' >
          <div class='row'> 
            <div class='col-md-4 col-xs-12'>
              <p  style='margin-top:20px;'class='alert alert-danger hide errorspan' >All fields are compulsory</p>
              <p  style='padding-top:20px;'>Name:</p>
              <div class="form-group groupselect">
              <input type="text" placeholder='Name of task'class="form-control" id="name">
              </div>
              <p class='selectvalves' >Select group for valves:</p>
              <div class="btn-group select_dropdown" >
                  <button type="button" class="btn btn-default dropdown-toggle groupselect"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span style='padding-right:5px; '>{{groupSelected}}</span>
                  </button>
                  <ul class="dropdown-menu">
                    
                    <li ng-repeat='action in groups'>
                      <a ng-click="setAction(action)" ng-if='action.name!=groupSelected' >{{action.name}}</a>
                    </li>
                  </ul>
              </div>
              
              <p class='selectvalves' style='padding-top:10px;'>Select field to monitor:</p>
              <div class="btn-group select_dropdown" >
                  <button type="button" class="btn btn-default dropdown-toggle groupselect"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span style='padding-right:5px; '>{{fieldSelected}}</span>
                  </button>
                  <ul class="dropdown-menu">
                    
                    <li >
                      <a ng-if="fieldSelected!='Battery'"ng-click="setAction1('Battery')">Battery</a>
                      <a ng-if="fieldSelected!='Moisture'"ng-click="setAction1('Moisture')">Moisture</a>
                      <a ng-if="fieldSelected!='Online/Offline'"ng-click="setAction1('Online/Offline')">Online/Offline</a>
                    </li>
                  </ul>
              </div>
              <p class='selectvalves' style='padding-top:10px;'>Select Action to perform:</p>
              <div class="btn-group select_dropdown" >
                  <button type="button" class="btn btn-default dropdown-toggle groupselect"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span style='padding-right:5px; '>{{actionSelected}}</span>
                  </button>
                  <ul class="dropdown-menu">
                    
                    <li ng-repeat='z in action'>
                          <a ng-click="setAction2(z)" ng-if='z.name!=actionSelected' >{{z.name}}</a>
                      
                    </li>
                  </ul>
              </div>
              <div ng-if="fieldSelected!='Online/Offline'">
              
              <p class='selectvalves' style='padding-top:10px;'>Select Condition Case:</p>
              <div class="btn-group select_dropdown" >
                  <button type="button" class="btn btn-default dropdown-toggle groupselect"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span style='padding-right:5px; '>{{conditionSelected}}</span>
                  </button>
                  <ul class="dropdown-menu">
                    
                    <li >
                      <a ng-if="conditionSelected!='<'"ng-click="setAction3('<')">&lt;</a>
                      <a ng-if="conditionSelected!='>'"ng-click="setAction3('>')">&gt;</a>
                      <a ng-if="conditionSelected!='='"ng-click="setAction3('=')">=</a>
                    </li>
                  </ul>
              </div>
              </div>
              <div ng-if="fieldSelected!='Online/Offline'">
               <p  style='padding-top:20px;'>Enter Threshold Value:</p>
              <div class="form-group groupselect" >
              <input type="text" placeholder='Condition Value'class="form-control" id="value">
              </div>
            </div>
            <br/>
              <button style='margin-top:15px;' ng-click='add()'class='btn btn-danger add'>ADD</button>
             
            </div>
            <div class='col-md-8 col-xs-12'>
                <div class='mob' class = "table-responsive" >
                   <table class = "table" >
                      
                      <caption>Monitoring List</caption>
                      
                      <thead>
                         <tr>
                            <th>Name</th>
                            <th>Group</th>
                            <th>Field</th>
                            <th>Action</th>
                            <th>Condition</th>
                            <th>Threshold</th>
                            <th>Delete</th>
                         </tr>
                      </thead>
                      
                      <tbody>
                         <tr ng-repeat='x in react'>
                          <td>{{x.name}}</td>
                          <td>{{x.group}}</td>
                          <td>{{x.field}}</td>
                          <td>{{x.action}}</td>
                          <td>{{x.condition}}</td>
                          <td>{{x.threshold}}</td>
                         <td><i  ng-click='delete(x)'class="glyphicon del glyphicon-trash"></i></td>
                         </tr>
                      </tbody>
                      
                   </table>
                </div>
            </div>  
          </div>
        </div>
        </md-content>
      </md-tab>
     
    </md-tabs>
  </md-content>
</div>
</div>
<div style='padding-top:100px;' ng-include="'footer.php'"></div> 

</div>


<?php
  }
  else if($user_type==0){
header("Location:dashboard.php");

  
  }
  else if($user_type==3){
header("Location:dashboard.php");

  }
}
else{
header("Location:index.php");

}
?>

		<script src="./bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->

    <script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    	<!-- AngularJs -->
    	<script src="./bower_components/angular/angular.min.js"></script>
    	    	
    	<!-- Angular Material Scripts --> 
    	<script src="./bower_components/angular-material/angular-material.js"></script>
    	<script src="./bower_components/angular-aria/angular-aria.js"></script>
    	<script src="./bower_components/angular-animate/angular-animate.js"></script>
    	<script type="text/javascript" src="scripts/devicehealth.js"></script>
	<script type="text/javascript" src="menu/dist/js/jquery.mmenu.all.min.js"></script>
<script src='./bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js'></script>
<script src='./bower_components/angular-confirm-modal/angular-confirm.min.js'></script> 

  </body>
</html>
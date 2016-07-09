<!doctype html>
<html lang='en' ng-app='taskschedulingapp' >
<head>
	<meta charset='utf-8'>
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
       <link href='./bower_components/roboto-fontface/css/roboto/roboto-fontface.css' rel='stylesheet' type='text/css'>

     <title>Task Scheduling-Greenhouse monitoring</title>
<link type="text/css" rel="stylesheet" href="menu/demo/css/demo.css" />
<link type="text/css" rel="stylesheet" href="menu/dist/css/jquery.mmenu.all.css" />

<!-- Bootstrap Core CSS -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Angular material css-->
<link rel="stylesheet" href="./bower_components/angular-material/angular-material.css">

<link rel="stylesheet" type='text/css' href="styles/taskscheduling.css" >
<link rel="stylesheet" href='./bower_components/components-font-awesome/css/font-awesome.min.css'>    
 <link href="./bower_components/material-design-icons/iconfont/material-icons.css"
      rel="stylesheet">

</head>
<body ng-controller="taskschedulecontroller">
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
<div class='container-fluid'>
<div class='row'>
<div class='col-md-offset-1 col-md-3 col-xs-12 addschedule'>

<p class='heading'>Scheduler</p>

<p class='heading2'>Add Schedule</p>
<div class='mobile'>
   <div  class=' group_row pad'> 
    <md-input-container>
       <span></span>
        <label>Select Group:</label>
        <md-select ng-model="schedulegroup" ng-change="onchange()"style='width:215px;'>
          <md-option ng-repeat="group in groups" value="{{group.id}}" >
            {{group.name}}
          </md-option>

         </md-select>
      
      </md-input-container>
       <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
   
  		      	</section>
  </div>
  <div  class=' group_row type hide'> 
    <md-input-container>
       <span></span>
        <label>Select Type:</label>
        <md-select ng-model="scheduletype" ng-change="onchange2()"style='width:215px;'>
          <md-option >Period</md-option>
          <md-option>Duration</md-option>
          <md-option>Frequency</md-option>
         </md-select>
      
      </md-input-container>
       <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
   
  		      	</section>
  </div>	
  <div  class=' starttime hide'> 
  <span style='position:relative; top:4px;'> Start Time:</span>
  
    <md-input-container>
       <span></span>
        <label>Hrs:</label>
        <md-select ng-model='starthrs'style='width:50px;'>
          <md-option ng-repeat='x in range(0,23)'>
        {{x}}
        </md-option>
        </md-select>
      
      </md-input-container>
    
       <span style='padding-left:20px;'>
        <md-input-container >
        <label>Mins:</label>
        <md-select ng-model='startmins' style='width:50px;'>
          <md-option ng-repeat='x in range(0,59)'>
        {{x}}
        </md-option>
        </md-select>
      
      </md-input-container>
       <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
   
  		      	</section>
  		 </span>
      
  </div>	
  <div  class=' stoptime hide'> 
  <span style='position:relative; top:4px;'> Stop Time:</span>
  
    <md-input-container>
       <span></span>
        <label>Hrs:</label>
        <md-select ng-model='stophrs'style='width:50px;'>
          <md-option ng-repeat='x in range(0,23)'>
        {{x}}
        </md-option>
        </md-select>
      
      </md-input-container>
    
       <span style='padding-left:20px;'>
        <md-input-container >
        <label>Mins:</label>
        <md-select ng-model='stopmins' style='width:50px;'>
          <md-option ng-repeat='x in range(0,59)'>
        {{x}}
        </md-option>
        </md-select>
      
      </md-input-container>
       <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
   
  		      	</section>
  		 </span>
      
  </div>	
    <div  class='row duration hide'> 
  <span style='position:relative; top:4px;'> Duration:</span>
  
        <md-input-container style='padding-left:10px;'>
        <label style='padding-left:13px;'>Mins:</label>
        <md-select ng-model='duration' style='width:50px;'>
          <md-option ng-repeat='x in range(10,59)'>
        {{x}}
        </md-option>
        </md-select>
      
      </md-input-container>
       <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
   
  		      	</section>
     
  </div>	
    	<div  class='row frequency hide'> 
			  <span style='position:relative; top:4px;'> Repeat Every :</span>
			  
			  <md-input-container style='padding-left:10px;' >
			  <label style='padding-left:13px;'>Hrs:</label>
			  <md-select ng-model='frequency' style='width:50px;'>
			  <md-option ng-repeat='x in range(4,12,4)'>
			  {{x}}
			  </md-option>
			  </md-select>
			      
			  </md-input-container>
			  <section layout="row" layout-sm="column" layout-align="center center" layout-wrap></section>
			     
  		</div>	
      <span class='add1'>
  		<button class='btn btn-primary hide add' ng-click='enterschedule()'>Add</button>
	    </br>
      </br>
    </br>
         <span class='errorspan1 alert alert-danger hide' style='margin-left:-10px;'>Start time cannot be greater than stop time </span>
      <span class='errorspan alert alert-danger hide' style='margin-left:40px;'>All fields are mandatory</span> 
       <span>
  </div>
</div>
  <div class='col-md-offset-1 col-md-6 col-xs-12' >
  <p class='heading2 tasklist '> Scheduled tasks </p>
    <div ng-repeat='y in groups' style='padding-left:20px;' class='small' >
      <div class='boxes' ng-if='checkgroup(y.id)'>
      <span ng-if='checkgroup(y.id)' class='groupheading'>Group:<span class='label label-primary'>{{y.name}}</span></span>
      <span ng-repeat ='x in tasks' ng-if='x.groupId!=null' >
        <div class='schedules'>
        <div ng-if='x.groupId==y.id' ng-init='z=getnumber()' style='padding-top:10px; padding-bottom:10px;'>
              <span>{{z}}.</span> 
          <span>Starts:{{x.start}} hrs</span>
          &nbsp;
        <span>Stops:{{x.stop}} hrs</span>
        &nbsp;
       <span ng-if='x.active=="3"' style='color:#A94442; position:relative; top:5px;'><i class="material-icons md-18">block</i></span>
        <span ng-if='x.active=="2"' style='color:#8A6D3B; position:relative; top:5px;'><i class="material-icons md-18">new_releases</i></span>
       <span ng-if='x.active=="1"' style='color:#3C763D; position:relative; top:5px;'><i class="material-icons md-18">sync</i></span>
       <span ng-if='x.active=="0"' style='color: #A94442; position:relative; top:5px;'><i class="material-icons md-18">sync_disabled</i></span>
      
        <span ng-if='x.type=="1"' class='label label-primary'>Scheduled </span>
        <span ng-if='x.type=="2"' class='label label-primary'>Automated </span>
        <span ng-if='x.type=="0"' class='label label-primary'>Manual </span>
        <span style='color:#A94442; font-size:18px; position:relative;top:5px; padding-left:5px;' class='delete' ng-click="delete(x)"><i class="glyphicon glyphicon-trash delete"></i></span>&nbsp;
         <span ng-if='x.active!="3"' style='color:#A94442;' class='delete' ng-click="disable(x)"><span class='label label-danger'>Disable</span></span>
         <span ng-if='x.active=="3"' style='color:#A94442;' class='delete' ng-click="enable(x)"><span class='label label-success'>Enable</span></span>
      
        </div>
      </div>
      </span>
      </div>
    </div>
        <div style='margin-left:20px;'>
        <div class='boxes' >
            <span ng-repeat='x in tasks' ng-if='x.groupId==null' >
            <span class='groupheading'>{{x.deviceId}}/{{x.switchId}}</span>
            <div class='schedules small' style='padding-top:10px;padding-bottom:10px;'>
              <span>Starts:{{x.start}} hrs</span>
        &nbsp;
        <span>Stops:{{x.stop}} hrs</span>
        &nbsp;
       <span ng-if='x.active=="3"' style='color:#A94442; position:relative; top:5px;'><i class="material-icons md-18">block</i></span>
        <span ng-if='x.active=="2"' style='color:#8A6D3B; position:relative; top:5px;'><i class="material-icons md-18">new_releases</i></span>
       <span ng-if='x.active=="1"' style='color:#3C763D; position:relative; top:5px;'><i class="material-icons md-18">sync</i></span>
       <span ng-if='x.active=="0"' style='color: #A94442; position:relative; top:5px;'><i class="material-icons md-18">sync_disabled</i></span>
      
        <span ng-if='x.type=="1"' class='label label-primary'>Scheduled </span>
        <span ng-if='x.type=="2"' class='label label-primary'>Automated </span>
        <span ng-if='x.type=="0"' class='label label-primary'>Manual </span>
        <span style='color:#A94442; font-size:18px; position:relative;top:5px; padding-left:5px;' class='delete' ng-click="delete(x)"><i class="glyphicon glyphicon-trash delete"></i></span>&nbsp;
         <span ng-if='x.active!="3"' style='color:#A94442; ' class='delete' ng-click="disable(x)"><span class='label label-danger'>Disable</span></span>
        <span ng-if='x.active=="3"' style='color:#A94442;' class='delete' ng-click="enable(x)"><span class='label label-success'>Enable</span></span>
        
            </div>
            </span>
        </div>
        </div>  
    </div>
</div>
</div>
<div ng-include="'footer.php'"></div> 
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

<!-- jQuery -->
<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<!-- AngularJs -->
<script src="./bower_components/angular/angular.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- Angular Material Scripts --> 
  <script src="./bower_components/angular-aria/angular-aria.js"></script>
    <script src="./bower_components/angular-animate/angular-animate.js"></script>
    <script src="./bower_components/angular-material/angular-material.js"></script>
 <!-- Customs Scripts -->
<script type='text/javascript' src="scripts/taskscheduling.js" ></script>
<script type="text/javascript" src="menu/dist/js/jquery.mmenu.all.min.js"></script>
<script src='./bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js'></script>
<script src='./bower_components/angular-confirm-modal/angular-confirm.min.js'></script> 
</body>
</html>
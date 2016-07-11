<!doctype html>
<html lang='en' ng-app='chartdisplayapp' >
	<head>
		<meta charset='utf-8'>
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
      <link href='./bower_components/roboto-fontface/css/roboto/roboto-fontface.css' rel='stylesheet' type='text/css'>
 
    <title>Displaying Charts-Greenhouse Monitoring</title>
<link type="text/css" rel="stylesheet" href="menu/demo/css/demo.css" />
<link type="text/css" rel="stylesheet" href="menu/dist/css/jquery.mmenu.all.css" />

		<!-- Bootstrap Core CSS -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Angular material css-->
		<link rel="stylesheet" href="./bower_components/angular-material/angular-material.css">
		<link rel="stylesheet" type='text/css' href="styles/displaycharts.css" >
		<!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
<link href="./bower_components/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">

  </head>

	<body ng-controller="chartdisplaycontroller" >
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
			<h2 class='heading' style="text-align:center;">DATA VISUALIZATION</h2>
    	<div class="container-fluid" ng-cloak>
  			<div class="row">
    			<div  class=' col-md-2 col-xs-6'>
						<md-input-container>
       				<span></span>
        			<label>Select Group:</label>
        			<md-select ng-model="userGroup" ng-change="onchange()" style='width:150px;'>
          			<md-option ng-repeat="group in groups"  value="{{group.id}}" >
            			{{group.name}}
          			</md-option>
							</md-select>
      			</md-input-container>
            <section layout="row" layout-sm="column" layout-align="center center" layout-wrap></section>
            <md-input-container >
              <span></span>
              <label>Select Device:</label>
              <md-select ng-model="userDevice"  ng-change="onchange1()" style='width:180px;'>
                <md-option ng-repeat="device in devices"  value="{{device.deviceId}}" >
                  {{device.deviceId}}
                </md-option>
              </md-select>
            </md-input-container>
            <section layout="row" layout-sm="column" layout-align="center center" layout-wrap></section>
            <div class="list-group" ng-if='x.deviceType==2 && x.noOfSwitches==0' ng-repeat='x in deviceinfo'>
              <a class="list-group-item" ng-click="showGraph(x.device_Id,x.deviceType,3,tab,mymonth,myyear,myweek,mydate,limit)" id="battery">Battery</a>
              <a class="list-group-item" ng-click="showGraph(x.device_Id,x.deviceType,4,tab,mymonth,myyear,myweek,mydate,limit)" id="temperature" ng-if='x.field1==="bthm"'>Temperature</a>
              <a class="list-group-item" ng-click="showGraph(x.device_Id,x.deviceType,5,tab,mymonth,myyear,myweek,mydate,limit)" id="humidity" ng-if='x.field1==="bthm"'>Humidity</a>
              <a class="list-group-item" ng-click="showGraph(x.device_Id,x.deviceType,6,tab,mymonth,myyear,myweek,mydate,limit)" id="moisture"ng-if='x.field1==="bthm" || x.field1==="bm"'>Moisture</a>
            </div>
            <div class="list-group" ng-if='x.deviceType==1 && x.noOfSwitches==1' ng-repeat='x in deviceinfo'>
              <a class="list-group-item" ng-click="showGraph(x.device_Id,x.deviceType,1,tab,mymonth,myyear,myweek,mydate,limit)" id="pb">Primary Battery</a>
              <a class="list-group-item" ng-click="showGraph(x.device_Id,x.deviceType,2,tab,mymonth,myyear,myweek,mydate,limit)" id="sb">Secondary Battery</a>
            </div>
            <div class=" chartDisplayDiv configuration" >
              <div ng-repeat='x in deviceinfo'>
                <div class=" displayafter extrass" style="margin-top:40px">
                  <md-input-container >
                    <label>Y Axis Limit (ADC)</label>
                    <input id="yaxis" ng-model="limit" >
                    <p class="limit_p limit_error">Enter Positive number</p>
                  </md-input-container>
                </div>
                <div class=" displayafter extrass" >
                  <md-button class="md-raised md-primary" ng-click="validateExtra(x.device_Id,x.deviceType,field,tab,mymonth,myyear,myweek,mydate,limit)">Submit</md-button>
                </div>
              </div>
            </div> 
          </div>
          <div class="chartDisplayDiv chartDisplayDiv1 col-md-9 col-xs-12 chartss" style='position:relative;'ng-repeat='x in deviceinfo'>
            <md-content>
              <md-tabs md-dynamic-height="" md-border-bottom="">
                <md-tab ng-click="showGraph(x.device_Id,x.deviceType,field,1,mymonth,myyear,myweek,mydate,limit)" label="Daily">
                  <md-content class="md-padding">
                    <div id="chartdiv1" style="height:500px;"></div>
                  </md-content>
                </md-tab>
                <md-tab ng-click="showGraph(x.device_Id,x.deviceType,field,2,mymonth,myyear,myweek,mydate,limit)" label="Weekly">
                  <md-content class="md-padding">
                    <div id="chartdiv2" style="height:500px;"></div>
                  </md-content>
                </md-tab>
                <md-tab ng-click="showGraph(x.device_Id,x.deviceType,field,3,mymonth,myyear,myweek,mydate,limit)" label="Monthly">
                  <md-content class="md-padding">
                    <div id="chartdiv3" style="height:500px;"></div>
                  </md-content>
                </md-tab>
                <md-tab ng-click="showGraph(x.device_Id,x.deviceType,field,4,mymonth,myyear,myweek,mydate,limit)" label="Yearly">
                  <md-content class="md-padding">
                    <div id="chartdiv4" style="height:500px;"></div>
                  </md-content>
                </md-tab>
              </md-tabs>
            </md-content>
             <!--<span id="extra" style='position:absolute; top:0;right:0;'>Hello</span>-->
            <div class="extradata">
              <span  ng-click="before()" class="glyphicon glyphicon-chevron-left removeGlyphicon"></span>
              <span ng-if="tab==1">{{mydate}} {{mymonth1}}</span>
              <span ng-if="tab==2">{{myweek | getWeekRange}}</span>
              <span id="impspan" ng-if="tab==3">{{mymonth1}}, {{myyear}}</span>
              <span ng-if="tab==4">{{myyear}}</span>
              <span  ng-click="after()" class="glyphicon glyphicon-chevron-right"></span>
            </div>
          </div>
        </div>

      </div>
        <div ng-if="dataLoading" class="progressCirculardemoBasicUsage col-md-offset-5 col-md-2 col-xs-12" >
          <md-content layout-padding="">
            <div layout="row" layout-sm="column" layout-align="space-around">
              <md-progress-circular md-mode="indeterminate" md-diameter="96"></md-progress-circular>
            </div>
          </md-content>
        </div>
        <div style="margin-left:45px" ng-if='x.deviceType==1 && x.noOfSwitches!=1 ' ng-repeat='x in deviceinfo'>
          <p>No Charts available</p>
        </div>
      <div class="row">
       
      </div>
     
<div style='margin-top:100px;' ng-include="'footer.php'"></div> 

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
    <!-- AngularJs -->
    <script src="./bower_components/angular/angular.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Angular Material Scripts --> 
    <script src="./bower_components/angular-material/angular-material.js"></script>
    <script src="./bower_components/angular-aria/angular-aria.js"></script>
    <script src="./bower_components/angular-animate/angular-animate.js"></script>
    <!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular-messages.js"></script>-->
    <script src="./scripts/loading.js"></script>
    <!-- Amcharts Library -->
    <script src="./bower_components/amcharts3/amcharts/amcharts.js"></script>
    <script src="./bower_components/amcharts3/amcharts/serial.js"></script>
    <script src="./bower_components/amcharts3/plugins/dataloader/dataloader.min.js"></script>
   
    <!-- Customs Scripts -->
    <script type='text/javascript' src="scripts/displaycharts.js" ></script>
<script type="text/javascript" src="menu/dist/js/jquery.mmenu.all.min.js"></script>

	</body>
</html>	









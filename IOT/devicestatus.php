<!doctype html>
<html lang='en' ng-app='devicestatusapp' >
<head>
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <title>Device status-Greenhouse monitoring</title>
<!-- Bootstrap Core CSS -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Angular material css-->
<link rel="stylesheet" href="./bower_components/angular-material/angular-material.css">

<link rel="stylesheet" type='text/css' href="styles/devicestatus.css" >
<!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

</head>
<body style='position:relative;'>

	<div ng-controller="devicestatuscontroller"class='controller'  >
	<h2 class='heading'>DEVICE STATUS</h2>
    
	<div class="md-padding" ng-cloak>
  <div>
    <div layout="row" class='group_row'>

      <md-input-container>
       <span></span>
        <label>Select Group:</label>
        <md-select ng-model="userGroup" ng-change="onchange()"style='width:150px;'>
          <md-option ng-repeat="group in groups" value="{{group.id}}" >
            {{group.name}}
          </md-option>

         </md-select>
      
      </md-input-container>
       <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
   
  		     <md-button class="md-raised md-warn dispbutton" ng-click="display()">Display</md-button>
   	</section>
      	</div>
  </div>
</div>
<p style='margin-left:50px;'>Group selected: <span ng-repeat='x in groups'><span ng-if='x.id==userGroup' class='label label-info'>{{p}}</span></span></p>
	<div class='row '>
    
		<div ng-repeat='x in devices' class='col-md-4 col-xs-12 card' >
  		<div class="card__front small"  ng-attr-id='{{"a"+x.id }}'>
      	<div ng-class='{boxes1:x.typeId==1 && x.switches<=1,boxes2:x.typeId==2,boxes3:x.typeId==1 && x.switches>1}'>
          <div class='row'  ng-class='{offline1:x.status==0,online1:x.status==1}'style=' margin-top:-10px; margin-left:-30px;margin-right:-30px;padding-left:10px;padding-top:10px;padding-bottom:10px;'>
            <span ng-if='x.status==1'><i class="material-icons" style='color:#fff;'>network_wifi</i><span class="updatedspan">Updated:{{x.created_At}}</span></span>
            <span ng-if='x.status==0'><i class="material-icons" style='color:#fff;'>signal_wifi_off</i><span class="updatedspan">Updated:{{x.created_At}}</span></span></span>
          </div>
          <div class='row' ng-class='{offline2:x.status==0,online2:x.status==1}'style=' margin-top:0px; margin-left:-30px;margin-right:-30px; padding-left:30px;'>
          <p class='dev_heading'>{{x.deviceId}}
            <br/>
            <span class='small ' style='color:#fff;'>{{x.name}}</span>
            <span class='small label label-primary ' style='font-size:12px;'>{{x.typename}}</span>
          
          </p>
          </div>  

              <div class="row" style='padding-top:15px;'>
                <!-- <div class="col-md-3  col-md-offset-1 col-xs-12">
                  <p ng-if='x.typeId==1'><span class='details'>{{x.name}}</p> 
        			    
        			    <p ng-if='x.typeId==1'><span class='details'>Switches:</span> {{x.switches}}</p> 
            	  </div> -->
                <div class=" text-center col-md-12 col-xs-12">
                  <p ng-if='x.switches<=1'><span class='details updated_at' >Battery Level</span></p>
                  <span ng-if='x.switches<=1'><span class='details updated_at' >Primary:</span>{{x.prim}} </span>
                  <span ng-if='x.switches<=1 && x.typeId==1'><span class='details updated_at' >Secondary:</span>{{x.sec}} </span  >
                  <span  ng-if='x.typeId==1' class='icons' ng-click="clicked(x.id)"><i class="material-icons"  style='color:black;'>flip_to_back</i></span>
                  <p ng-if='x.typeId==2'><span class='details updated_at' >Moisture:</span>{{x.sec}} </p>
                  <p class='updated_at small'style='color:#999;' ng-if='x.switches<=1'>Updated: {{x.updated_at}}</p>         
                </div>          

              </div>
          
    	</div>	
  	</div>
  <div class='card__back' ng-attr-id='{{"b"+x.id }}' >
    <div ng-class='{boxes1:x.typeId==1 && x.switches<=1,boxes2:x.typeId==2,boxes3:x.typeId==1 && x.switches>1}' style='overflow-y:scroll;' >
  <table >
    <tr>
      <th>Switch Id</th>
      <th>Group </th>
      <th>Status</th>
    </tr>
    <tr ng-repeat="y in switches" ng-if='x.deviceId==y.deviceId'>
      <td >{{ y.switchId }}.</td>
      <td><span ng-repeat ='z in groups'> <span ng-if='z.id==y.groupId'>{{z.name}}</span></span></td>
      <td><span ng-if="y.action==0" class='label label-danger'>Closed</span>
  <span ng-if="y.action==1" class='label label-success'>Open</span>
      </td>
    </tr>
  </table>
            <span  ng-if='x.typeId==1' ng-class='{icons1:x.switches<=1,icons2:x.switches>1}' ng-click="clicked2(x.id)"><i class="material-icons" style='color:black;'>flip_to_front</i></span>
        
     </div>
  </div>

</div>
</div>	
</div>
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
 <!-- Angular websocket -->   
<script src='./bower_components/angular-websocket/dist/angular-websocket.min.js'></script>
<!-- Customs Scripts -->
<script type='text/javascript' src="scripts/devicestatus.js" ></script>
  
</body>
</html>

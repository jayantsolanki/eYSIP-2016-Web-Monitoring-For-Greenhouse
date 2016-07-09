<!doctype html>
<html ng-app='myapp'>
<head>
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
       <link href='./bower_components/roboto-fontface/css/roboto/roboto-fontface.css' rel='stylesheet' type='text/css'>

  <!-- 	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
 -->    <title>Control Valves-Greenhouse monitoring</title>
<link type="text/css" rel="stylesheet" href="menu/demo/css/demo.css" />
<link type="text/css" rel="stylesheet" href="menu/dist/css/jquery.mmenu.all.css" />
    
      <!-- Bootstrap Core CSS -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Angular material css-->
<link rel="stylesheet" href="./bower_components/angular-material/angular-material.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

      <link href='styles/valvecontrol.css' rel='stylesheet' type='text/css'>
 <link href="./bower_components/material-design-icons/iconfont/material-icons.css"
      rel="stylesheet">
<link href="./bower_components/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">

</head>
<body  ng-controller="DropdownCtrl">
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
  
	<div >
		<div >
      <div >
				<p id="cvtitle">Controlling Valves</p>
	 			<div class="btn-group" style='margin-left:50px;'>
            <button type="button" class="btn btn-default dropdown-toggle" id="displayGroupButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ groupSelected}}
                  <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              
              <li ng-repeat='action in actions'>
                <a ng-click="setAction(action)"  ng-if='action.name!=groupSelected'>{{action.name}}</a>
              </li>
            </ul>
        </div>
        <br>
        <div id='groupdisplay' style='margin-left:50px;'>
          <span>Group Selected : </span>
          <span class='label label-primary'>{{groupSelected}}</span>

        </div>

        <div id='duration' style='margin-left:50px;'>
          <p>Duration (in mins)</p>
          <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" id="displayGroupButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{duration}}  
                  <span class="caret"></span>
            </button>
            <ul class="dropdown-menu scrollable-menu">
              <li ng-repeat='x in range(10,60)'>
               <a ng-click="change2(x)"ng-if='x!=duration'> {{x}}</a>
              </li>
            </ul>
        </div>

        <p style=' text-align:center;padding:5px 5px 5px 5px;'><span id="wserror" class='label'style="color:white;"></span></p>


        </div>
        <div class='container-fluid' style='padding-bottom:100px;'>
        <div class='row'>
          <div class="col-md-4 col-xs-12" ng-repeat="x in details">
              <div class='valvedata '>
          <div  ng-attr-class='{{"b"+x.devices_id}} row' ng-class='{offline1:x.dstatus==0,online1:x.dstatus==1}'style=' margin-left:0px;margin-right:0px;position:relative; bottom:15px; padding-left:20px;padding-right:20px;padding-bottom:10px;padding-top:10px;'>
            <span  ng-if='x.dstatus==1'><i class=' material-icons'style='color:#fff;' ><span ng-attr-class='{{"k"+x.devices_id}}'>network_wifi</span></i><span class="updatedspan small">Updated:<span ng-attr-class='{{"f"+x.devices_id}}' data-livestamp="{{x.created_At}}"></span></span></span>
            <span ng-if='x.dstatus==0'><i class='material-icons' style='color:#fff;'><span ng-attr-class='{{"k"+x.devices_id}}'>signal_wifi_off</span></i><span class="updatedspan small">Updated:<span ng-attr-class='{{"f"+x.devices_id}}' data-livestamp="{{x.created_At}}"></span></span></span>
          </div>
            <div  ng-attr-class='{{"c"+x.devices_id}} row'ng-class='{offline2:x.dstatus==0,online2:x.dstatus==1}'style=' margin-top:-15px; margin-left:0px;margin-right:0px; padding-left:30px;padding-top:5px;'>
          <p class='dev_heading'>{{x.deviceId}}
            <br/>
            <span class='small ' style='color:#fff;'>{{x.name}}</span>
            </p>
          </div>  
    
                  <div style='text-align:center; padding-top:5px;'> 
                   <span class="head relative">Switch-Id: {{x.switchId}}</span>
                  </div>
                 <div class="disable "  >  
                    <div class="switch-wrap "  >
                        <input  ng-attr-id='{{"toggleLights"+x.devices_id+x.switchId}}' ng-click="send(x)" checked ng-if="x.action=='1' " type="checkbox" />
                        <input ng-attr-id='{{"toggleLights"+x.devices_id+x.switchId}}' ng-click="send(x)" ng-if="x.action=='0' " type="checkbox" />
              
                          <label for='{{"toggleLights"+x.devices_id+x.switchId}}' class="switch">
                              <div class="slide-wrap">
                                <div class="slide">
                                    <div class="slider"></div>
                                </div>
                              </div>
                          </label>
                    </div>       
                  </div>
              </div>    
            </div>
          </div>
        </div>    
			</div>
		</div>
  </div> 
<div  ng-include="'footer.php'"></div> 

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
<script src='./bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js'></script>

  <!-- Angular Material Library -->
    <script type='text/javascript' src="scripts/valvecontrol.js" ></script>
  <script type="text/javascript" src="./bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="./bower_components/livestampjs-develop/livestamp.js"></script>

    <script type="text/javascript">
              var websocket=null;
               
              window.onload=function()
              {
                websocket=new WebSocket("ws://10.129.139.139:8180");
                websocket.onopen=function()
                {
                console.log('Connection established');
                var devices=angular.element(document.querySelector('[ng-controller="DropdownCtrl"]')).scope().details;
                   // window.alert(msg);
                   
                }
                websocket.onerror = function(e) 
                {
                  document.getElementById('wserror').innerHTML="MQTT Server unavailable";
                  document.getElementById('wserror').addClass('label-danger');
                  console.log("Connection error");
                }
  
                websocket.onmessage=function(evt)
                {
                  var msg=JSON.parse(evt.data);
                  console.log(msg);
                  //alert(msg.deviceId);
                  if(msg.status==0)
                  {var devices=angular.element(document.querySelector('[ng-controller="DropdownCtrl"]')).scope().details;
                   // window.alert(msg);
                   for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){

                          var a='.b'+obj.devices_id;
                         var b='.c'+obj.devices_id;
                          var h='.k'+obj.devices_id;
         
                    $(a).removeClass('online1').addClass('offline1');
                    $(b).removeClass('online2').addClass('offline2');
                    $(h).text('signal_wifi_off');
                   
                    var d = new Date();
                   d.setMinutes(d.getMinutes()+30);
                  d.setHours(d.getHours()+5);
                  
                    n=d.toUTCString();
                    n=n.replace('GMT','');
                    var f='.f'+obj.devices_id;
                    n=   Math.floor(Date.now() / 1000);
                    $(f).attr('data-livestamp',n);    
                   
                        }
                  } 
                    }
                  else if(msg.status==1)
                  {var devices=angular.element(document.querySelector('[ng-controller="DropdownCtrl"]')).scope().details;
                   
                  for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){
                          var a='.b'+obj.devices_id;
                          var b='.c'+obj.devices_id;
                          var h='.k'+obj.devices_id;
                    $(a).removeClass('offline1').addClass('online1');
                    $(b).removeClass('offline2').addClass('online2');
                    $(h).text('network_wifi');
                    var d = new Date();
                  d.setMinutes(d.getMinutes()+30);
                  d.setHours(d.getHours()+5);
                  
                  n=d.toUTCString();
                  
                   n=n.replace('GMT',''); 
                    var f='.f'+obj.devices_id;
                     n=   Math.floor(Date.now() / 1000);
                    $(f).attr('data-livestamp',n);    
 
                        }
                    }   
                    
                  }
                  else if(msg.action=='1'){
                    var devices=angular.element(document.querySelector('[ng-controller="DropdownCtrl"]')).scope().details;
                   
                  for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){
                            var z='#toggleLights'+obj.devices_id+msg.switchId;
                            $(z).prop( "checked", true );
                           }
                    }
                  } 
                  else if (msg.action=='0'){
                    var devices=angular.element(document.querySelector('[ng-controller="DropdownCtrl"]')).scope().details;
                   
                  for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){
                            var z='#toggleLights'+obj.devices_id+msg.switchId;
                            $(z).prop( "checked", false );                    
                        }
                    }
                  }   
                    
                   // window.alert(msg);
                    
                    
                  }
                   
      setInterval(function () 
      {
                
        if (websocket.readyState != 1) 
        {
          console.log("Trying to connect");
                $('#wserror').addClass('label-danger'); 
           angular.element(document.querySelector('[ng-controller="DropdownCtrl"]')).scope().set0();
    
          document.getElementById('wserror').innerHTML="No connection to MQTT server,Trying to reconnect";
          
          websocket = new WebSocket("ws://10.129.139.139:8180");
        }
        if (websocket.readyState == 1) 
        {
    $('#wserror').removeClass('label-danger'); 
    angular.element(document.querySelector('[ng-controller="DropdownCtrl"]')).scope().set1();
          document.getElementById('wserror').innerHTML="";
          websocket.onmessage=function(evt)
                {
                  var msg=JSON.parse(evt.data);
                  console.log(msg);
                  //alert(msg.deviceId);
                  if(msg.status==0)
                  {var devices=angular.element(document.querySelector('[ng-controller="DropdownCtrl"]')).scope().details;
                   // window.alert(msg);
                   for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){

                          var a='.b'+obj.devices_id;
                         var b='.c'+obj.devices_id;
                          var h='.k'+obj.devices_id;
         
                    $(a).removeClass('online1').addClass('offline1');
                    $(b).removeClass('online2').addClass('offline2');
                    $(h).text('signal_wifi_off');
                   
                    var d = new Date();
                   d.setMinutes(d.getMinutes()+30);
                  d.setHours(d.getHours()+5);
                  
                    n=d.toUTCString();
                    n=n.replace('GMT','');
                    var f='.f'+obj.devices_id;
                    n=   Math.floor(Date.now() / 1000);
                    $(f).attr('data-livestamp',n);    
                   
                        }
                  } 
                    }
                  else if(msg.status==1)
                  {var devices=angular.element(document.querySelector('[ng-controller="DropdownCtrl"]')).scope().details;
                   
                  for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){
                          var a='.b'+obj.devices_id;
                          var b='.c'+obj.devices_id;
                          var h='.k'+obj.devices_id;
                    $(a).removeClass('offline1').addClass('online1');
                    $(b).removeClass('offline2').addClass('online2');
                    $(h).text('network_wifi');
                    var d = new Date();
                  d.setMinutes(d.getMinutes()+30);
                  d.setHours(d.getHours()+5);
                  
                  n=d.toUTCString();
                  
                   n=n.replace('GMT',''); 
                    var f='.f'+obj.devices_id;
                     n=   Math.floor(Date.now() / 1000);
                    $(f).attr('data-livestamp',n);    
 
                        }
                    }   
                    
                  }
                  else if(msg.action=='1'){
                    var devices=angular.element(document.querySelector('[ng-controller="DropdownCtrl"]')).scope().details;
                   
                  for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){
                            var z='#toggleLights'+obj.devices_id+msg.switchId;
                            $(z).prop( "checked", true );
                           }
                    }
                  } 
                  else if (msg.action=='0'){
                    var devices=angular.element(document.querySelector('[ng-controller="DropdownCtrl"]')).scope().details;
                   
                  for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){
                            var z='#toggleLights'+obj.devices_id+msg.switchId;
                            $(z).prop( "checked", false );                    
                        }
                    }
                  }   
                    
                   // window.alert(msg);
                    
                    
                  }
               
        }
      },1000);
          
                }
function send(x){
  var jsonS={
           "deviceId":x.deviceId,
           "switchId":x.switchId,
           "payload":parseInt(x.action)
           };
      websocket.send(JSON.stringify(jsonS));
      
} 
              
            
            </script>
  <script type="text/javascript" src="menu/dist/js/jquery.mmenu.all.min.js"></script>

  </body>
 <!-- <footer id="footer" ng-include="'footer.php'"></footer> -->
</html>
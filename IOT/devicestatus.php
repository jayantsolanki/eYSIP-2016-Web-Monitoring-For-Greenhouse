<!doctype html>
<html lang='en' ng-app='devicestatusapp' >
<head>
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
       <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
     <title>Device status-Greenhouse monitoring</title>
<link type="text/css" rel="stylesheet" href="menu/demo/css/demo.css" />
<link type="text/css" rel="stylesheet" href="menu/dist/css/jquery.mmenu.all.css" />

<!-- Bootstrap Core CSS -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Angular material css-->
<link rel="stylesheet" href="./bower_components/angular-material/angular-material.css">

<link rel="stylesheet" type='text/css' href="styles/devicestatus.css" >
<!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> -->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<script src='https://use.fontawesome.com/7b73576b8a.js'></script>
 
</head>
<body  ng-controller="devicestatuscontroller" style='position:relative;'>
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

	<div class='controller'  >
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
   
  		      	</section>
      	</div>
  </div>
</div>
<p style=' text-align:center;padding:5px 5px 5px 5px;'><span id="wserror" class='label'style="color:white;"></span></p>


<p style=' text-align:center;'>Group selected: <span ng-repeat='x in groups'><span ng-if='x.id==userGroup' class='label label-info'>{{p}}</span></span></p>
	<div class='container-fluid'>
  <div class='row '>
    
		<div ng-repeat='x in devices' class='col-md-4 col-xs-12 card' >
  		<div class="card__front small"  ng-attr-id='{{"a"+x.id }}'>
      	<div ng-class='{boxes1:x.typeId==1 && x.switches<=1,boxes2:x.typeId==2,boxes3:x.typeId==1 && x.switches>1}'>
          <div  ng-attr-class='{{"b"+x.id}} row' ng-class='{offline1:x.status==0,online1:x.status==1}'style=' margin-top:-10px; margin-left:-30px;margin-right:-30px;padding-left:10px;padding-top:10px;padding-bottom:10px;'>
            <span  ng-if='x.status==1'><i class=' material-icons'style='color:#fff;' ><span ng-attr-class='{{"k"+x.id}}'>network_wifi</span></i><span class="updatedspan">Updated:<span ><span ng-attr-class='{{"f"+x.id}}' data-livestamp="{{x.created_At}}"></span></span></span></span>
            <span ng-if='x.status==0'><i class='material-icons' style='color:#fff;'><span ng-attr-class='{{"k"+x.id}}'>signal_wifi_off</span></i><span class="updatedspan">Updated:<span ><span ng-attr-class='{{"f"+x.id}}' data-livestamp="{{x.created_At}}"></span></span></span></span>
          </div>
          <div  ng-attr-class='{{"c"+x.id}} row'ng-class='{offline2:x.status==0,online2:x.status==1}'style=' margin-top:0px; margin-left:-30px;margin-right:-30px; padding-left:30px;'>
          <p class='dev_heading'>{{x.deviceId}}
            <br/>
            <span class='small ' style='color:#fff;'>{{x.name}}</span>
            <span class='small label label-primary ' style='font-size:12px;'>{{x.typename}}</span>
            <span ng-if='x.typeId==2' class='label label-warning'style='font-size:12px;'>{{x.sentype}}</span>
          </p>
          </div>  

              <div class="row" style='padding-top:15px;'>
                <!-- <div class="col-md-3  col-md-offset-1 col-xs-12">
                  <p ng-if='x.typeId==1'><span class='details'>{{x.name}}</p> 
        			    
        			    <p ng-if='x.typeId==1'><span class='details'>Switches:</span> {{x.switches}}</p> 
            	  </div> -->
                <div class=" text-center col-md-12 col-xs-12">
                  <p ng-if='x.switches<=1'><span class='details updated_at' >Battery Level</span></p>
                  <span ng-if='x.switches<=1'><span class='details updated_at' >Primary:</span><span ng-attr-class='{{"d"+x.id}}'>{{x.prim}}</span> </span>
                  <span ng-if='x.switches<=1 && x.typeId==1'><span class='details updated_at' >Secondary:</span>{{x.sec}} </span  >
                  <span  ng-if='x.typeId==1' class='icons' ng-click="clicked(x.id)"><i class="material-icons"  style='color:black;'>flip_to_back</i></span>
                  <p ng-if='x.typeId==2 && x.sentype!="b"'><span class='details updated_at' >Moisture:</span><span ng-attr-class='{{"e"+x.id}}'>{{x.sec}}</span> </p>
                  <p class='updated_at small'style='color:#999;' ng-if='x.switches<=1'>Updated:<span > <span ng-attr-class='{{"g"+x.id}}' data-livestamp="{{x.updated_at}}"></span></span></p>         
                </div>          

              </div>
          
    	</div>	
  	</div>
  <div class='card__back' ng-attr-id='{{"b"+x.id }}' >
    <div ng-class='{boxes1:x.typeId==1 && x.switches<=1,boxes2:x.typeId==2,boxes3:x.typeId==1 && x.switches>1}' style='overflow-y:scroll; ' >
  <table >
    <tr>
      <th>Switch Id</th>
      <th>Group </th>
      <th>Status</th>
    </tr>
    <tr ng-repeat="y in switches" ng-if='x.deviceId==y.deviceId'>
      <td >{{ y.switchId }}.</td>
      <td><span ng-repeat ='z in groups'> <span ng-if='z.id==y.groupId'>{{z.name}}</span></span></td>
      <td><span ng-if="y.action==0" ng-attr-class='{{"z"+x.id+y.switchId }} label label-danger'>Closed</span>
  <span ng-if="y.action==1" ng-attr-class='{{"z"+x.id+y.switchId}} label label-success'>Open</span>
      </td>
    </tr>
  </table>
            <span  ng-if='x.typeId==1' ng-class='{icons1:x.switches<=1,icons2:x.switches>1}' ng-click="clicked2(x.id)"><i class="material-icons" style='color:black;'>flip_to_front</i></span>
        
     </div>
  </div>
</div>
</div>
</div>	
<div style='margin-top:100px;'ng-include="'footer.php'"></div> 

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
 <!-- Customs Scripts -->
<script type="text/javascript" src="./bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="./bower_components/livestampjs-develop/livestamp.js"></script>
<script type='text/javascript' src="scripts/devicestatus.js" ></script>
<script type='text/javascript'>
             var websocket=null;
             window.onload=function()
              {
                 websocket=new WebSocket("ws://10.129.139.139:8180");
                websocket.onopen=function()
                {
                console.log('Connection established');
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
                  {var devices=angular.element(document.querySelector('[ng-controller="devicestatuscontroller"]')).scope().devices;
                   // window.alert(msg);
                   for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){

                          var a='.b'+obj.id;
                         var b='.c'+obj.id;
                          var h='.k'+obj.id;
         
                    $(a).removeClass('online1').addClass('offline1');
                    $(b).removeClass('online2').addClass('offline2');
                    $(h).text('signal_wifi_off');
                   
                    var d = new Date();
                   d.setMinutes(d.getMinutes()+30);
                  d.setHours(d.getHours()+5);
                  
                    n=d.toUTCString();
                    n=n.replace('GMT','');
                    var f='.f'+obj.id;
                    n=   Math.floor(Date.now() / 1000);
                    $(f).attr('data-livestamp',n);    
                   
                        }
                  } 
                    }
                  else if(msg.status==1)
                  {var devices=angular.element(document.querySelector('[ng-controller="devicestatuscontroller"]')).scope().devices;
                   
                  for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){
                          var a='.b'+obj.id;
                          var b='.c'+obj.id;
                          var h='.k'+obj.id;
                    $(a).removeClass('offline1').addClass('online1');
                    $(b).removeClass('offline2').addClass('online2');
                    $(h).text('network_wifi');
                    var d = new Date();
                  d.setMinutes(d.getMinutes()+30);
                  d.setHours(d.getHours()+5);
                  
                  n=d.toUTCString();
                  
                   n=n.replace('GMT',''); 
                    var f='.f'+obj.id;
                                    n=   Math.floor(Date.now() / 1000);
                    $(f).attr('data-livestamp',n);    
    
                        }
                    }   
                    
                  }
                  else if(msg.action=='data'){
                    var devices=angular.element(document.querySelector('[ng-controller="devicestatuscontroller"]')).scope().devices;
                   
                  for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){
                          var d='.d'+obj.id;
                          var e='.e'+obj.id;
                          $(d).text(msg.batValue);
                          if(msg.deviceType!='b'){
                          $(e).text(msg.moistValue);
                             
                  
                        }
                            var f='.g'+obj.id;
                        
                            n=   Math.floor(Date.now() / 1000);
                        
                        $(f).attr('data-livestamp',n);    

                        }
                    }
                  }
                  else if(msg.action=='1'){
                    var devices=angular.element(document.querySelector('[ng-controller="devicestatuscontroller"]')).scope().devices;
                   
                  for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){
                            var z='.z'+obj.id+msg.switchId;
                            $(z).removeClass('label-danger').addClass('label-success').text('Open');                    
                        }
                    }
                  } 
                  else if (msg.action=='0'){
                    var devices=angular.element(document.querySelector('[ng-controller="devicestatuscontroller"]')).scope().devices;
                   
                  for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){
                            var z='.z'+obj.id+msg.switchId;
                            $(z).removeClass('label-success').addClass('label-danger').text('Closed');                    
                        }
                    }
                  }
                }
                  setInterval(function () 
      {
        if (websocket.readyState != 1) 
        {
          console.log("Trying to connect");
                $('#wserror').addClass('label-danger'); 
    
          document.getElementById('wserror').innerHTML="No connection to MQTT server,Trying to reconnect";
          
          websocket = new WebSocket("ws://10.129.139.139:8180");
        }
        if (websocket.readyState == 1) 
        {
    $('#wserror').removeClass('label-danger'); 
    
          document.getElementById('wserror').innerHTML=""
         
          websocket.onmessage=function(evt)
                {
                  var msg=JSON.parse(evt.data);
                  console.log(msg);
                  //alert(msg.deviceId);
                  if(msg.status==0)
                  {var devices=angular.element(document.querySelector('[ng-controller="devicestatuscontroller"]')).scope().devices;
                   // window.alert(msg);
                   for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){

                          var a='.b'+obj.id;
                         var b='.c'+obj.id;
                          var h='.k'+obj.id;
         
                    $(a).removeClass('online1').addClass('offline1');
                    $(b).removeClass('online2').addClass('offline2');
                    $(h).text('signal_wifi_off');
                   
                    var d = new Date();
                   d.setMinutes(d.getMinutes()+30);
                  d.setHours(d.getHours()+5);
                  
                    n=d.toUTCString();
                    n=n.replace('GMT','');
                    var f='.f'+obj.id;
                    n=   Math.floor(Date.now() / 1000);
                    $(f).attr('data-livestamp',n);    
                   
                        }
                  } 
                    }
                  else if(msg.status==1)
                  {var devices=angular.element(document.querySelector('[ng-controller="devicestatuscontroller"]')).scope().devices;
                   
                  for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){
                          var a='.b'+obj.id;
                          var b='.c'+obj.id;
                          var h='.k'+obj.id;
                    $(a).removeClass('offline1').addClass('online1');
                    $(b).removeClass('offline2').addClass('online2');
                    $(h).text('network_wifi');
                    var d = new Date();
                  d.setMinutes(d.getMinutes()+30);
                  d.setHours(d.getHours()+5);
                  
                  n=d.toUTCString();
                  
                   n=n.replace('GMT',''); 
                    var f='.f'+obj.id;
                                    n=   Math.floor(Date.now() / 1000);
                    $(f).attr('data-livestamp',n);    
    
                        }
                    }   
                    
                  }
                  else if(msg.action=='data'){
                    var devices=angular.element(document.querySelector('[ng-controller="devicestatuscontroller"]')).scope().devices;
                   
                  for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){
                          var d='.d'+obj.id;
                          var e='.e'+obj.id;
                          $(d).text(msg.batValue);
                          if(msg.deviceType!='b'){
                          $(e).text(msg.moistValue);
                             
                  
                        }
                            var f='.g'+obj.id;
                        
                            n=   Math.floor(Date.now() / 1000);
                        
                        $(f).attr('data-livestamp',n);    

                        }
                    }
                  }
                  else if(msg.action=='1'){
                    var devices=angular.element(document.querySelector('[ng-controller="devicestatuscontroller"]')).scope().devices;
                   
                  for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){
                            var z='.z'+obj.id+msg.switchId;
                            $(z).removeClass('label-danger').addClass('label-success').text('Open');                    
                        }
                    }
                  } 
                  else if (msg.action=='0'){
                    var devices=angular.element(document.querySelector('[ng-controller="devicestatuscontroller"]')).scope().devices;
                   
                  for(var i = 0; i < devices.length; i++) {
                       var obj = devices[i];

                        if(obj.deviceId==msg.deviceId){
                            var z='.z'+obj.id+msg.switchId;
                            $(z).removeClass('label-success').addClass('label-danger').text('Closed');                    
                        }
                    }
                  }
                }
        }
      },1000);
              }

</script>  
<script type="text/javascript" src="menu/dist/js/jquery.mmenu.all.min.js"></script>

</body>
</html>

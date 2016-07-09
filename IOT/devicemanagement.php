<!doctype html>
<html lang='en' ng-app='devicemanapp' >
<head>
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
       <link href='./bower_components/roboto-fontface/css/roboto/roboto-fontface.css' rel='stylesheet' type='text/css'>

    <title>Device management-Greenhouse monitoring</title>
<link type="text/css" rel="stylesheet" href="menu/demo/css/demo.css" />
<link type="text/css" rel="stylesheet" href="menu/dist/css/jquery.mmenu.all.css" />

<!-- Bootstrap Core CSS -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type='text/css' href="styles/deviceman.css" >
 <link href="./bower_components/material-design-icons/iconfont/material-icons.css"
      rel="stylesheet">
<link href="./bower_components/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">

</head>
<body  ng-controller='devicemancontroller' style='position:relative;'>
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
	if($user_type==1 ){

	?>
	<div >
	<div style='position:fixed;top:0px;left:0;width:100%; z-index:99;'><div ng-include="'menu/demo/advanced.php'"></div></div>
	 
    
  
		<h2 style='padding-left:20px; padding-top:50px;text-align:center;'>DEVICE MANAGEMENT</h2>
		<div class='container-fluid'>
			<tabs style='margin-left:0px;'>
    <pane title='Devices'>	
		<div class='row'> 
			<div dir-paginate="x in details|orderBy:sortKey:reverse|filter:search|itemsPerPage:9" class=' col-md-4 col-xs-12 card '>
				<div class="card__front" ng-attr-id='{{"a"+x.id +""+ x.switches}}' >
    				<div ng-class=" {'boxes':x.status==0,'boxes1':x.status==1}">
				<p class='dev_heading' ><span  > {{x.deviceId}}</span> <span ng-if='x.status==1' class='label label-primary ' style='font-size:14px; position:relative; bottom:5px;'>New Device</span></p>
				<p><span class='details'>Name:-</span> {{x.name}}</p>
				<p><span class='details'>Type:-</span> {{x.type}}</p>
				<p><span class='details'>Switch ID:-</span> {{x.switches}}</p>
				<p ng-class={relate:x.type=='valve'}><span class='details'>Group:-</span> {{x.group}} <i class="material-icons md-18" ng-if="x.type=='valve'"  style='position:relative; top:3px; ' ng-click='open(x,1)'>edit</i></p>

				
				<p style='text-align:center;'><button   class='moreinfo' ng-click='clicked(x.id,x.switches)'> More Info</button>
				</br><button  class='editinfo' ng-click='open(x,2)' >Edit info</button></p>
					</div>
				</div>
				<div class="card__back" ng-attr-id='{{"b"+x.id +""+ x.switches}}'>
					<div class='boxes'>
						<p ng-if='x.description'><span class='details'>Description:-</span>{{x.description}}</p>	
						<p ng-if='x.regionId'><span class='details'>Region ID:-</span>{{x.regionId}}</p>	
						<p ng-if='x.latitude'><span class='details'>Latitude:-</span>{{x.latitude}}</p>	
						<p ng-if='x.longitude'><span class='details'>Longitude:-</span>{{x.longitude}}</p>	
						<div class='row'>
						<div class='col-md-6 col-xs-6'><p><span ng-if='x.field1'><span class='details'>Field1:-</span>{{x.field1}}</span>	
						</p>	
						
						<p><span ng-if='x.field2'><span class='details'>Field2:-</span>{{x.field2}}</span>	
						</p>	
						
						<p><span ng-if='x.field3'><span class='details'>Field3:-</span>{{x.field3}}</span>	
						</p>	
						</div>
						<div class='col-md-6 col-xs-6'>
						<p><span ng-if='x.field4' ><span class='details'> Field4:-</span>{{x.field4}}</span></p>
					<p>	<span ng-if='x.field5' > <span class='details'> Field5:-</span>{{x.field5}}</span></p>
					</p>
					<p>	<span ng-if='x.field6' ><span class='details'> Field6:-</span>{{x.field6}}</span></p>
					</div>
					</div>
						<p ng-if='x.created_at'><span class='details'>Created :-</span><span ng-attr-class='{{"f"+x.id}}' data-livestamp="{{x.created_at}}"></span></p>	
						<p ng-if='x.updated_at'><span class='details'>Updated :-</span><span ng-attr-class='{{"f"+x.id}}' data-livestamp="{{x.updated_at}}"></span></p>	
						<p ng-if='x.elevation'><span class='details'>Elevation(mtrs):-</span>{{x.elevation}}</p>	
						<p style='text-align:center;'><button   class='moreinfo' ng-click='clicked2(x.id,x.switches)'> Go Back</button>
						</p>
					</div>
				</div>	
			</div>
		
		</div>
			</br>
	<div style=' position:absolute; bottom:-100px;  left: 50%; margin-left:-120px;'>
			 <dir-pagination-controls
       max-size="5"
       direction-links="true"
       boundary-links="true" >
    </dir-pagination-controls>
	</div>
	</pane>
	
    <pane title="Edit groups">

			<div class='editgroupname'>
				
				<div class="alert alert-info" >
  					Click on <i class="material-icons md-18 abc" style='position:relative; top:3px; cursor:initial;'>edit</i> to edit the group names.
				</div>
				<div ng-repeat='x in groups' >
				{{x.id}}.	{{x.name}} <i class="material-icons md-18"  style='position:relative; top:3px; '  ng-click='open(x,3)'>edit</i>
				</br></br>
				</div>
			 <button class='btn btn-primary' ng-click='open(x,5)'>Add new group</button>
			</div>
	</pane>
	<pane title='Edit Devices(types)'>		
			<div class='editdevicename'>
				
				<div class="alert alert-info" >
  					Click on <i class="material-icons md-18 abc" style='position:relative; top:3px; cursor:initial;'>edit</i> to edit the device type names.
				</div>
				<div ng-repeat='x in devicenames' >
				{{x.id}}.	{{x.name}} <i class="material-icons md-18"  style='position:relative; top:3px; '  ng-click='open(x,4)'>edit</i>
				</br></br>
				</div>
			<button class='btn btn-primary' ng-click='open(x,6)'>Add new device type</button>
			</div>
	
		</div>
	</pane>
	</tabs>
		<script type="text/ng-template" id="myModalContent.html" >
        <div class="modal-header " ng-class={aligning:option==2}>
            <h3 class="modal-title">{{device.deviceId}}</h3>
        </div>
        <div class="modal-body aligning" ng-if='option==2'>
            Name:</br>
            <input type='text' value='{{device.name}}' class='signup_fields' ng-model='x.name'></input></br>
            Description:</br>
            <textarea  value='{{device.description}}' ng-model='x.description'></textarea></br>
            Region ID:</br>
            <input type='text' value='{{device.regionId}}'class='signup_fields' ng-model='x.regionId'></input></br>
            Group (for device):</br>
            <select   ng-model='x.group1'>
            <option>{{device.group1}}</option>
            <option  ng-repeat='y in groups' ng-if='y.name!=device.group1' >{{y.name}}</option>
            </select></br>
            Latitude:</br>
            <input type='text' value='{{device.latitude}}'class='signup_fields' ng-model='x.latitude'></input></br>
            Longitude:</br>
            <input type='text' value='{{device.longitude}}'class='signup_fields' ng-model='x.longitude'></input></br>
            Elevation(mtrs):</br>
            <input type='text' value='{{device.elevation}}'class='signup_fields' ng-model='x.elevation'></input></br>
            
        </div>
        <div class='modal-body' ng-if='option==1'>
        <p>Change the group of the switch {{x.switches}}</p>
        		 <select   ng-model='x.group'>
            <option>{{device.group}}</option>
            <option  ng-repeat='y in groups' ng-if='y.name!=device.group' >{{y.name}}</option>
            </select>
        </div>
        <div class='modal-body' ng-if='option==3'>
        <p>Change the group name :</p>
        		 <input type='text' value='{{device.name}}' class='signup_fields' ng-model='x.name'></input>
        </div>
        <div class='modal-body' ng-if='option==4'>
        <p>Change the device type name :</p>
        		 <input type='text' value='{{device.name}}' class='signup_fields' ng-model='x.name'></input>
        </div>
        <div class='modal-body' ng-if='option==5'>
        <p>Add a new group:</p>
        		 <input type='text'  class='signup_fields' ng-model='y.name'></input>
        </div>
        <div class='modal-body' ng-if='option==6'>
        <p>Add a new device type:</p>
        		 <input type='text'  class='signup_fields' ng-model='y.name'></input>
        </div>
        
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok(device)">Save Changes</button>
            <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
        </div>
    </script>
	</div>		
<div style='position:absolute;bottom:-400px;left:0;width:100%;'ng-include="'footer.php'"></div>	
<div class='clearfix'></div>
<?php
	}
	else if($user_type==0){
header("Location:dashboard.php");

	
	}
	else if($user_type==2){
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
<!-- ui-bootstrap for modal -->
<script src='./bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js'></script>
<script src='./bower_components/angularUtils-pagination/dirPagination.js'></script>
<!-- Customs Scripts -->
<script type="text/javascript" src="./bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="./bower_components/livestampjs-develop/livestamp.js"></script>

<script type='text/javascript' src="scripts/deviceman.js" ></script>
<script type="text/javascript" src="menu/dist/js/jquery.mmenu.all.min.js"></script>
</body>
</html>
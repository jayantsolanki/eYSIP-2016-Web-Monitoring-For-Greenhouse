<!doctype html>
<html lang='en' ng-app='manageusersapp' >
<head>
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
       <link href='./bower_components/roboto-fontface/css/roboto/roboto-fontface.css' rel='stylesheet' type='text/css'>

    <title>Manage Users-Greenhouse monitoring</title>
<link type="text/css" rel="stylesheet" href="menu/demo/css/demo.css" />
<link type="text/css" rel="stylesheet" href="menu/dist/css/jquery.mmenu.all.css" />

<!-- Bootstrap Core CSS -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type='text/css' href="styles/manageusers.css" >
<link href="./bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="./bower_components/angular-datatables/dist/css/angular-datatables.min.css" rel="stylesheet" type="text/css">
<!-- <link href='./bower_components/bootstrap-table/dist/bootstrap-table.min.css'> -->
<link href="./bower_components/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
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

<div style='position:fixed;top:0;left:0;width:100%; z-index:99;'><div ng-include="'menu/demo/advanced.php'"></div></div>

  <div ng-controller='manageusercontroller'>
<div class="container" id='user_table' >
    <div class='table-responsive'>
  <h2>MANAGE USERS</h2>
      <table  datatable="ng" dt-options="dtOptions" dt-column-defs="dtColumnDefs" dt-instance="dtInstance"class="table table-bordered table-striped table-hover  nowrap">
       
        <thead>
            <th>Username</th>
            <th>Email-id</th>
            <th>Current role</th>
            <th>Change Role</th>
        </thead>
        <tbody>
         <tr ng-repeat='x in details' ng-init='q=x.user_type' >
            <td >{{x.username}}</td>
            <td>{{x.email_id}}</td>
            <td ><span ng-if="q==0" class='label label-warning'>Pending Approval</span>
<span ng-if="q==1" class='label label-success'>Admin</span>
  <span ng-if="q==2" class='label label-info'>Normal user</span>
    <span ng-if="q==3" class='label label-danger'>Deactivated</span>
            </td>
            <td>
            <div ng-if="x.user_type==0"class="form-group" >
      
              <select ng-attr-id='{{x.username}}'ng-model="myval" ng-options="option.value as option.name for option in options2" ng-init="myval = myval || options2[2].value" ng-change='update(x.username,myval)'  class="form-control changer">
                 
          
            </select> 
    
          </div>
          <div ng-if="x.user_type==1"class="form-group" >
      
          <select   ng-attr-id='{{x.username}}'  ng-options="option.value as option.name for option in options1" ng-init="myval = myval || options1[1].value" ng-model="myval" ng-change='update(x.username,myval)' class="form-control changer">
         </select> 
    
       </div>
          <div ng-if="x.user_type==2" class="form-group">
      
          <select   ng-attr-id='{{x.username}}'ng-options="option.value as option.name for option in options1" ng-model="myval" ng-init="myval = myval || options1[0].value"  ng-change='update(x.username,myval)'class="form-control changer">
          </select> 
    
       </div>
          <div ng-if="x.user_type==3"class="form-group" >
      
          <select  ng-attr-id='{{x.username}}' ng-model="myval"ng-options="option.value as option.name for option in options1" ng-init="myval = myval || options1[2].value" ng-change='update(x.username,myval)' class="form-control changer">
        </select> 
    
       </div>
          
          </td>
         </tr>
       </tbody>
        <tfoot>
            <tr>
                <th>Username</th>
                <th>Email-id</th>
                <th>Current role</th>
                <th>Change Role</th>
                
            </tr>
        </tfoot> 
       </table>
      </div>
</div>
 <button id="savebutton" class=" col-xs-offset-3 col-md-offset-10" ng-click="savechanges(details)">Save Changes</button>
  </div>
<!-- <div ng-controller='manageusercontroller' class='table-responsive' id='user_details'>
<table data-toggle="table"  data-striped='true'data-url='php/getuserdetails.php' data-pagination='true' data-smart-display='true' >
    <thead>
        <tr>
            <th data-sortable='true' data-field="username">Username</th>
            <th data-sortable='true' data-field="email_id">Email-id</th>
            <th data-sortable='true' data-formatter='roleFormatter' data-field="user_type">Current Roles</th>
       <th data-sortable='true' data-formatter='roleChanger'data-field="user_type2">Change role</th>
        </tr>

    </thead>
    
</table>
</div> -->
<div ng-include="'footer.php'"></div> 
<?php
  }
  else if($user_type==0){
header("Location:dashboard.php");

  
  }
  else if($user_type==3){
header("Location:dashboard.php");

  }
    else if($user_type==2){
header("Location:dashboard.php");

  }

}
else{
header("Location:index.php");

}
?>

<!-- jQuery -->
<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<!-- Datatable -->
 <script src="./bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<!-- AngularJs -->
<script src="./bower_components/angular/angular.min.js"></script>


<!-- Bootstrap Core JavaScript -->
<script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Angular Datatable -->
<script src='./bower_components/angular-datatables/dist/angular-datatables.min.js'></script>
<!-- Customs Scripts -->
<script type='text/javascript' src="scripts/manageusers.js" ></script>

<!-- <script src='./bower_components/datatables/media/js/dataTables.bootstrap.min.js'></script> -->

<!-- <script src='./bower_components/bootstrap-table/dist/bootstrap-table.min.js'></script> -->
<script type="text/javascript" src="menu/dist/js/jquery.mmenu.all.min.js"></script>

</body>
</html>
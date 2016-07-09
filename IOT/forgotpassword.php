<!doctype html>
<html lang='en' ng-app="forgotpasswordapp">
<head>
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password-Greenhouse monitoring</title>
       <link href='./bower_components/roboto-fontface/css/roboto/roboto-fontface.css' rel='stylesheet' type='text/css'>

<!-- Bootstrap Core CSS -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="styles/forgotpassword.css">
 
</head>
<body>
<?php   
if(!isset($_COOKIE['user_id'])){
?>
  
 <div ng-include="'menu2.html'"></div>   
 
<div class="container" ng-controller="formcontroller">
<div class="row">
<div class="col-md-offset-4 col-md-6 col-xs-12">
<p  id="forgot">Forgot Password</p>
<div id="spansignuperror">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span id="spansignuperrortext"></span>
</div>
<form name="signupform"   novalidate>

<!-- UserName Field -->
<div class="form-group" id="username_div" ng-class="{ 'has-error ': signupform.username.$error.required && !signupform.username.$pristine }" >
<label for="username" class=" input_headings control-label">Username</label></br>
<input type="text"  id="username" name="username" class="signup_fields" ng-model="signup.username" ng-class="{ 'signup_fields_error  ': signupform.username.$error.required && !signupform.username.$pristine }"required>

<p id='username_feed' class="help-block">Your UserName is required</p>
</div>


<!-- Email-Id Field-->
<div class="form-group" id="emailid_div" ng-class="{ 'has-error' : (signupform.emailid.$invalid || signupform.emailid.$error.required) && !signupform.emailid.$pristine }" >
<label  for="emailid" class="input_headings control-label">Email-id</label> </br>
<input type="email" id="emailid"class="signup_fields" name="emailid" ng-model="signup.emailid" ng-class="{ 'signup_fields_error  ': signupform.emailid.$error.required && !signupform.emailid.$pristine }" required>

<span ng-show="(signupform.emailid.$invalid || signupform.emailid.$error.required) && !signupform.emailid.$pristine"
      ng-class="{'emailfeed':(signupform.emailid.$invalid || signupform.emailid.$error.required) && !signupform.emailid.$pristine}" id="emailfeedback" class="help-block">Enter a valid email address.</span>
<p id='emailid_feed' class="help-block">Your Email-id is required</p>

</div>

<!-- Security Question -->


<div class="form-group" id="sq_div">
<label  for="sq" class="input_headings control-label">Security Question</label> </br>
<input type="text" id="sq" class="signup_fields" name="emailid" readonly>
</div>


<!-- Security Question Answer -->


 <div class="form-group"  id="sqans_div">
<br/>
<label  for="sqans" id="sqanslabel"class="input_headings control-label">Security Question's Answer</label> </br>
<input type="text" id="sqans" name="sqans" 
 class="signup_fields" ng-model="signup.sqans"  required>
</br>
<span id="sqans_feedback"></span>
<p id='sqans_feed' class="help-block">Please enter the answer</p>
</div>


<!-- New Password -->

<div class="form-group"  id="newpass_div">
<br/>
<label  for="newpass" id="newpasslabel" class="input_headings control-label">Enter New Password</label> </br>
<input type="password" id="newpass" name="newpass" class="signup_fields" ng-model="signup.newpass"  required>
</br>
<span id="newpass_feedback"></span>
<p id='newpass_feed' class="help-block">Please enter a password</p>
</div>

<div id="pswd_info">
    <h4>Password must meet the following requirements:</h4>
    <ul>
        <li id="letter" class="invalid">At least <strong>one letter</strong></li>
       <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
       <li id="number" class="invalid">At least <strong>one number</strong></li>
        <li id="length" class="invalid">At least <strong>8 characters</strong></li>
    </ul>
</div>




<!-- Confirm New Password-->

<div class="form-group"  id="cnewpass_div">
<br/>
<label  for="cnewpass" id="cnewpasslabel" class="input_headings control-label">Confirm New Password</label> </br>
<input type="password" id="cnewpass" name="newpass" class="signup_fields" ng-model="signup.cnewpass"  required>
</br>
<span id="cnewpass_feedback"></span>
<p id='cnewpass_feed' class="help-block">Password's don't match</p>
</div>

<button id="Submitbutton">Submit</button>

</form>
</div>
</div>
</div>

</div>
<div style='margin-top:90px;'ng-include="'footer.php'"></div>
<?php
}
else{
  header("Location:dashboard.php");

}
?>

<!-- jQuery -->
<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<!-- AngularJs -->
<script src="./bower_components/angular/angular.min.js"></script>
<!-- Bootstrap Core JavaScript -->

<script type="text/javascript" src="scripts/forgotpassword.js"></script>
</body>
</html>
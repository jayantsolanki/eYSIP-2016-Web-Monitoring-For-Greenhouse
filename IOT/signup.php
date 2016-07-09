<!doctype html>
<html lang='en' ng-app="Signupapp">
<head>
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link type="text/css" rel="stylesheet" href="menu/demo/css/demo.css" />
<link type="text/css" rel="stylesheet" href="menu/dist/css/jquery.mmenu.all.css" />

    <title>Create account-Greenhouse monitoring</title>
       <link href='./bower_components/roboto-fontface/css/roboto/roboto-fontface.css' rel='stylesheet' type='text/css'>

<!-- Bootstrap Core CSS -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<link type="text/css" rel="stylesheet" href="styles/signup.css">
 
</head>
<body>
<?php   
if(!isset($_COOKIE['user_id'])){
?>
<div ng-include="'menu2.html'"></div>   
<div class="container" ng-controller="formcontroller">
<div class="row">
<div class="col-md-offset-3 col-md-6 col-xs-12">
<p  id="register">Register</p>
<div  id="spansignuperror">
<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span id="spansignuperrorp"></span>
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
      ng-class="{'emailfeed':(signupform.emailid.$invalid || signupform.emailid.$error.required) && !signupform.emailid.$pristine}"                  id="emailfeedback"     class="help-block">Enter a valid email address.</span>
<p id='emailid_feed' class="help-block">Your Email-id is required</p>

</div>

<!-- Password-->
<div class="form-group" id="password_div"ng-class="{ 'has-error' : signupform.password.$error.required && !signupform.password.$pristine }" >
<label  for="password" class="input_headings control-label">Password</label> </br>

<input type="password" id="password" name="password" class="signup_fields" ng-class="{ 'signup_fields_error  ': signupform.password.$error.required && !signupform.password.$pristine }" ng-model="signup.password" required>
<span ng-show="signupform.password.$error.required && !signupform.password.$pristine" class="help-block ">Please enter a password.</span>
<p id='password_feed' class="help-block">Your Password is required</p>

<div id="pswd_info">
    <h4>Password must meet the following requirements:</h4>
    <ul>
        <li id="letter" class="invalid">At least <strong>one letter</strong></li>
       <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
       <li id="number" class="invalid">At least <strong>one number</strong></li>
        <li id="length" class="invalid">At least <strong>8 characters</strong></li>
    </ul>
</div>


</div>

<!-- Re-enter Password-->
<div class="form-group"id="repassword_div" >
<label  for="repassword" id="repasswordlabel"class="input_headings control-label">Re-enter password</label> </br>

<input type="password" id="repassword" name="repassword " 
 class="signup_fields" ng-model="signup.repassword"  required>
 </br>
 <span id="password_feedback"></span>
 <p id='repassword_feed' class="help-block">Please reenter the password</p>

</br>


</div>


<!-- Security Question -->


<div>
  <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Security Question
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a>Name of the Elementary School</a></li>
                <li><a>Favourite Subject</a></li>
                <li><a>Name of the person you first kissed</a></li>
                <li><a>Your Mother's pet name</a></li>
              </ul>
          </div>
<br>
  <span id="sq_feedback"></span>
 <p id='sq_feed' class="help-block">Please select a security question</p>

</div>


<!-- Security Question Answer -->

<div class="form-group" id="sqans_div" >
<label  for="sqans" id="sqanslabel"class="input_headings control-label">Security Question's Answer</label> </br>

<input type="text" id="sqans" name="sqans" 
 class="signup_fields" ng-model="signup.sqans"  required>
 </br>
 <span id="sqans_feedback"></span>
 <p id='sqans_feed' class="help-block">Please enter the answer</p>
 </div>








<!-- Sign Up Button-->
 
<button   id="signupbutton"  >Create an account</button>
</form>
</div>
</div>
</div>

</div>
<div style='margin-top:30px;'ng-include="'footer.php'"></div>
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
<script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript" src="scripts/signup.js"></script>
</body>
</html>

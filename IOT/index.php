<!doctype html>
<html lang='en' ng-app="loginapp">
	<head>
		<meta charset='utf-8'>
   		<meta http-equiv="X-UA-Compatible" content="IE=edge">
   		<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Login-Greenhouse monitoring</title>
       <link href='./bower_components/roboto-fontface/css/roboto/roboto-fontface.css' rel='stylesheet' type='text/css'>

	<!-- Bootstrap Core CSS -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
   		<link type="text/css" rel="stylesheet" href="styles/login.css">
    </head>
	<body>
<?php		
if(!isset($_COOKIE['user_id'])){
?>	<div ng-include="'menu2.html'"></div>   

	<div class="container" ng-controller="formcontroller">
		<div class="row">
			<div class="col-md-offset-3 col-md-7 col-xs-12">

				<p  id="login">Login</p>
				<div id="loginerror">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<span id="loginerrorspan"></span>
				</div>

				<!-- Login Form Begins -->

				<form name="loginform"  method="post" novalidate>


					<!-- UserName/Email Field -->

					<div class="form-group" id="username_div" ng-class="{ 'has-error ': loginform.username.$error.required && !loginform.username.$pristine }" >
						<label for="username" class=" input_headings control-label">Username or Email-id</label></br>
						<input type="text"  id="username" name="username" class="login_fields" ng-model="login.username" ng-class="{ 'login_fields_error  ': loginform.username.$error.required && !loginform.username.$pristine }" required></br>
						<p id="username_feed" class="login_fields1 has-error">Username/Emailid required</p>
					</div>

					<!-- Password Field -->

					<div class="form-group" id="password_div" ng-class="{ 'has-error' : loginform.password.$error.required && !loginform.password.$pristine }" >
						<label  for="password" class="input_headings control-label">Password</label> </br>
						<input type="password" id="password" name="password" class="login_fields" ng-model="login.password" ng-class="{ 'login_fields_error  ': loginform.password.$error.required && !loginform.password.$pristine }" required></br>
						<p id="password_feed" class="login_fields1 has-error">Please enter a password.</p>
					</div>

					<!-- Forget Password Link -->

					<div>
						<a id="forgetpassword" href="forgotpassword.php">Forgot Password?</a>
					</div>


 					<!-- Login Button-->
 					
 					<button  id="loginbutton"  name="Login">Login</button>
 					<button type="submit" id="signupbutton" onclick="location.href = 'signup.php';">Create an account</button>  
 				</form>

 				<!-- Login Form Ends -->
			</div>
		</div>
	</div>
<div style='margin-top:150px;'ng-include="'footer.php'"></div>
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


	<script type="text/javascript" src="scripts/login.js"></script>

	

	

	</body>
</html>


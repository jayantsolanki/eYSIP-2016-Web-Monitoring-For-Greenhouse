



<!doctype html>
<html lang='en' ng-app="loginapp">
	<head>
		<meta charset='utf-8'>
   		<meta http-equiv="X-UA-Compatible" content="IE=edge">
   		<meta name="viewport" content="width=device-width, initial-scale=1">
   		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    	<title>Login-Greenhouse monitoring</title>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script>
   		<link type="text/css" rel="stylesheet" href="styles/login.css">
    </head>
	<body>
	<div class="container" ng-controller="formcontroller">
		<div class="row">
			<div class="col-md-offset-3 col-md-6 col-xs-12">

				<p  id="login">Login</p>
				<p id="loginerror">Hello</p>
				

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

					<div><a id="forgetpassword" href="">Forgot Password?</a></div>


 					<!-- Login Button-->
 					
 					<button  id="loginbutton"  name="Login">Login</button>
 					<button type="submit" id="signupbutton">Create an account</button>  
 				</form>

 				<!-- Login Form Ends -->
			</div>
		</div>
	</div>
	<script type="text/javascript" src="scripts/login.js"></script>

	

	<!--<div id='footer'>
	<p id="footername">kYantra</p>
	<p>
        kYantra &copy; IIT Bombay 2016. All Rights Reserved<br>
        Created with <span class="glyphicon glyphicon-heart"></span> in India</p> 


	</div> -->

	</body>
</html>


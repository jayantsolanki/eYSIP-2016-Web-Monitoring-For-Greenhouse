<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="www.frebsite.nl" />
		<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />

		
		<link type="text/css" rel="stylesheet" href="css/demo.css" />
		<link type="text/css" rel="stylesheet" href="../dist/css/jquery.mmenu.all.css" />
		<style>
	</style>

		</style>
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.2.0.js"></script>
		<script type="text/javascript" src="../dist/js/jquery.mmenu.all.min.js"></script>
		<link href='./bower_components/components-font-awesome/css/font-awesome.min.css'>

		<script type="text/javascript">
			$(function() {
				$('nav#menu').mmenu({
					extensions	: [ 'effect-slide-menu', 'pageshadow' ],
					navbar 		: {
						title		: 'Greenhouse-IOT' 
					},
					navbars		: [
						 {
							position	: 'top',
							content		: [
								'prev',
								'title',
								'close'
							]
						}
					]
				});
			});
			
		</script>
	</head>
	<body>
		<div id="page">
			<div class="header">
				<a id='three' href="#menu"></a>
				Greenhouse-IOT
			</div>
<?php			
	$id=$_COOKIE['user_id'];	
	require_once('../../php/config.php');
	$dbc=mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname) ;
	$query="SELECT * FROM users WHERE user_id='$id'";
	$result=mysqli_query($dbc,$query) ;
	$row=mysqli_fetch_array($result);
	$user_type=$row['user_type'];
	$username=$row['username'];
?>

			<nav id="menu">
				<ul>
						<li style='margin-left:-20px;margin-right:-40px; padding-left:20px; border:none;'><a style='text-decoration:none;'><img src='./images/user.png' width='50'height='50'><span style='font-size:20px;'> <?php echo $username;?></span></a></li>
				
					<?php
					if($user_type==1 || $user_type==2){
					?>
					<li ><a href="./dashboard.php"><img width="240" height="150" style='padding:20px;' class='logo' src='./images/kyantralogo.jpg'></a></li>
					<li><a href="./dashboard.php" ><i class="glyphicon glyphicon-dashboard"></i><span style='margin-left:5px;'>Dashboard</span></a></li>
					<li><a href="./devicemanagement.php"><i class="glyphicon glyphicon-wrench"></i><span style='margin-left:5px;'>Device Management</span></a></li>
					<li><a  href="./devicestatus.php"><i class="glyphicon glyphicon-phone"></i><span style='margin-left:5px;'>Device Status</span></a></li>
					<li><a  href="./valvecontrol.php"><i class="glyphicon glyphicon-tint"></i><span style='margin-left:5px;'>Valve Control</span></a></li>
					<li><a  href="./displaycharts.php"><i class="fa fa-line-chart" style='font-size:12px;'></i><span style='margin-left:5px;'>Data Visualization</span></a></li>
					<li><a  href="./taskscheduling.php"><i class="glyphicon glyphicon-tasks"></i><span style='margin-left:5px;'>Scheduling
					</span></a></li>
					<?php
					if($user_type==1){
					?>
					
					<li><a  href="./manageusers.php"><i class="glyphicon glyphicon-user"></i></i><span style='margin-left:5px;'>Manage Users
					</span></a></li>
					<?php
					}
					}
					?>
					<li><a href="./php/logout.php"><i class="glyphicon glyphicon-log-out"></i><span style='margin-left:5px;'>Logout
					</span></a></li>

				</ul>
			</nav>
		
	</body>
</html>
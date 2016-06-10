var app=angular.module('loginapp',[]);

app.controller('formcontroller',function($scope){

 $scope.login = { username:"",password:""};

 });
$(document).ready(function()
{

	$('#loginerror').hide();
	$('#username').keyup(function()
{
		if($('#username_div').hasClass('has-error'))
		{
			$('#username').removeClass('login_fields_error');
			$('#username_feed').hide();
			$('#username_div').removeClass('has-error');
		}
});

	$('#password').keyup(function()
	{

		if($('#password_div').hasClass('has-error'))
		{
			$('#password').removeClass('login_fields_error');
			$('#password_feed').hide();
			$('#password_div').removeClass('has-error');
		}
});


	$('#loginbutton').click(function()
	{
			
		$(this).css('outline','none');
		var username=$('#username').val();
		var password=$('#password').val();
		if(username!='' && password!='')
		{
			$.post('loginscript.php',{username:username,password:password},function (data)
			{
	      		alert(data);
	      		var newdata=data.trim();
	      		alert(newdata);
	      		if(newdata=='1')
	      		{
	      			$('#loginerror').show();
	      			$('#loginerrorspan').text("Username/password incorrect");
				}
				else if(newdata=='2')
				{
					$('#loginerror').hide();
					alert("Successfully Logged in!");
				}
			});
		}
		if(password=='')
		{

		    $('#password_div').addClass('has-error');

			$('#password_feed').show();
			$('#password').addClass('login_fields_error');
		}
		if(username=='')
		{
			$('#username_div').addClass('has-error');

			$('#username_feed').show();
			$('#username').addClass('login_fields_error');
		}
		
			
});
});


var app=angular.module('forgotpasswordapp',[]);
app.controller('formcontroller',function($scope)
{
	$scope.signup = { username:"", emailid:"",sqans:"",newpass:"",cnewpass:"",invalid:false };
});


$(document).ready(function()
{

	$('#sq_div').hide();
	$('#sqans_div').hide();
	$('#newpass_div').hide();
	$('#cnewpass_div').hide();
	$('#pswd_info').hide();
  $('#spansignuperror').hide();

	$('#username').keyup(function()
	{
		if($('#username_div').hasClass('has-error'))
		{
			$('#username').removeClass('signup_fields_error');
			$('#username_feed').hide();
			$('#username_div').removeClass('has-error');
 		}
  	});

	$('#emailid').keyup(function()
	{
		if($('#emailid_div').hasClass('has-error'))
		{
			$('#emailid').removeClass('signup_fields_error');
			$('#emailid_feed').hide();
			$('#emailid_div').removeClass('has-error');
 		}
  	});

  	$('#sqans').keyup(function()
	{
		if($('#sqans_div').hasClass('has-error'))
		{
			$('#sqans').removeClass('signup_fields_error');
			$('#sqans_feed').hide();
			$('#sqans_div').removeClass('has-error');
 		}
  	});

  	$('#newpass').keyup(function()
  	{
    	var pswd = $(this).val();
    	if ( pswd.length < 8 )
    	{
      		$('#length').removeClass('valid').addClass('invalid');
    	} 
    	else 
    	{
      		$('#length').removeClass('invalid').addClass('valid');
    	}

    	if ( pswd.match(/[A-z]/) ) 
    	{
      		$('#letter').removeClass('invalid').addClass('valid');
    	}
    	else 
    	{
      		$('#letter').removeClass('valid').addClass('invalid');
    	}

		//validate capital letter
    			
    	if ( pswd.match(/[A-Z]/) ) 
    	{
      		$('#capital').removeClass('invalid').addClass('valid');
    	} 
    	else 
    	{
      		$('#capital').removeClass('valid').addClass('invalid');
    	}

		//validate number
    
    	if ( pswd.match(/\d/) ) 
    	{
      		$('#number').removeClass('invalid').addClass('valid');
    	} 
    	else 
    	{
      		$('#number').removeClass('valid').addClass('invalid');
    	}
  	}).focus(function() 
  	{
    	$('#pswd_info').show();
  	}).blur(function() 
  	{
    	var len=$('#length').hasClass('valid');
    	var  let=$('#letter').hasClass('valid');
    	var cap=$('#capital').hasClass('valid');
    	var number=$('#number').hasClass('valid');
    	if(len==true && let==true && cap==true && number==true)
    	{
      		$('#pswd_info').hide();
    	}
  	});
			
	var check=false;
  	if(check==true)
  	{
    	$('#cnewpass_feedback').text('Passwords don\'t match');
  	}

	$('#cnewpass').blur(function()
  	{
    	var pass=$('#newpass').val();
    	var repass=$('#cnewpass').val();
    	if(pass!=repass)
    	{
      		$('#newpass_feedback').text('Passwords don\'t match');
     	 	check=true;
      		$('#newpass_feedback').addClass('repasswordcolor');
      		$('#cnewpasslabel').addClass('repasswordcolor');
      		$('#cnewpass').addClass('signup_fields_error');
    	}
    	else
    	{
      		$('#newpass_feedback').text('');
      		$('#newpass_feedback').removeClass('repasswordcolor');
      		$('#cnewpasslabel').removeClass('repasswordcolor');
      		$('#cnewpass').removeClass('signup_fields_error');
      		check=false;
    	}
  	});

  	

    var choice=1;

  	$('#Submitbutton').click(function()
  	{
  		var len=$('#length').hasClass('valid');
    	var let=$('#letter').hasClass('valid');
    	var cap=$('#capital').hasClass('valid');
    	var number=$('#number').hasClass('valid');
  		$(this).css('outline','none');
  		var username=jQuery.trim($('#username').val());
  		var emailid=jQuery.trim($('#emailid').val());
  		var sqans=jQuery.trim($('#sqans').val());	
  		var newpass=jQuery.trim($('#newpass').val());
  		var cnewpass=jQuery.trim($('#cnewpass').val());
  		if(username == '')
  		{
        	$('#username_div').addClass('has-error');
        	$('#username_feed').show();
        	$('#username').addClass('signup_fields_error');      
  		}
  		if(emailid=='')
  		{
        	$('#emailid_div').addClass('has-error');
        	$('#emailid_feed').show();      
        	$('#emailid').addClass('signup_fields_error');      
    	}

    	if((username!='') && (emailid!='') )
		{
			
			
			$.post('php/forgotpasswordenter.php',{username:username,sqans:sqans,emailid:emailid,newpass:newpass,cnewpass:cnewpass,choice:choice,let:let,len:len,cap:cap,number:number},function(data)
        	{
        		
        		if(choice==1)
				    {
         			if(data==2)
         			{
          				$('#spansignuperror').show();
                  $('#spansignuperrortext').text("Username/Email-id incorrect");
          		}
          			else
          			{		
          				choice=2;
                  $('#spansignuperror').hide();
          				$('#sq_div').show();
          				$('#sq').val(data);
          				data='';
          				$('#sqans_div').show();
          				$('#username').prop('readonly','true');
          				$('#emailid').prop('readonly','true');
          			}
          		}
          		else if(choice==2)
          		{
          			
                if(data==1)
          			{
          				choice=3;
                  $('#spansignuperror').hide();
          				$('#newpass_div').show();
					       	$('#cnewpass_div').show();
						      $('#sqans').prop('readonly','true');
						      data='';
					      }
          			else
          			{
                  $('#spansignuperror').show();
          				$('#spansignuperrortext').text('Security Answer is Wrong');
          			}
          		}
          		else if(choice==3)
				{
					if(len && let && cap && number)
					{
						if(data==1)
          				{
                      $('#spansignuperror').show();
                      $('#spansignuperrortext').text("Password Updated Successfully");
                      $('#spansignuperror').css('background-color','green');

          				    setTimeout(function () 
                      {
                        window.location.href = "index.php"; //will redirect to your blog page (an ex: blog.html)
                      }, 2000);	
						      }
          				else
          				{
          				}
          			}
          			else
          			{
          			}


          		}

          		else
          		{
          		}
			});
		    
  			if(sqans=='' && choice==2)
			{
        		$('#sqans_div').addClass('has-error');
        		$('#sqans_feed').show();      
        		$('#sqans').addClass('signup_fields_error');      
    		}
    		
  		}
		else
		{
		}
	});
});


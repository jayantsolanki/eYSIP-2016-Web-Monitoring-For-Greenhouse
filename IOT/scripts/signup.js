
var app=angular.module('Signupapp',[]);

app.controller('formcontroller',function($scope){

 $scope.signup = { username:"", emailid:"",
                               password:"", repassword:"",sqans:"",invalid:false };
       
 
});


$(document).ready(function()
{
  var sqoption=0;
  $(".dropdown-menu").on('click', 'li a', function()
  {
    $(".btn:first-child").text($(this).text());
    $(".btn:first-child").val($(this).text());
  });

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

  $('#password').keyup(function()
  {
    if($('#password_div').hasClass('has-error'))
    {
      $('#password').removeClass('signup_fields_error');
      $('#password_feed').hide();
      $('#password_div').removeClass('has-error');
    }
  });

  $('#repassword').keyup(function()
  {
    if($('#repassword_div').hasClass('has-error'))
    {
      $('#repassword').removeClass('signup_fields_error');
      $('#repassword_feed').hide();
      $('#repassword_div').removeClass('has-error');
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

      
  $('#repassword').bind("cut copy paste",function(e) 
  {
    e.preventDefault();
  });
      
  $('#password').bind("cut copy paste",function(e) 
  {
    e.preventDefault();
  });

  var check=false;
  if(check==true)
  {
    $('#password_feedback').text('Passwords don\'t match');
  }
 
  $('#repassword').blur(function(){
    var pass=$('#password').val();
    var repass=$('#repassword').val();
    
if(pass!=repass){
$('#password_feedback').text('Passwords don\'t match');
check=true;
$('#password_feedback').addClass('repasswordcolor');
$('#repasswordlabel').addClass('repasswordcolor');
$('#repassword').addClass('signup_fields_error');
}
else{
$('#password_feedback').text('');
$('#password_feedback').removeClass('repasswordcolor');
$('#repasswordlabel').removeClass('repasswordcolor');
$('#repassword').removeClass('signup_fields_error');
check=false;
}

 });

$('#password').keyup(function(){
   var pswd = $(this).val();

   if ( pswd.length < 8 ) {
    $('#length').removeClass('valid').addClass('invalid');
} else {
    $('#length').removeClass('invalid').addClass('valid');
}
if ( pswd.match(/[A-z]/) ) {
    $('#letter').removeClass('invalid').addClass('valid');
} else {
    $('#letter').removeClass('valid').addClass('invalid');
}

//validate capital letter
if ( pswd.match(/[A-Z]/) ) {
    $('#capital').removeClass('invalid').addClass('valid');
} else {
    $('#capital').removeClass('valid').addClass('invalid');
}

//validate number
if ( pswd.match(/\d/) ) {
    $('#number').removeClass('invalid').addClass('valid');
} else {
    $('#number').removeClass('valid').addClass('invalid');
}
}).focus(function() {
    $('#pswd_info').show();
}).blur(function() {
    var len=$('#length').hasClass('valid');
    var  let=$('#letter').hasClass('valid');
    var cap=$('#capital').hasClass('valid');
    var number=$('#number').hasClass('valid');
    if(len==true && let==true && cap==true && number==true){
    $('#pswd_info').hide();
}
});


//Gets called when user clicks on create account button
$('#signupbutton').click(function()
{

$(this).css('outline','none');

var buttonvalue=$('.btn').val();

if(buttonvalue=='')
{
  sqoption=0;
  $('#sq_feed').show();
  $('#sq_feed').css('color','#a94442');
}

if(buttonvalue=='Name of the Elementary School')
{
  sqoption=1;
}

if(buttonvalue=='Favourite Subject')
{
  sqoption=2;
}

if(buttonvalue=='Name of the person you first kissed')
{
  sqoption=3;
}

if(buttonvalue=="Your Mother's pet name")
{
  sqoption=4;
}
var username=jQuery.trim($('#username').val());
var emailid=jQuery.trim($('#emailid').val());
var password=jQuery.trim($('#password').val());
var repassword=jQuery.trim($('#repassword').val());
var sqans=($('#sqans').val());
if(password!=repassword){
	$('#password_feedback').text('Passwords don\'t match');
check=true;
$('#password_feedback').addClass('repasswordcolor');
$('#repasswordlabel').addClass('repasswordcolor');
$('#repassword').addClass('signup_fields_error');

}
      if(username == ''){
        
        $('#username_div').addClass('has-error');
        $('#username_feed').show();
        $('#username').addClass('signup_fields_error');      
      }
      if(emailid==''){
         $('#emailid_div').addClass('has-error');
        $('#emailid_feed').show();      
       $('#emailid').addClass('signup_fields_error');      
      
      }
       if(password==''){
         $('#password_div').addClass('has-error');
        $('#password_feed').show();      
       $('#password').addClass('signup_fields_error');      
      
      }
      if(repassword==''){
         $('#repassword_div').addClass('has-error');
        $('#repassword_feed').show();      
       $('#repassword').addClass('signup_fields_error');      
      
      }

      if(sqans==''){
         $('#sqans_div').addClass('has-error');
        $('#sqans_feed').show();      
       $('#sqans').addClass('signup_fields_error');      
      
      }
      
 var len=$('#length').hasClass('valid');
    var  let=$('#letter').hasClass('valid');
    var cap=$('#capital').hasClass('valid');
    var number=$('#number').hasClass('valid');
    var emailfeedback=$('#emailfeedback').hasClass('emailfeed');
    if(len && let && cap && number){

    

      if(username!='' && emailid!='' && password!='' && repassword!='' && !emailfeedback && password==repassword  && buttonvalue!='' && sqans!=''){
        
        $.post('php/signupenter.php',{username:username,emailid:emailid,password:password,sqoption:sqoption,sqans:sqans},function(data){
         if(data==1){
          $('#spansignuperror').show();
          $('#spansignuperrorp').text('Username already exists..try another one');

         }
         else if(data==2){
          $('#spansignuperror').show();
         $('#spansignuperrorp').text('Email-id is already registered');


         }
         else{
          $('#spansignuperror').show();
          $('#spansignuperror').css('background-color','#388E3C');
          $('#spansignuperrorp').text('Successfully created an account');
          setTimeout(function () 
          {
          window.location.href = "dashboard.php"; //will redirect to your blog page (an ex: blog.html)
          }, 2000); 


         } 
         
        });
      }
    }   

});
}); 


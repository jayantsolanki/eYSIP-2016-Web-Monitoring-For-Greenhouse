
var app=angular.module('Signupapp',[]);

app.controller('formcontroller',function($scope){

 $scope.signup = { username:"", emailid:"",
                               password:"", repassword:"",invalid:false };
       
 
});
$(document).ready(function(){
  $('#username').keyup(function(){

if($('#username_div').hasClass('has-error')){

$('#username').removeClass('signup_fields_error');
$('#username_feed').hide();
$('#username_div').removeClass('has-error');
 }
  });
  $('#emailid').keyup(function(){

if($('#emailid_div').hasClass('has-error')){

$('#emailid').removeClass('signup_fields_error');
$('#emailid_feed').hide();
$('#emailid_div').removeClass('has-error');
 }
  });
$('#password').keyup(function(){

if($('#password_div').hasClass('has-error')){

$('#password').removeClass('signup_fields_error');
$('#password_feed').hide();
$('#password_div').removeClass('has-error');
 }

  });

$('#repassword').keyup(function(){

if($('#repassword_div').hasClass('has-error')){

$('#repassword').removeClass('signup_fields_error');
$('#repassword_feed').hide();
$('#repassword_div').removeClass('has-error');
 }
  });
      
      $('#repassword').bind("cut copy paste",function(e) {
          e.preventDefault();
      });
      $('#password').bind("cut copy paste",function(e) {
          e.preventDefault();
      });
var check=false;
if(check==true){
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
$('#signupbutton').click(function(){

var username=jQuery.trim($('#username').val());
var emailid=jQuery.trim($('#emailid').val());
var password=jQuery.trim($('#password').val());
var repassword=jQuery.trim($('#repassword').val());
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
      
 var len=$('#length').hasClass('valid');
    var  let=$('#letter').hasClass('valid');
    var cap=$('#capital').hasClass('valid');
    var number=$('#number').hasClass('valid');
    var emailfeedback=$('#emailfeedback').hasClass('emailfeed');
    if(len && let && cap && number){

    

      if(username!='' && emailid!='' && password!='' && repassword!='' && !emailfeedback && password==repassword){
        
        $.post('php/signupenter.php',{username:username,emailid:emailid,password:password},function(data){
         if(data=='1'){
          $('#spansignuperror').show().text('Username already exists..try another one');

         }
         else if(data=='2'){
          $('#spansignuperror').show().text('Email-id is already registered');

         }
         else{
          $('#spansignuperror').show().text('You have succcessfully created an account');


         } 
         
        });
      }
    }   

});
}); 

/*var websocket=new WebSocket("ws://10.129.139.139:8180");

websocket.onopen=function(){
    console.log('Connection established');
}
websocket.onmessage=function(evt){
    var msg=evt.data;
    console.log(msg);
}
websocket.onclose=function(){

}
*/
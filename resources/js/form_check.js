$('document').ready(function(){
	
	let username_state = false;
	let email_state = false;
	let password_state = false;
	let confirm_password_state = false;
/*	
	let username = $('#username').val();
	let email = $('#email').val();
	let password = $('#password').val();
	let confirm_password = $('#confirm_password').val();
*/
 $('#username').on('blur', function(){
	let illegalChars = /\W/; // allow letters, numbers, and underscores
	let username = $('#username').val();
	
	if(username == ''){
	
		return;
	}
  $.ajax({
    url: '/spexproject/includes/form_signup_preprocess.php',
    type: 'post',
    data: {
    	'username_check' : 1,
    	'username' : username,
    },
    success: function(response){
      if (response == 'taken' ) {
      	username_state = false;
      	$('#username').parent().removeClass();
      	$('#username').parent().addClass("form_error");
      	$('#username').siblings("span").text('Sorry... Username already exists');
      }else if(response == 'not_taken') {
      	username_state = true;
      	$('#username').parent().removeClass();
      	$('#username').parent().addClass("form_success");
      	$('#username').siblings("span").text('Username OK');
      }
	  //---Further username validation---
		if(username.match(illegalChars)){
			username_state = false;
			$('#username').parent().removeClass();
			$('#username').parent().addClass("form_error");
			$('#username').siblings("span").text('Sorry...Only letters, number and underscore allowed');
		}
    }
  });
 });		
  $('#email').on('blur', function(){
 	let email = $('#email').val();
	let emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ; //Check if it's valid mail address
	let illegalChars = /[\(\)\<\>\,\;\:\\\"\[\]]/ ; // Check for illegal characters
 	if (email == '') {
 		email_state = false;
 		return;
 	}
 	$.ajax({
      url: '/spexproject/includes/form_signup_preprocess.php',
      type: 'post',
      data: {
      	'email_check' : 1,
      	'email' : email,
      },
      success: function(response){
      	if (response == 'taken' ) {
          email_state = false;
          $('#email').parent().removeClass();
          $('#email').parent().addClass("form_error");
          $('#email').siblings("span").text('Sorry... Email address already exists');
      	}else if (response == 'not_taken') {
      	  email_state = true;
      	  $('#email').parent().removeClass();
      	  $('#email').parent().addClass("form_success");
      	  $('#email').siblings("span").text('Email OK');
      	}
		//Further email validation
		if(!emailFilter.test(email)){
			email_state = false;
			$('#email').parent().removeClass();
			$('#email').parent().addClass("form_error");
			$('#email').siblings("span").text('Please! Enter valid email address');
		}else if(email.match(illegalChars)){
			email_state = false;
			$('#email').parent().removeClass();
			$('#email').parent().addClass("form_error");
			$('#email').siblings("span").text('Sorry... Email address contain illegal characters');
		}
      }
 	});	
 }); 
 
 //----- Validate password
 $('#password').on('change', function(){

 	let password = $('#password').val();
	let illegalChars = /[\W_]/;  // allow only letters and numbers 
 	if (password.length<8) {
		password_state = false;
		$('#password').parent().removeClass();
		$('#password').parent().addClass("form_error");
		$('#password').siblings("span").text('Sorry... password too short');
	}else if(illegalChars.test(password)){
		password_state = false;
		$('#password').parent().removeClass();
		$('#password').parent().addClass("form_error");
		$('#password').siblings("span").text('Sorry... Only letters and numbers allowed');
	}else{
		password_state = true;
		$('#password').parent().removeClass();
		$('#password').parent().addClass("form_success");
		$('#password').siblings("span").text('OK');
 	}
 });
 //--------
 
 //----- Validate comfirm_password
 $('#confirm_password').on('change', function(){

 	let confirm_password = $('#confirm_password').val();
	let password = $('#password').val();
	 
 	if (confirm_password.length<8 || confirm_password != password) {
		confirm_password_state = false;
		$('#confirm_password').parent().removeClass();
		$('#confirm_password').parent().addClass("form_error");
		$('#confirm_password').siblings("span").text('Sorry... Passwords do not match');
	}else{
		confirm_password_state = true;
		$('#confirm_password').parent().removeClass();
		$('#confirm_password').parent().addClass("form_success");
		$('#confirm_password').siblings("span").text('OK');
 	}
 });
 //--------
 $('#submit_btn').on('click', function(e){
	
 	if (username_state == false || email_state == false || password_state == false || confirm_password_state == false) {
		let username = $('#username').val();
		let email = $('#email').val();
		let password = $('#password').val();
		let confirm_password = $('#confirm_password').val();
		e.preventDefault();
		$('#error_msg').text('Fix the errors in the form first');
		if(username == ''){
			username_state = false;
			$('#username').parent().removeClass();
			$('#username').parent().addClass("form_error");
			$('#username').siblings("span").text('Username is required');
		}
		if(email == ''){
			email_state = false;
			$('#email').parent().removeClass();
			$('#email').parent().addClass("form_error");
			$('#email').siblings("span").text('Email is required');
		}
		if(password == ''){
			password_state = false;
			$('#password').parent().removeClass();
			$('#password').parent().addClass("form_error");
			$('#password').siblings("span").text('Password is required');
		}
		if(confirm_password== ''){
			confirm_password_state = false;
			$('#confirm_password').parent().removeClass();
			$('#confirm_password').parent().addClass("form_error");
			$('#confirm_password').siblings("span").text('Must confirm  password');
		}
		
	}else{
		return true;
	}
 });
 //--------
});



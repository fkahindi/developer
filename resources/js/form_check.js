$('document').ready(function(){
	var username_state = false;
	var email_state = false;
	var privacy_state = false;
	$('#username').on('blur', function(){
		var illegalChars = /\W/; /* Allow at least letters, numbers, and underscores */
		var username = $('#username').val();
		
		if(username === ''){
			return;
		}else if(username.match(illegalChars)){
			username_state = false;
			$('#username').parent().removeClass();
			$('#username').parent().addClass("form_error");
			$('#username').siblings("span").text('Sorry...Only letters, number or underscore allowed, no spaces.');
		}else if(username.length<3){
			username_state = false;
			$('#username').parent().removeClass();
			$('#username').parent().addClass("form_error");
			$('#username').siblings("span").text('Sorry...Username should be three letters or more');
		}else{
			$.ajax({
			url: '/spexproject/includes/create_account_preprocess.php',
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
						$('#username').siblings("span").text('Sorry... You cannot use: '+username);
					}else if(response == 'not_taken') {
						username_state = true;
						$('#username').parent().removeClass();
						$('#username').parent().addClass("form_success");
						$('#username').siblings("span").text('');
					}				
				}
			});
		}
		
	});		
  $('#email').on('blur', function(){
 	var email = $('#email').val();
	var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ; /* //Check if it's valid mail address */
	var illegalChars = /[\(\)<>\,\;\:\\\"\[\]]/ ; /* // Check for illegal characters */
 	if (email === '') {
 		return;
 	}else if(!emailFilter.test(email)){
		email_state = false;
		$('#email').parent().removeClass();
		$('#email').parent().addClass("form_error");
		$('#email').siblings("span").text('Please, Enter valid email address');
	}else if(email.match(illegalChars)){
		email_state = false;
		$('#email').parent().removeClass();
		$('#email').parent().addClass("form_error");
		$('#email').siblings("span").text('Sorry... Email address contain illegal characters');
	}else{
		$.ajax({
		url: '/spexproject/includes/create_account_preprocess.php',
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
					$('#email').siblings("span").text('Sorry... You cannot use ' +email);
				}else if (response == 'not_taken') {
					email_state = true;
					$('#email').parent().removeClass();
					$('#email').parent().addClass("form_success");
					$('#email').siblings("span").text('');
				}			
			}
		});
	}
 		
 }); 
 
 $('#submit_btn').on('click', function(e){
	 
	 
 	if(username_state === false || email_state === false)
	{	
		e.preventDefault();
		var username = $('#username').val();
		var email = $('#email').val(); 
				
		$('#error_msg').text('Fix the errors in the form first');
				
		if(username === ''){
			$('#username').parent().removeClass();
			$('#username').parent().addClass("form_error");
			$('#username').siblings("span").text('Username is required');
		}
		if(email === ''){
			$('#email').parent().removeClass();
			$('#email').parent().addClass("form_error");
			$('#email').siblings("span").text('Email is required');
		}
		
	}else{
		$('#error_msg').text('');
		$('#username').siblings("span").text('');
		$('#email').siblings("span").text('');
		$('#privacy-checkbox').siblings("span").text('');
		return true;
	}
 });
});

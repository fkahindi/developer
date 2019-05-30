function validateFormOnSubmit(theForm){
	var reason = "";
	
	reason += validateFullname(theForm.fullname);
	reason += validateEmail(theForm.email);
	reason += validatePassword(theForm.password);
	reason += validateConfirm_password(theForm.confirm_password);
	
	if(reason != ""){
		alert ("Some fields need correction: \n" + reason);
		
		return false;
	}
	
	return true;
}

function validateEmpty(fld){
	var error ="";
	
	if(fld.value.length == 0){
		fld.style.background = "Yellow";
		error ="The required field has not been field in. \n";
	}else{
		fld.style.background = "White";
	}
	return error;
}

function validateFullname(fld){
	var error = "";
	    var illegalChars = /[\W_]/;  //Allow only letters and numbers
	if(fld.value ==""){
		fld.style.background ="Yellow";
		error ="Enter your fullname";
	}else if(illegalChars.text(fld.value) ){
		fld.style.background ="Yellow";
		error = "The name contain illegal characters";
	}else if(fld.value.length>15){
		fld.style.background ="Yellow";
		error = "The name cannot be more than 15 characters";
	}else{
		fld.style.background ="White";
	}
	return error;
}

function validatePassword(fld){
	var error ="";
	
	var illegalChars = /\W/;  //Allow letters, numbers and underscores
	
	if(fld.value == ""){
		fld.style.background = "Yellow";
		error = "You did not enter a password";
	}else if(fld.value.length<6){
		fld.style.background ="Yellow";
		error = "Password must be at least 6 characters";
	}else if(illegalChars.test(fld.value)){
		error = "Password can only contain letters, numbers and underscore";
		fld.style.background = "Yellow";
	}else{
		fld.style.background = "White";
	}
	return error;
}

function trim(s){
	return s.replace((/^\s+|\s+$/,'');
}

function validateEmail(fld){
	var error ="";
	var tfld = trim(fld.value); //Value of field with whitespace trimmed off
	var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
	var illegalChars = /[\(\)\<\>\,\;\:\\\"\[\]]/ ;
	
	if(fld.value==""){
		fld.style.background = "Yellow";
		error = "You didn't enter an email address.\n";
	}else if(!emailFilter.test(tfld)){  //test email for illegal characters
		fld.style.background = "Yellow";
		error = "Please enter a valid email address. \n";
	}else if(fld.value.match(illegalChars)){
		fld.style.background = "Yellow";
		error = "The email address contains illegal characters. \n";
	}else{
		fld.style.background = "White";
	}
	return error;
}
<?php
class ContactForm{
	//Properties
	private $field;
	private $field2;
	private $pattern;
	public $errorField;
	private $valid;
	
	//construct and assignments
	public function __construct($field,){
		$field=$this->field;
		$pattern=$this->pattern;
		$errorField=$this->errorField;
		$valid=$this->valid;
	}
	//Sanitizing, validating methods
	public function isFieldEmpty($field, $errorField){
		if(empty($field)){
			//$valid = false;
			//$this->errorField = 'Field cannot be blank';
			return $errorField .' field cannot be blank <br />';
			
		
		}else{
			//$valid = true;
			return $field;
		}
	}
	public function emailValidate($field){
		$field = filter_var($field, FILTER_SANITIZE_EMAIL);
		if(!filter_var($field, FILTER_VALIDATE_EMAIL)){
			$valid = false;
			$errors['$field'] = 'Invalid email address';
		}else{
			$valid = true;
		}
	}
	public function txtSanitize($field, $pattern){
		$field = filter_var($field, FILTER_SANITIZE_STRING);
		if(!preg_match($pattern, $field)){
			$valid = false;
			$errors ['$field'] = 'Invalid ' .$field;
		}else{
			$valid = true;
		}
	}
	public function compareFields($field, $field2){
		if($field !== $field2){
			$valid = false;
			$errors = $field2 .' does not match';
		}else{
			$valid = true;
		}
	}
	public function testInput($field){
		$field = stripslashes($field);
		$field = htmlspecialchars($field, ENT_QUOTES);
		return $field;
	}
}
<?php
if(!isset($_SESSION)){
	session_start();
}
require __DIR__ . '/../includes/loginStatus.php';
include __DIR__ .'/../includes/processFormAuthentication-Test.php';
if(isset($_POST['image-upload'])){
	imageUpload();
}
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Image Upload</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	
	<div id="upload">
	
		<form action="" method="post" enctype="multipart/form-data">
		<h2>Select image to upload:</h2>
		<div class="group-form">
		<input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
		<span class="errorMsg"><?php echo (!empty($errors['fileToUpload'])? $errors['fileToUpload'] :'');?></span>
		</div>
		<input type="submit" value="Upload Image" name="image-upload" class="button" id="image-upload-btn">
		<p><ul><li>Only images of size less than 2MB with .jpg, jpeg, .png or .gif formats are allowed.</li></ul> </p>
		</form>
	</div>
	
</body>
</html>
<script src="/spexproject/resources/js/jquery-1.7.2.min.js"></script>
<script>
$('document').ready(function(){
	
	$('#image-upload-btn').on('click', function(e){
		var fileToUpload = $('#fileToUpload').val();
		
		if(fileToUpload ==''){
			e.preventDefault();
			$('#fileToUpload').parent().removeClass();
			$('#fileToUpload').parent().addClass("form_error");
			$('#fileToUpload').siblings("span").text('You did not select an image');
			return false;
		}else{
			return true;
		}
	});
	$('#fileToUpload').on('input', function(){
		
		$('#fileToUpload').siblings("span").text('');		
	});
});
</script>
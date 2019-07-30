<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Image Upload</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	
	<div id="upload">
	
		<form action="/spexproject/includes/processFormAuthentication-Test.php" method="post" enctype="multipart/form-data">
		<h2>Select image to upload:</h2>
		
		<input type="file" name="fileToUpload" id="fileToUpload">
		<span class="errorMsg"><?php echo (!empty($errors['fileToUpload'])? $errors['fileToUpload'] :'');?></span>
		<input type="submit" value="Upload Image" name="image-upload" class="button">
		<p><ul><li>Only images sizes of less than 500kb with formats .jpg, .png and .gif are allowed.</li></ul> </p>
		</form>
	</div>
	
</body>
</html>
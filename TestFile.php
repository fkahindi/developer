<! DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration Form</title>
	<style>
	form{
		width:25%;
		margin:40px auto;
		
	}
	input, label{
		display:block;
		width:80%;
		margin-left:20px;
		padding:10px 0;
	}
	textarea{
		width:80%;
		margin-left:20px;
	}
	input[type="submit"]{
		margin:20px;
		padding:20px;
		background:rgb(230,230,230);
	}
</style>
</head>
<body>
	<form method="POST" action="">
		<label for="username">Username:</label>
		<input type="text" name="username" maxlength="15" placeholder="Username ..." required>
		<label for="email">Email:</label>
		<input type="email" name="email" maxlength="20" placeholder="Email..." required>
		<label for ="tel">Telephone</label>
		<input type="tel" name="tel" maxlength="9"placeholder="Phone number..." required>
		<label for="password">Password</label>
		<input type="password" name="password" placeholder="Password..." required>
		<label for="comment">Comment</label>
		<textarea name="comment" col=30 rows=5 placeholder="Type your text here..." required></textarea>
		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>
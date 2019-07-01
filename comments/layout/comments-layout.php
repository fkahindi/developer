<?php
if(!isset($_SESSION)){
	session_start();
}
require __DIR__ .'/../../includes/commentsFunctions.php';
require __DIR__ . '/comments_server.php';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">

</head>
<body>

<div class="comments-container">
	<hr>
	<?php if(isset($_SESSION['loggedin'])): ?>
		<!--Display comment box -->
		<div class="comment">
			<h3>Comments</h3>
			<form method="post" >
				<textarea name="comment" id="comment" cols="50" rows="6" maxlenth="100" placeholder="Type your comment here..." ></textarea>
				<input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id'] ?>">
				<input type="submit" id="post_btn" class="post_btn" name="submit" value="Post" >
			</form>
		</div>
	<?php else: ?>
		<!--Display login link  -->
		<div>
			<h5><a href="/spexproject/templates/login.html.php">Sign in</a> to comment.</h5>
		</div>
	<?php endif; ?>
	<h3><?php 
	//Display total comments so far for every user
	totalComments();
	?>&nbsp;Comment(s)</h3>
	<hr>
	<div class="comments-area" id="comments-area">
		<?php
		//Display user comments
		userComments();
		?>
	</div>
	<div class="" id="comments_display_area">
	<!--Display form comments using AJAX  -->
	
	</div>
</div>
</body>
</html>
<script src="/spexproject/resources/js/jquery-3.4.0.min.js"></script>
<script src="/spexproject/resources/js/comments-scripts.js"></script>
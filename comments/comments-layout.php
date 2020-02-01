<?php
if(!isset($_SESSION)){
	session_start();
}
require __DIR__ .'/../includes/comments_functions.php';
?>
<?php if(!isset($_SESSION['loggedin'])): ?>
	<!--Display login link  -->
	<div class="align-left">
		<h5><b> To comment or participate in conversations, please <a href="/spexproject/templates/login.html.php" class="sign-in" id="sign-in">Sign in</a>  &#124; <a href="/spexproject/templates/create-account.html.php"> Create an account.</a></b></h5>
	</div>
<!--**Display the following div container if no session is found**-->
<div class="comments-container" id="comments-container">
<?php else: ?>
<!--**Display the following div container if there is session loggedin**-->
<div class="comments-container" id="comments-container">	

	<!--Display comment box -->
	<div class="comment">
		<h3>Leave a comment</h3>
		<?php include __DIR__ .'/comments_form.php';?>
	</div>
<?php endif; ?>
	<div>
		<h5><?php 
		//Display total comments so far for every user
		//totalComments();
		 $total_comments = getCommentCountByPostId($page_id);
		 echo $total_comments;
		?>&nbsp;Comment(s)
		</h5><hr>	
		<?php
			include __DIR__ .'/comments_pagination.php';
			//Retrieve comments for this post
			$comments = getAllPostComments($page_id, $limit);
			include __DIR__ .'/comments_display_main_block.php';
		?>
	</div>
	<div data-id="<?php echo $page_id; ?>" id="pagination" class="pagination">
		
		<span class="<?php echo ($page_no >= $number_of_pages)? 'disabled':'' ?>">
		
		<a href="<?php echo ($page_no >= $number_of_pages)?'#': '?page_no='.($page_no+1); ?>" data-id="<?php echo ($page_no >= $number_of_pages)?'#':($page_no+1); ?>"
		class="load-more">Load more...</a>
		</span>
	</div>
</div>
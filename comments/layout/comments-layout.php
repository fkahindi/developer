<?php
if(!isset($_SESSION)){
	session_start();
}
require __DIR__ .'/../../includes/commentsFunctions.php';
?>
<div class="comments-container">
	<hr>
	<?php if(isset($_SESSION['loggedin'])): ?>
		<!--Display comment box -->
		<div class="comment">
			<h3>Leave a comment</h3>
			<form method="post" >
				<textarea name="comment" id="comment" cols="50" rows="6" maxlenth="100" placeholder="Type your comment here..." ></textarea>
				<input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id'] ?>">
				<input type="hidden" name="page_id" id="page_id" value="<?php echo $page_id ?>">
				<input type="submit" id="submit_comment" class="post_btn" name="submit" value="Post" >
			</form>
		</div>
	<?php else: ?>
		<!--Display login link  -->
		<div class="align-left">
			<h5><b> To comment or participate in conversations, please <a href="/spexproject/templates/login.html.php">Sign in</a>  &#124; <a href="/spexproject/templates/create-account.html.php"> Create an account.</a></b></h5>
		</div>
	<?php endif; ?>
	<h5><?php 
	//Display total comments so far for every user
	//totalComments();
	 echo getCommentCountByPostId($page_id);
	?>&nbsp;Comment(s)</h5>
	<hr>	
	<?php
		//Retrieve comments for this post
		$comments = getAllPostComments($page_id); 
	?>
	<?php if(isset($comments)): ?>
	<div class="comments-area" id="comments-area">
	<!-- Comments display area -->
		<?php foreach($comments as $comment): ?>
		<div class="comments-section group" >
			<div class="hide-comment-id">
				<?php echo $comment['comment_id']; ?>
			</div>
			<div class="profile-photo"> 
				<img src="<?php echo getUserById($comment['user_id'])['profile_photo']; ?>" alt="" width=30px height=30px>
			</div>
			<div class="comments-detail">
				<div class="user-info">
					<span class="username"><?php echo getUserById($comment['user_id'])['username']; ?></span>
					<span class="created-date"><?php echo date('F j, Y  \a\t H:i', strtotime($comment['created_at'])); ?></span>
				</div>
				<div class="comment-text">
					<?php echo $comment['body']; ?>
				</div>
					<?php if(isset($_SESSION['loggedin'])): ?> 
					<a href="#" data-id="<?php echo $comment['comment_id']; ?>" class="reply-btn">Reply</a>
					<?php endif; ?>
					<a href="#" data-id="<?php echo $comment['comment_id']; ?>" class="reply-thread">Show thread</a>
					<?php if(isset($_SESSION['loggedin'])): ?>
						<!-- Reply form -->
						<div class="reply">
							<form method="post" class="reply-form" id="comment_reply_form_<?php echo $comment['comment_id']; ?>" data_id="<?php echo $comment['comment_id']; ?>">
							<textarea name="reply" id="reply-textarea" class="reply-textarea" cols="50" rows="4" maxlenth="100" placeholder="Type your reply..." ></textarea>
							<input type="hidden" name="user_id" class="reply_form_user_id" value="<?php echo $_SESSION['user_id'] ?>">
							<input type="submit" class="submit-reply" name="submit" value="Submit" >
							</form>
						</div>
					<?php endif; ?>	
				<div class="group replies_container_<?php echo $comment['comment_id']; ?>" >
					<div class="replies_by_ajax">
						<!--Display reply by AJAX here -->
					</div>
					<!-- Get all replies by comment_id and display them below -->
					<?php $replies = getRepliesByCommentId($comment['comment_id']) ?>
					<?php if(isset($replies)): ?>
						<?php foreach($replies as $reply): ?>
							<!--Reply -->
							<div class="group">
								<div class="replies-profile-photo">
									<img src="<?php echo getUserById($reply['user_id'])['profile_photo']; ?>" alt="" width=30px height=30px>
								</div>
								<div class="replies-detail">
									<div class="user-info">
										<span class="username"><?php echo getUserById($reply['user_id'])['username']; ?></span>
										<span class="created-date"><?php echo date('F j, Y \a\t H:i', strtotime($reply['created_at'])); ?></span>
									</div>
									<div class="reply-text">
										<?php echo $reply['body']; ?>
									</div>
								</div>
							</div><br>
						<?php endforeach; ?>
					<?php endif; ?>
					
				</div>
			</div>
		</div>
		<?php endforeach; ?>
		<!--Display form comments using AJAX below here -->
	</div>
	<?php endif ?>
</div>
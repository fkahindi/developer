<div class="reply">
			
	<form method="post" class="reply-form" id="comment_reply_from_<?php echo $row['comment_id']?>" data_id="<?php echo $row['comment_id']?>">
		<textarea name="reply" id="reply" cols="30" rows="4" maxlenth="70" placeholder="Type your reply..." ></textarea>
		
		<input type="submit" id="submit_reply" class="submit-reply" name="submit" value="Post" >
	</form>
</div>
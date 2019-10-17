<div class="subscribe-section">
	<h5 class="align-left"><strong>You can subscribe and get notified when there is a new post.</strong></h5>
	<form  method="POST" action="" id="subscribe" >
		<div class="subscribe_error"></div>
		<div class="group-form">
			<label for="name">Name:</label>
			<input  name="name" id="name" class="form-control" type="text" 
			value="<?php echo (empty($name)? '': $name); ?>" maxlength="35" autocomplete="off" >
			<span class="errorMsg"> <?php echo(!empty($errors['name']) ? $errors['name'] : ''); ?></span>
		</div>
		
		<div class="group-form">
			<label for="email"> Email:<span class="red"> &#42;</span></label>
			<input name="email" id="email" class="form-control" type="text" 
			 type="email" value="<?php echo(empty($email)? '': $email); ?>" autocomplete="off" required>
			<span class="errorMsg"> <?php echo(!empty($errors['email']) ? $errors['email'] : ''); ?> </span>
		</div>
		<input name="subscribe" type="submit" id="submit_subscribe" class="button" value="Subscribe">
	</form>
	<div id="subscribe_response"><p></p></div>
</div>


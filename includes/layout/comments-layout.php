<!doctype html>
<?php
require_once __DIR__ .'/../commentsFunctions.php';
require_once __DIR__ .'/../DatabaseConnection.php';
require_once __DIR__ .'/../../classes/DatabaseTable.php';
?>
<div class="comments-container">
<hr>
<?php if(isset($_SESSION['loggedin'])): ?>
	<!--Display comment box -->
	<div class="comment">
		<h3>Post comment</h3>
		<form action="">
			<textarea name="comment" id="comment" cols="50" rows="6" maxlenth="100"></textarea>
			<input type="submit" value="Post">
		</form>
	</div>
<?php else: ?>
	<div>
		<h5><a href="/spexproject/templates/login.html.php">Sign in</a> to comment.</h5>
	</div>
<?php endif; ?>
<h3><?php 
totalComments();
?>&nbsp;Comment(s)</h3>
<hr>
<div class="comment" id="comment">
<?php

userComments();

?>

</div>
</div>
<style>
function showComment(str){
	if(str == ""){
		document.getElementById("comment").innerHTML = "";
		return;
	}else{
		if(window.XMLHttpRequest){
			//code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		}else{
			//code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				document.getElementById("comment").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "getcomment.php?q="+str, true);
		xmlhttp.send();
	}
}
</style>
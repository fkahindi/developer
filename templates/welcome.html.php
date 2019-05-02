<?php
//Initialize the session_cache_expire
session_start();

//Check if the user is logged in, if not redirect to the login page
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
	header('Location: ../classes/controllers/login.php');
	exit;
	
}
?>

<h4>Welcome <?php echo (!empty($_SESSION['fullname'])? $_SESSION['fullname']:'');?></h4>
<p>Start <a href="../index.php"> browsing</a>.</p>
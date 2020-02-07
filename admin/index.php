<?php 
	
if($_SESSION['role'] !== 'Admin'){
	header('Location: ../index.php');
}else{
	header('Location: dashboard.php');
}
?>
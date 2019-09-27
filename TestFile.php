<?php
if(!isset($_SESSION)){
	session_start();
}
if(isset($page_id)){
	echo 'The set page id is: '. $page_id;
}
if(isset($_SESSION['page_id'])){
	echo 'The SESSION page id is: '. $_SESSION['page_id'].'<br>';
}
if(!empty($_SESSION)){
	echo 'The SESSION username is: '. $_SESSION['username'].'<br>';
	echo 'The SESSION role is: '. $_SESSION['role'].'<br>';
}
?>
<a href="/spexproject/admin/dashboard.php'">Admin Area </a>
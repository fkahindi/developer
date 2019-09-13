<?php


if(isset($_POST['search_term'])){
	include __DIR__ .'/../includes/DBConnection.php';
	
	echo $_POST['search_term'].'<br>';
	$query = $_POST['search_term'];
	
	//Seperating words and appending the metaphone of each word with a space
	$search = explode(' ', $query);
	$search_term = '';
	foreach($search as $word){
		$search_term .= metaphone($word).' ';
	}
	echo $search_term .'<br>';
	$sql ="SELECT * FROM `posts` WHERE metaphoned LIKE '%$search_term%'";
	$res = mysqli_query($conn, $sql);
	if(!$res){
		echo mysqli_error($conn);
	}
	if(mysqli_num_rows($res)>0){
		while($row=mysqli_fetch_assoc($res)){

			?>
			<!--Display results -->
			<h1><?=$row['post_id'] ?></h1>
			<h2><?=htmlspecialchars_decode($row['post_title']) ?></h2>
			<h3><?=htmlspecialchars_decode($row['post_body']) ?></h3>
			<?php
		}
	}else{
		echo 'No search results found';
	}	
}

<?php
if(isset($_POST['search_term']) && (!empty($_POST['search_term']))){
	include __DIR__ .'/../../includes_devspot/DatabaseConnection.php';
	
	echo htmlspecialchars($_POST['search_term']).'<br>';
	$query = htmlspecialchars($_POST['search_term']);
	
	//Seperating words and appending the metaphone of each word with a space
	$search = explode(' ', $query);
	$search_term = '';
	foreach($search as $word){
		$search_term .= metaphone($word).' ';
	}
	//prepare variables for prepared statement
	$search_term1= $search_term;
	$search_term2 = '%'.$search_term .'%';

	$stmt = $pdo->prepare("SELECT post_title, SUBSTRING(post_body, GREATEST(1,LOCATE(?,post_body)-10),LEAST(25, LENGTH(post_body)-GREATEST(1,LOCATE(?,post_body)-10)))
	text FROM `posts` WHERE metaphoned LIKE ? AND published=1");
	
	$stmt->execute([$search_term1,$search_term1,$search_term2 ]);
	
	$res=$stmt->fetchAll();
	if($res){
		foreach($res as $row){
		?>
		<!--Display results -->
		<h5><?=htmlspecialchars_decode($row['post_title']) ?></h5>
		<p><?=htmlspecialchars_decode($row['text']) ?></p>
		<?php
		}
	}else{
		echo 'No search results found';
	}
}

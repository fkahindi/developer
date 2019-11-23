<?php
if(isset($_POST['search_term'])){
	include __DIR__ .'/../includes/DBConnection.php';
	
	echo htmlspecialchars($_POST['search_term']).'<br>';
	$query = htmlspecialchars($_POST['search_term']);
	
	//Seperating words and appending the metaphone of each word with a space
	$search = explode(' ', $query);
	$search_term = '';
	foreach($search as $word){
		$search_term .= metaphone($word).' ';
	}
	
	$sql ="SELECT post_title, SUBSTRING(post_body, LOCATE(post_body,'$search_term')-200, 500) text FROM `posts` WHERE metaphoned LIKE '%$search_term%' AND published=1";
	$res = mysqli_query($conn, $sql);
	if(!$res){
		echo mysqli_error($conn);
	}
	if(mysqli_num_rows($res)>0){
	
		while($row=mysqli_fetch_assoc($res)){
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

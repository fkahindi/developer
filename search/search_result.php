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
	$sql ="CONCAT_WS('',TRIM(SUBSTRING_INDEX(SUBSTRING(post_body,1,INSTR('$search_term')-1),'',-20)),'$search_term', TRIM(SUBSTRING_INDEX(SUBSTRING(post_body, INSTR(post_body,'$search_term' )+LENGTH('$search_term')),'',20)))";
	/* $sql ="SELECT post_title, SUBSTRING(post_body, LOCATE('$search_term',post_body)-100, 200) text FROM `posts` WHERE metaphoned LIKE '%$search_term%' AND published=1"; */
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

<?php
include __DIR__ .'/includes/DatabaseConnection.php';

function getCommentCountByPostId($id){
	global $pdo;
	$query = "SELECT COUNT(*) AS total FROM comments WHERE post_id= :id";
	
	$sql = $pdo->prepare($query);
	$sql->bindValue(':id', $id);
	$sql->execute();
	
	return $sql->fetch();
		
}

$total=getCommentCountByPostId(4);
echo $total['total'];
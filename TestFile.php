<?php
//include __DIR__ .'/includes/DatabaseConnection.php';
$pdo = new PDO('mysql:host=localhost; dbname=testing_db; charset=utf8',
	'db_tester','uu1WLTVaaeo3rL6V');
	
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try{
	$name ='Faith';	
$query = "INSERT INTO client (name, date_created)VALUES (:name, now())";

	$stmt = $pdo->prepare($query);
	$stmt->bindValue(':name', $name);
	$stmt->execute();
	
	//$comment->fetch();
	//var_dump($comment);
	$last_id = $pdo->lastInsertId();
	
	echo $last_id;
	$sql = 'SELECT * FROM `client` WHERE client_id = :last_id';
	$stmt2=$pdo->prepare($sql);
	//$stmt2->bindValue(':last_id', $last_id);
	$stmt2->execute([':last_id'=>$last_id]);
	$result=$stmt2->fetch();
	
	echo $result['name'];
	
}catch(PDOException $e){
		
		$title ='An error has occured';
		$output = 'Database error: ' . $e->getMessage() . ' in '
		. $e->getFile() . ':' . $e->getLine();
}		

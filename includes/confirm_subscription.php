<?php
//include necessary the files

try{
	$subscribeTempTbl = new DatabaseTable($pdo, 'subscribe_temp_tbl','email');
	$sql = $subscribeTempTbl->selectColumnRecords($email);
	
	if(!empty($sql->rowCount())){
		
		$curDate = date('Y-m-d H:i:s');
		$row=$sql->fetch();
		
		$createdDateTimeStamp = strtotime($row['created_at']);
		$curDateTimeStamp = strtotime($curDate);
		
		if($curDateTimeStamp-$createdDateTimeStamp<=86400){
			$created_at = new DateTime();	
			$created_at = $created_at->format('Y-m-d H:i:s');
			$fields =[
				'name' => $row['name'],
				'email' => $row['email'],
				'created_at' => $created_at
			];
			$subscribeUser = new DatabaseTable($pdo, 'subscribers', 'email');
			$query = $subscribeUser->insertRecord($fields);
			
			$sql = $subscribeTempTbl->deleteRecords($email);
			echo '<h2>Subscription confirmed! </h2><br>';
			echo '<h4>You will be notified when a new post is available.</h3><br>';
			echo '<p><a href="/spexproject/index.php">Continue</a></p>';
		}else{
			echo 'Token expired';
		}
		
	}else{
		echo 'Token was not found';
	}
}catch(PDOException $e){
	if($e->errorInfo[1]==1062){echo 'Subscriber already exists.';}		
}	
	
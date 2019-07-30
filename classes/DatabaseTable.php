<?php
class DatabaseTable
{
	//Setting class properties (or variables)
	
	private $pdo;
	private $table;
	private $keyfield;
	
	public function __construct(PDO $pdo, string $table, string $keyfield =''){
		$this->pdo = $pdo;
		$this->table = $table;
		$this->keyfield = $keyfield;
	}
	
	private function query( $sql, $parameters=[]){
		$query = $this->pdo->prepare($sql);
		$query->execute($parameters);
		return $query;
	}
	
	public function selectRecords($value1,$value2='') {
		
		$sql = 'SELECT * FROM `'.$this->table .'`
		WHERE `'.$this->keyfield .'` = :value1 OR `'
		.$this->keyfield .'` = :value2';
		
		$parameters =['value1'=> $value1,
		'value2'=> $value2
		];

		$query = $this->query($sql, $parameters);
		
		return $query;
	}

	public function selectMatchRecords($value1, $value2){
		
		$sql = 'SELECT * FROM `'.$this->table .'`
		WHERE `'.$this->keyfield .'` = :value1 AND `'
		.$this->keyfield .'` = :value2';
		
		$parameters =['value1'=> $value1,
		'value2'=> $value2
		];

		$query = $this->query($sql, $parameters);
		
		return $query;
		
	}
	public function selectCountAllRecords(){
		
		$sql = 'SELECT COUNT(*) FROM `'.$this->table .'`';
		
		
		$query = $this->query($sql);
		
		return $query;
	}
	
	public function insertRecord($fields) {
		$query = 'INSERT INTO `'.$this->table .'`(';
		
		foreach($fields as $key=>$value){
			$query .= '`'.$key.'`,';
		}
		
		$query = rtrim($query, ',');
		
		$query .= ') VALUES (';
		
		foreach ($fields as $key=>$value){
			$query .= ':'.$key. ',';
		}
		$query = rtrim($query, ',');
		$query .= ')';
		
		$this->query($query, $fields);
	}
	
	public function updateRecords($fields) {
		$query ='UPDATE `'.$this->table. '` SET ';
		
		foreach($fields as $key=>$value){
			$query .= '`'.$key .'` = :'.$key.','; 
		}
		$query = rtrim($query, ',');
		
		$query .= ' WHERE `'.$this->keyfield .'`= :keyfield';
		
		//Setting :$keyfield variable
		$fields ['keyfield'] = $_SESSION['email'];
		
		$this->query($query, $fields);
	}

	public function deleteRecords($value){
		
		$sql = 'DELETE FROM `'.$this->table .'` WHERE `'.$this->keyfield .'` = :value';
		$parameters = [':value' => $value];
		
		$this->query($sql, $parameters);
	}
}
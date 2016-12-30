<?php
class database{
protected $connection;
	public function __construct(){
		try {
			$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
			return $this->connection = new PDO($dsn,DB_USERNAME,DB_PASS);
		}catch(PDOException $e){
			return "Connection failed: " . $e->getMessage();
		}
	}
	public function insert($table_name,$fields_array,$fields_value){
		$columns = implode(", ",array_values($fields_array));
		$prefix = $fruitList = '';
		foreach ($fields_value as $fruit)
		{
			$fruitList .= $prefix . '"' . $fruit . '"';
			$prefix = ', ';
		}
		try {
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $this->connection->exec("INSERT INTO $table_name($columns)VALUES($fruitList)");
		}catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}
		public function login($table_name,$username,$password){
		try {
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $this->connection->prepare("SELECT * FROM $table_name WHERE  username  ='$username' AND password='$password'"); 
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
			return $values=$stmt->fetchAll();
		}catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}
	public function select_all($tablename){
		try{
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt=$this->connection->prepare("SELECT * FROM $tablename");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $values=$stmt->fetchAll();
		}
		catch(PDOException $e){
		return "Error: " . $e->getMessage();
		}
	}
	public function select_user($table_name,$username){
		try {
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $this->connection->prepare("SELECT * FROM $table_name WHERE username LIKE ?"); 
			$stmt->execute(array($username.'%'));;
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $values=$stmt->fetchAll();
		}catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}
		public function select_friend($table_name,$id1,$id2){
			try {
				$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $this->connection->prepare("SELECT * FROM $table_name WHERE user1  ='$id1' AND user2='$id2'"); 
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				return $values=$stmt->fetchAll();
			}catch(PDOException $e){
				return "Error: " . $e->getMessage();
			}
		}	
			public function select_friend_msg($table_name,$id1){
			try {
				$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $this->connection->prepare("SELECT * FROM $table_name WHERE user1 = '$id1'"); 
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				return $values=$stmt->fetchAll();
			}catch(PDOException $e){
				return "Error: " . $e->getMessage();
			}
		}
		public function select_message_frnd($table_name,$id1){
			try {
				$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $this->connection->prepare("SELECT * FROM $table_name WHERE id = '$id1'"); 
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				return $values=$stmt->fetchAll();
			}catch(PDOException $e){
				return "Error: " . $e->getMessage();
			}
		}
		public function update_account_table($table_name,$message,$id1,$id2){
		try {
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $this->connection->prepare("UPDATE $table_name SET message= '$message' WHERE user1  ='$id1' AND user2='$id2'"); 
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
			return $values=$stmt->fetchAll();
		}catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}
			
}
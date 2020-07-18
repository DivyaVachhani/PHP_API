<?php

/**
 * 
 */
class User
{
	private $conn;
	private $tablename = "users";

	public $id;
	public $name;
	public $email;
	public $password;
	
	function __construct($db)
	{
		$this->conn = $db;
	}

	public function signup()
	{
		if($this->isAlreadyExist()){
			return false;
		}

		$query = "INSERT INTO ". $this->tablename . " SET name=:name,
												 email=:email,
												 password=:password";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(":name",$this->name);
		$stmt->bindParam(":email",$this->email);
		$stmt->bindParam(":password",$this->password);

		if($stmt->execute()){
			$this->id = $this->conn->lastInsertId();
			return true;
		}
		return false;
	}

	public function isAlreadyExist()
	{
		$query = "SELECT * FROM ". $this->tablename . " WHERE email = '". $this->email ."'";
		$stmt = $this->conn->prepare($query);

		$stmt->execute();

		if($stmt->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
}
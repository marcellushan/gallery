<?php

class User {
	
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	
	public static function find_all_users() {
		global $database;
		
		return self::find_this_query("SELECT * FROM users");
	}
	
	public static function find_user_by_id($id) {
		global $database;
	
		$the_result_array = self::find_this_query("SELECT * FROM users WHERE ID = $id LIMIT 1");
		return !empty($the_result_array) ? array_shift($the_result_array) :false;
		
	}
	
	public static function find_this_query($sql) {
		global $database;
		$result_set = $database->setQuery($sql);
		$the_object_array = array();
		while ($row = $result_set->fetch(PDO::FETCH_ASSOC))
		{
			$the_object_array[] = self::instantiation($row);
		}
		return $the_object_array;
	}
	
	public static function verify_user($username, $password) {
	global $database;
	
	//$username = $database->username;
	//$password = $database->password;
	
	$sql = "SELECT * FROM users WHERE ";
	$sql .= "username = '{$username}' ";
	$sql .= "AND password = '{$password}' ";
	$sql .= "LIMIT 1";
	
	$the_result_array = self::find_this_query($sql);
	return !empty($the_result_array) ? array_shift($the_result_array) :false;
	
	}
	
	public static function instantiation($the_record){
		$the_object = new self;
		foreach ($the_record as $the_attribute => $value) {
			$the_object->$the_attribute = $value;
			
		}
		
		return $the_object;
		
	}
	private function has_the_attribute($the_attribute){
		$object_properties = get_object_vars($this);
		array_key_exists($the_attribute, $object_properties);
	}
	
	public function create() {
		global $database;
		
		$sql = "INSERT INTO users (username, password, first_name, last_name)";
		$sql .= "VALUES ('";
		$sql .= $this->username . "', '";
		$sql .= $this->password . "', '";
		$sql .= $this->first_name . "', '";
		$sql .= $this->last_name . "')";

		if($database->setQuery($sql)) {
			$this->id = $database->connection->lastInsertId();
			return true;
		} else {
			return false;
		}
	}
	
	public function update() {
		global $database;
		$sql = "UPDATE users SET ";
		$sql .= "username= '" . $this->username . "', ";
		$sql .= "password= '" . $this->password . "', ";
		$sql .= "first_name= '" . $this->first_name . "', ";
		$sql .= "last_name= '" . $this->last_name . "'";
		$sql .= " WHERE id= " . $this->id;
		
		$database->setQuery($sql);
		//echo $sql;
		return;//($database->rowCount() == 1) ? true : false;
		
	}
	
	
	
}  // End of Class


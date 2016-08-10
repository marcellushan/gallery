<?php

class User {
	protected static $db_table = "users";
	protected static $db_table_fields = array('username', 'password','first_name','last_name');
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
	
	protected function properties() {
		
// 		return get_object_vars($this);

		$properties = array();
		
		foreach (self::$db_table_fields as $db_field) {
			if (property_exists($this, $db_field)) {
				$properties[$db_field] = $this->$db_field;
			}
		}
		return $properties;
	}
	public function save() {
		
		return isset($this->id) ? $this->update() : $this->create();
		
	}
	
	public function create() {
		global $database;
		
		$properties = $this->properties();
		
		$sql = "INSERT INTO " .self::$db_table ."(" . implode(",", array_keys($properties)) . ")";
		$sql .= "VALUES ('" .  implode("','", array_values($properties)) . "')";
// echo $sql;
		if($database->setQuery($sql)) {
			$this->id = $database->connection->lastInsertId();
			return true;
		} else {
			return false;
		}
	}
	
	public function update() {
		global $database;
		
		$properties = $this->properties();
		
		$properties_pairs = array();
		
		foreach ($properties as $key => $value) {
			$properties_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$db_table . " SET ";
		$sql .= implode(",", $properties_pairs);
		$sql .= " WHERE id= " . $this->id; 
		$theConn = $database->connection;
		$theQuery = $theConn->prepare($sql);
		$theQuery->execute();
		//$database->prepare($sql);
// 		echo $sql;
		return ($theQuery->rowCount() == 1) ? true : false;
		
	}
	
	public function delete() {
		global $database;
		$sql = "DELETE FROM ".self::$db_table . " WHERE ";
		$sql .= " id= " . $this->id;
		$theConn = $database->connection;
		$theQuery = $theConn->prepare($sql);
		$theQuery->execute();
		//echo $sql;
		return ($theQuery->rowCount() == 1) ? true : false;
	
	}
	
	
	
}  // End of Class


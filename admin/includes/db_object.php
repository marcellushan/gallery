<?php
class Db_object {
	public static function find_all() {
		global $database;
	
		return static::find_by_query("SELECT * FROM " .static::$db_table . "");
	}
	
	public static function find_by_id($id) {
		global $database;
	
		$the_result_array = static::find_by_query("SELECT * FROM " .static::$db_table . " WHERE ID = $id LIMIT 1");
		return !empty($the_result_array) ? array_shift($the_result_array) :false;
	
	}
	

	public static function find_by_query($sql) {
		global $database;
		$result_set = $database->setQuery($sql);
		$the_object_array = array();
		while ($row = $result_set->fetch(PDO::FETCH_ASSOC))
		{
			$the_object_array[] = static::instantiation($row);
		}
		return $the_object_array;
	}
	
	public static function verify_user($username, $password) {
		global $database;
	
		//$username = $database->username;
		//$password = $database->password;
	
		$sql = "SELECT * FROM " .static::$db_table . " WHERE ";
		$sql .= "username = '{$username}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";
	
		$the_result_array = static::find_by_query($sql);
		return !empty($the_result_array) ? array_shift($the_result_array) :false;
	
	}
	
	public static function instantiation($the_record){
		$calling_class = get_called_class();
		$the_object = new $calling_class;
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
	
		foreach (static::$db_table_fields as $db_field) {
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
	
		$sql = "INSERT INTO " .static::$db_table ."(" . implode(",", array_keys($properties)) . ")";
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
		$sql = "UPDATE ".static::$db_table . " SET ";
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
		$sql = "DELETE FROM ".static::$db_table . " WHERE ";
		$sql .= " id= " . $this->id;
		$theConn = $database->connection;
		$theQuery = $theConn->prepare($sql);
		$theQuery->execute();
		//echo $sql;
		return ($theQuery->rowCount() == 1) ? true : false;
	
	}
	
} //End of class

<?php

class User extends Db_object {
	protected static $db_table = "users";
	protected static $db_table_fields = array('username', 'password','first_name','last_name');
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	

	
	
}  // End of Class


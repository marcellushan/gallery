<?php
class Photo extends Db_object {
	
	
	protected static $db_table = "photos";
	protected static $db_table_fields = array('photo_id', 'username', 'title','description','filename', 'type', 'size');
	public $photo_id;
	public $title;
	public $description;
	public $filename;
	public $type;
	public $size;
} //end of class

?>
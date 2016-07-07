<?php
$servername = $_SERVER['SERVER_NAME'];
class MySQLdatabase 
	{
		function __construct() 
			{
				$this->open_connection();
			}
						
		public function open_connection()
			{

				     global $servername;
  						 $db_name = "mysql:host=localhost;dbname=gallery_db";
				 if($servername=="localhost") 
				 	{
						 $user = "marc";
		  				 $pass = "F1agstaff";  
		  			}
	  			elseif($servername=="forms.highlands.edu")
		  			{
			  			$user = "root";
	  				 	$pass = "everyonemotiveexplorelately";  
	  				 }
	  			else
		  			{
			  			$user = "root";
	  				 	$pass = "europe-guilty-kaleidoscope-head";  
	  				 }
				try	
					 {
			    		$this->connection = new PDO($db_name, $user, $pass);
					} 
						catch (PDOException $e)	
						 {
			    				print "Error!: " . $e->getMessage() . "<br/>";
			    				die();
						}			
			}

		public function close_connection()
			{
				$this->connection = null;			
			}

		public function countQuery ($sql) 
				{
					 $result= $this->connection->prepare($sql);
	  					$result->execute();
	  					return $count=$result->rowCount();
				}
				
				public function setQuery ($sql) 
				{
					 $result= $this->connection->prepare($sql);
	  					$result->execute();
	  					return $result;
				}
				  					

        public function rawQuery($sql)
        {
            $this->open_connection();
            $this->connection->query($sql);
        }
				  					
				  					
  			 public function quote($string) 
	  			 {
	    			$quoted_string = $this->connection->quote($string);
	   				 return $quoted_string;
	  			}
  					
				public function fetch_array($result_set)
					{
							$result_set= $result_set->fetch(PDO::FETCH_ASSOC);
							return $result_set;
					}

	} //close class
	
// $database = new MySQLdatabase();

// $sql = "select * from users where id=1";

// $result= $database->setQuery($sql);
//$result = $sth->fetch(PDO::FETCH_ASSOC);
// $rs = $database->fetch_array($result);
// print_r($rs);

?>


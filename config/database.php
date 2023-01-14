<?php
//todo auto generate this
class Database{

	private static $conn;
	private static $error = "";

	public static function getConnection(){
	    date_default_timezone_set("Africa/Lusaka");
		$driver = new mysqli_driver();
		$driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;
		try{
		    $db_host = "localhost"; //database host
		    $db_user = "twishe5_pharmacy";  //database user
		    $db_password = "1_4BdbO{ZG8C"; // database user password 
		    $database_input = "twishe5_pharmacy"; //database name
		    self::$conn = new mysqli($db_host, $db_user,$db_password,$database_input);
		    self::$conn->set_charset("utf8");		     
		   } 
		  catch(Exception $e) {
		   //an error occurred
		  	 self::$error = $e->getMessage(); 
		}
		return self::$conn;
     }

    public function getError(){
        return self::$error;
    }
} 
 

// db_connect.php
<?php

class DB_CONNECT {
	// constructor
	function __construct() {
		// connecting to database
		$this->connect();
	}

	/*// destructor
	function __destruct() {
		// closing db connection
		$this->close();
	}*/

	function connect() {
		// import database connection variables
		require_once __DIR__ . '/db_config.php';
		
		// Connecting to mysql database
		$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
		echo "Connection Successful";
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
	// Selecing database
	$db = mysqli_select_db($con,DB_DATABASE) or die(mysql_error()) or die(mysql_error());
	echo "Connection Complete";

	// returing connection cursor
	mysqli_close($con);
	return $con;
}

	/*function close() {
		mysql_close();
	}*/

}

?>
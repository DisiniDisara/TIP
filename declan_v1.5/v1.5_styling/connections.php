<?php

	defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
	defined('DB_USER')   ? null : define("DB_USER", "root");
	defined('DB_PASS')   ? null : define("DB_PASS", "");
	defined('DB_NAME')   ? null : define("DB_NAME", "corpU_db");    

	$mysqli = mysqli_connect( DB_SERVER, DB_USER, DB_PASS, DB_NAME);

	if ( !$mysqli ) {

		$connection = "Error: Unable to connect to MySQL." . PHP_EOL;
		$connection .= "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		$connection .= "Debugging error: " . mysqli_connect_error() . PHP_EOL;

		exit( $connection );

	}else{
		
		$connection = "Connection success - Host information: " . mysqli_get_host_info( $mysqli );
		
	}

?>


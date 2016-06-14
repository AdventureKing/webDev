<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "mydb";

function connect_db(){
	$conn = mysqli_connect($GLOBALS['dbhost'],$GLOBALS['dbuser'],$GLOBALS['dbpass'],$GLOBALS['dbname'],3306);

	if(mysqli_connect_errno($conn)){
		echo "Failed to connect to MySql: " . mysqli_connect_error();
	}
	return $conn;
}

//echo "Successfully connected to the database!"
?>
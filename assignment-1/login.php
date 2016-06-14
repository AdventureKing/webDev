<?php
session_start();
include('database.php');
$conn = connect_db();
$username = sanitizeString($_POST['username'],$conn);
$password = sanitizeString($_POST['password'],$conn);
//echo "Successfully connected to the database!"
//decrypt


$result = $conn->query("SELECT * FROM users WHERE username='$username'");
//check the db

$user = mysqli_fetch_row($result);

if(password_verify($password, $user[2])){
	
	$_SESSION["username"] = $username;

	header("Location: feed.php");

	//echo "Hello " . $username;
}
else{
	//header("Location: login.html");
	var_dump($user);
}
//if authenticated: say hola!

//else ask to login again.....

function sanitizeString($var,$conn)
{
 $var = strip_tags($var);
 $var = htmlentities($var);
 $var = stripslashes($var);
 return $conn->real_escape_string($var);
}


?>
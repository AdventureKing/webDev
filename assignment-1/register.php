<?php


//include db connection
include('database.php');

$conn = connect_db();
//grab values from register.html
$username = sanitizeString($_POST['username'],$conn);
$password = sanitizeString($_POST['password'],$conn);
$name = sanitizeString($_POST['name'],$conn);
$email = sanitizeString($_POST['email'],$conn);
$dob = sanitizeString($_POST['dob'],$conn);
$gender = sanitizeString($_POST['gender'],$conn);
$verfi_answer = sanitizeString($_POST['verification_answer'],$conn);
$location = sanitizeString($_POST['location'],$conn);
$profile_picture = sanitizeString($_POST['profile_pic'],$conn);


$password = hashpassword($password);

/*echo $username . " " . " " . $name . " " . $email . " " . $password . " "
. $dob . " " . $gender . " " . $verfi_question . " " . $location . " " . $profile_picture;*/
//insert into db useing conn object
//$conn = connect_db();
$question = "where were you born?";
$query = "INSERT INTO users (username,password,name,email,dob,gender,verification_question,verification_answer,location,profile_pic)
VALUES ('$username','$password','$name','$email','$dob','$gender','$question','$verfi_answer','$location','$profile_picture')";
//if correctly inserted then foward to feed page
if($conn->query($query)){
	$_SESSION["username"] = $username;

	header("Location: login.html");
}else{
	echo $result;
	echo "you dun goofed up!";
}

function sanitizeString($var,$conn)
{
 $var = strip_tags($var);
 $var = htmlentities($var);
 $var = stripslashes($var);
 return $conn->real_escape_string($var);
}

function hashpassword($var){
$options = [
    'cost' => 11,
];
// Get the password from post
$passwordFromPost = $var;

$hash = password_hash($passwordFromPost, PASSWORD_BCRYPT, $options);

// Now insert it (with login or whatever) into your database, use mysqli or pdo!
return $hash;
}
?>

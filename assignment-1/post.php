<?php

  session_start();

  include('database.php');
  $conn = connect_db();
  $UID = sanitizeString($_POST['UID'],$conn);
  $content = sanitizeString($_POST['content'],$conn);
  $username = sanitizeString($_POST['username'],$conn);
  $profile_pic = sanitizeString($_POST['profile_pic'],$conn);

 
  $query = "INSERT INTO posts(UID,name,profile_pic,content,likes) VALUES ($UID,'$username','$profile_pic','$content',0)";
  $result = $conn->query($query);
echo $conn->error;
  if($result){
    
    echo "ok nice post bro!";
    header("Location: feed.php");

  }else{
    echo "something went wrong!";
  }



function sanitizeString($var,$conn)
{
 $var = strip_tags($var);
 $var = htmlentities($var);
 $var = stripslashes($var);
 return $conn->real_escape_string($var);
}
?>

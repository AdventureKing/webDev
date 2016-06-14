<?php



  session_start();

  include('database.php');
  $conn = connect_db();
  $UID = sanitizeString($_POST['UID'],$conn);
  $PID = sanitizeString($_POST['PID'],$conn);
  $content = sanitizeString($_POST['content'],$conn);
  $username = sanitizeString($_POST['username'],$conn);
  $profile_pic = sanitizeString($_POST['profile_pic'],$conn);
  $likes = 0;

  
  $query = "INSERT INTO comments(post_id,content,UID,name,profile_pic,likes) VALUES ('$PID','$content','$UID','$username','$profile_pic','$likes')";
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




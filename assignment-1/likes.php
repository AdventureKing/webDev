<?php

session_start();
include('database.php');

$conn = connect_db();

$PID = $_POST['PID'];

$result = mysqli_query($conn,"SELECT * FROM posts WHERE id='$PID'");

$row = mysqli_fetch_assoc($result);
$likes = $row['likes'];
$likes = $likes + 1;

$result = mysqli_query($conn,"UPDATE posts SET likes='$likes' where id='$PID'");

if($result){
  header('Location: feed.php');
}else{
  echo "Something is wrong!";
}

?>

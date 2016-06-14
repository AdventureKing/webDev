<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
	.postBox {
    border: 1px solid #795548;
    /* margin-left: 30px; */
    padding: 5px;
}
.commentBox {
    border: 1px solid blue;
    margin-left: 30px;
    padding: 5px;
}
.postCommentBox {
    border: 1px solid #FF5722;
    /* margin-left: 30px; */
    padding: 5px;
}
.postwrapper {
    border: 1px solid #CCC;
     margin: 20px; */
    padding: 10px !important;
}</style>
</head>
	<body>
	<?php
	//include db instance from other file
	include('database.php');

	session_start();
	if(null == $_SESSION['username']){
		header("Location: login.html");
	}
	$username = $_SESSION["username"];
	//echo "Welcome Back " . $username . " !";
	$conn = connect_db();
	$result = $conn->query("SELECT * FROM users WHERE username='$username'");

	$row = mysqli_fetch_assoc($result);
	$user_logged_in = $row;
	echo "<h1>Welcome back " . $row['name'] ."!</h1>";
	echo "<p><a href='logout.php'>LOGOUT FROM BRANDONBOOK!</a></p>";
	echo "<img src='" . $row['profile_pic'] ."'>";
//post foum
	echo "<form action='post.php' method='POST'>";
	echo "<p>";
	echo "<label>Post to your followers:</label><br/>";
	echo "<textarea name='content'  placeholder='Post to your followers!!!'></textarea>";
	echo "<input type='hidden' name='UID' value='$row[id]'/>";
	echo "<input type='hidden' name='username' value='$row[username]' />";
	echo "<input type='hidden' name='profile_pic' value='$row[profile_pic]' />";
	echo "<br/>";
	echo "<input type='submit'>";
	echo "</form>";

	$result_posts = mysqli_query($conn,"SELECT * FROM posts");
	$num_of_rows = mysqli_num_rows($result_posts);
	echo "<h2>My Feed</h2>";
	if($num_of_rows ==0){
		echo "<p>
		No new posts to show!
		</p>";
	}else{
		//echo "<p> $num_of_rows</p>";
	//start of my feed

	for($i = 0; $i < $num_of_rows; $i++){
		echo "<div class='postwrapper'>";
			$row = mysqli_fetch_row($result_posts);
			$result_comment_rows = mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$row[0]'");
			$num_of_comments = mysqli_num_rows($result_comment_rows);

			echo "<div class='postBox'>$row[2] said $row[4] ($row[5])";
						
			echo "<form action='likes.php' method='POST'>
			<input type='hidden' value='$row[0]' name='PID' />
			<input type='submit' value='like' />
			</form></div>";
			//echo "$num_of_comments";
			if($num_of_comments == 0){
				
			}else{
				for($j = 0; $j < $num_of_comments; $j++){
				$comment_row = mysqli_fetch_row($result_comment_rows);
				echo "<div class='commentBox'><p>$comment_row[4] commented $comment_row[2] ($comment_row[6])</p>";
				echo "<form action='likes_comment.php' method='POST'>
			<input type='hidden' value='$comment_row[0]' name='PID' />
			<input type='submit' value='Like this Comment' />
			</form></div>";
				}
			}
			echo "<div class='postCommentBox'><p> Comment</p>";
			echo "<form action='comment.php' method='POST'>";
			echo "<textarea name='content'  placeholder='Comment on this post!!!'></textarea>";	
			echo "<input type='hidden' name='UID' value='$user_logged_in[id]'/>";
			echo "<input type='hidden' name='username' value='$user_logged_in[username]' />";
			echo "<input type='hidden' name='profile_pic' value='$user_logged_in[profile_pic]' />";
			echo "<input type='hidden' value='$row[0]' name='PID' />";
			echo "<input type='submit' value='comment' />";
			echo "</form></div>";		
			echo "<br />";
			echo "</div>";
	}
			
}

//end of my feed
	?>
	</body>
</html>

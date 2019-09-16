<a href="index.php">home</a>| <a href="post.php">make post</a> | <a href="editpro.php">edit profile </a> | <a href="logout.php">logout</a><br><br>
	<?php
	//Check if there a session created
	session_start();
	if(isset($_SESSION['id'])){
		
		$userid=$_SESSION['id'];
		$conn=mysqli_connect('localhost','root','','quickpost');
	if(!$conn){
		echo "connection failed";
	}
//if session created get user name and profile image
	$select=mysqli_query($conn,"SELECT * FROM user WHERE id='$userid'");
		$number=mysqli_num_rows($select);
		$userinfo=$select->fetch_assoc();
		$username=$userinfo['username'];
		$image=$userinfo['image'];
		$email=$userinfo['email'];
		echo "<img src= data:image/jpg;base64,$image width='5%' height='5%'>";
		echo "<br>";
		echo "<h3>Hello ".$username."</h3>";


	}
	else{
		//if no session created
		echo "<script language='Javascript'>";
		 		echo "document.location.replace('./login.php')";
		 		echo "</script>";
	}
	?>
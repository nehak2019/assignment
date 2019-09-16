<?php
session_start();//get the session
 if(isset($_GET['id'])){//check if we get id from a get
 	$id=$_GET['id'];//put the id of selected post in a variable
 	if(isset($_SESSION['id'])){//check if session exsist
		
		$userid=$_SESSION['id'];//put the  value of session id into user id
		$conn=mysqli_connect('localhost','root','','quickpost');//make a connection to the database
	if(!$conn){//if there is no cannection 
		echo "connection failed";
	}
}else{//if there is no session
	echo "<script language='Javascript'>";
		 		echo "document.location.replace('./login.php')";//go to login page
		 		echo "</script>";
  }
  	$delete=mysqli_query($conn,"DELETE FROM postinfo where id='$id'");//delete post with the get id
  	echo "<script language='Javascript'>";
		 		echo "document.location.replace('./page.php')";//go to user page
		 		echo "</script>";

 }
?>
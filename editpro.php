<!DOCTYPE html>
<html>
<head>
	<title>Page</title>
	<style>
div.gallery {
  margin: 5px;
  border: 1px solid #ccc;
  float: left;
  width: 180px;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
}
</style>
</head>
<body>
	<?php
	include 'menu.php';

	?>
	<h1>Edit profile</h1>
	<form method="POST" action="" enctype="multipart/form-data">
		<label>Username</label>
		<input type="text" name="username" value="<?php echo $username;?>"><br><br>
		<label>Email</label>
		<input type="text" name="email" value="<?php echo $email;?>"><br><br>
		
		<label>ProfileImage</label>
		<input type="file" name="image" ><br><br>

		<input type="submit" name="submit1" value="Edit information">

	</form>
	<h1>Change password</h1>
	<form method="POST" action="" enctype="multipart/form-data">
		
        <label>Password</label>
		<input type="password" name="password1"><br><br>
		<label>Confirm password</label>
		<input type="password" name="password2"><br><br>

		<input type="submit" name="submit2" value="change password">

	</form>

	<?php
	
	//submit1 edit email,username,image
	if(isset ($_POST['submit1'])){
		//declare variables who hold data from the form fields
			$email=$_POST['email'];
			$username=$_POST['username'];

			$imagepath=$_FILES['image']['tmp_name'];

			if($imagepath){
				$binary =fread(fopen($imagepath, 'r'),filesize($imagepath));
		 		$picture =base64_encode($binary);
				echo $picture;
		 	
		 		$update=mysqli_query($conn,"UPDATE user SET username='$username',email='$email',image='$picture' WHERE id='$userid'");
		 	if($update){
		 		echo"good";
		 		echo "<script language='Javascript'>";
		 		echo "document.location.replace('./page.php')";
		 		echo "</script>";


		 	}
		 	else{
		 		echo ("error".mysqli_error($conn));
		 	}

		 }
		 else{
		 	$update=mysqli_query($conn,"UPDATE user SET username='$username',email='$email' WHERE id='$userid'");
		 	if($update){
		 		echo"good";
		 		echo "<script language='Javascript'>";
		 		echo "document.location.replace('./page.php')";
		 		echo "</script>";


		 	}
		 	else{
		 		echo ("error".mysqli_error($conn));
		 	}
		 	}
		}



		//submit2 edit password
	if(isset ($_POST['submit2'])){
		//declare variables who hold data from the form fields
			$password1=$_POST['password1'];
			$password2=$_POST['password2'];

			

			if($password1==$password2){
				$password=md5($password1);
				$update=mysqli_query($conn,"UPDATE user SET password='$password'");
		 	if($update){
		 		echo"good";
		 		echo "<script language='Javascript'>";
		 		echo "document.location.replace('./logout.php')";
		 		echo "</script>";


		 	}
		 	else{
		 		echo ("error".mysqli_error($conn));
		 	}

		 }
		 else{
		 		echo"your password should be same";

		 	}
		 }
	
			




		
	?>


</body>
</html>

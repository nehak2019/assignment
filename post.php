


<!DOCTYPE html>
<html>
<head>
	<title>Post Something</title>
</head>
<body>
	<?php
	include 'menu.php';
	?>
	<h1>Make a post</h1>
	<form method="POST" action="" enctype="multipart/form-data">
		<label>title</label>
		<input type="text" name="title"><br><br>
		
		<label>Image</label>
		<input type="file" name="image"><br><br>
        <label>Contents</label>
		<textarea name="content"></textarea><br><br>
		<input type="submit" name="submit" value="post">

	</form>

	<?php
	$conn=mysqli_connect('localhost','root','','quickpost');
	if(!$conn){
		echo "connection failed";
	}

	if(isset ($_POST['submit'])){
		$title=addslashes($_POST['title']);
		$content=addslashes($_POST['content']);
	    $datep= date('y-m-d');
		
		$imagepath=$_FILES['image']['tmp_name'];
		 echo "title : ".$title;
		 echo "<br>";
		 echo "content : ".$content;
		 echo "<br>";
		 echo "datep : ".$datep;
		 echo "<br>";
		 echo "image : ".$imagepath;
		 echo "<br>";
		 
		 if($imagepath){

		 	$binary =fread(fopen($imagepath, 'r'),filesize($imagepath));
		 	$picture =base64_encode($binary);

		 	echo $picture;
		 	
		 	$insert=mysqli_query($conn,"INSERT INTO postinfo(title, image, content, datep, userid) VALUES ('$title','$picture','$content','$datep','$userid')");
		 	if($insert){
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
		 	echo "choose your image profile";
		 }




	
}








	?>


</body>
</html>

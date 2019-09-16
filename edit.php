<!DOCTYPE html>
<html>
<head>
	<title>Post Something</title>
</head>
<body>
	<?php
	include 'menu.php';
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
	    $sql=mysqli_query($conn,"SELECT * FROM postinfo WHERE id='$id'");
	    $num_rows=mysqli_num_rows($sql);
	    if ($num_rows>0) {
	    	while ($row=$sql->fetch_assoc()) {
	    		$id=$row['id'];
	    		$title=$row['title'];
	    		$image=$row['image'];
	    		$content=$row['content'];

	    		
	    	}
	    }
	}

	?>
	<h1>Edit post</h1>
	<form method="POST" action="" enctype="multipart/form-data">
		<label>title</label>
		<input type="text" name="title" value="<?php echo $title ?>"><br><br>
		<?php echo "<img src= data:image/jpg;base64,$image width='5%' height='5%'>";?>
		<label>Image</label>
		<input type="file" name="image"><br><br>
        <label>Contents</label>
		<textarea name="content" ><?php echo $content ?></textarea><br><br>
		<input type="submit" name="submit" value="Edit">

	</form>

	<?php
	$conn=mysqli_connect('localhost','root','','quickpost');
	if(!$conn){
		echo "connection failed";
	}

	if(isset ($_POST['submit'])){
		$title=$_POST['title'];
		$content=$_POST['content'];
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
		 	
		 	$update=mysqli_query($conn,"UPDATE postinfo SET title='$title',image='$picture',content='$content',datep='$datep' WHERE id='$id'");
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
		 	$update=mysqli_query($conn,"UPDATE postinfo SET title='$title',content='$content',datep='$datep' WHERE id='$id'");
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








	?>


</body>
</html>

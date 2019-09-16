<!--
AUTHOR : AMANI A. SAINT-CLAIR

-->
<!DOCTYPE html>
<html>
<head>
  <title>WELCOME TO PHPTEST</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/menu.css">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="css/gallery.css">
<link rel="stylesheet" href="css/pagination.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</head>
<body>
<div class = "container">
  <?php
  if(isset($_SESSION['name'])){
  header('location:account.php');
  }
  include 'menu.php';
  ?>

<div style="padding-left:16px">
  <h2>Free publish Website</h2>
  <p>Login and post something here below check some people posts.</p>
</div>

<table class="table table-striped">
    <tbody>
      <?php
          include 'config.php';
          $perpage = 6;
          if(isset($_GET["page"])){
          $page = intval($_GET["page"]);
          }else {
          $page = 1;
          }
          $calc = $perpage * $page;
          $start = $calc - $perpage;
          $result = mysqli_query($conn, "SELECT * FROM userpost ORDER BY id DESC  Limit $start, $perpage");
          $rows = mysqli_num_rows($result);

          if($rows){
          $i = 0;
        while($post = mysqli_fetch_assoc($result)) {
           $picture= $post["picture"];
           $type = $post["type"];
           $title = $post['title'];
           $description = $post['description'];
           $datepost = $post['datepost'];
  ?>

    <tr>
    <td>
      <div class="gallery">
            <a  href="img.jpg">
              <?php echo "<img src=data:image/jpg;base64,$picture width='20%' height='20%'>";?>
            <!--  <img src="image/img.jpg" alt="5Terre" width="20%" height="20%">-->
            <div class="desc">
              <?php echo $type; ?>
            </div>
            </a>
        </div>
        </td>
        <td>
        <font size="2">
        <h3><b><u><?php echo $title; ?></u></b></h3>
        <?php echo $description; ?>
        <br>
        <?php
        echo "<b>";
        echo "Posted : ".$datepost."";
        echo "</b>";

         ?>
        </font>
      </td>
      </tr>
      <?php
             }
      }else{
              echo "<center>";
              echo "<font color = 'red'>";
              echo "NO POST YET !";
              echo "</font>";
              echo "</center>";
          }
               ?>


    </tbody>
</table>
<div class="w3-container">
 <div class="w3-panel w3-card">
 <div class="pagination">
   <center>
<?php
    if(isset($page)){
    $result = mysqli_query($conn,"select Count(*) As Total from userpost");
    $rows = mysqli_num_rows($result);
    if($rows){
    $rs = mysqli_fetch_assoc($result);
    $total = $rs["Total"];
    }
    $totalPages = ceil($total / $perpage);
    if($page <=1 ){
    //echo "<span id='page_links' style='font-weight: bold;'>&laquo;</span>";
    }else{
    $j = $page - 1;
    echo "<a href='index.php?page=$j'>&laquo;</a>";
    }
    for($i=1; $i <= $totalPages; $i++){
    if($i<>$page){
      echo "<a href='index.php?page=$i'>$i</a>";
    }
    else
    {
      echo "<a href='index.php?page=$i' class='active'>$i</a>";
    }
  }
  if($page == $totalPages )
  {
//echo "<span id='page_links' style='font-weight: bold;'>&raquo;</span>";
  }else{
    $j = $page + 1;
    echo "<a href='index.php?page=$j'>&raquo;</a>";
    }
    }
    ?>
  </center>
 </div>
 </div>
   </div>
<?php
include 'footer.php';
mysqli_close($conn);
?>





</div>

<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>

</body>
</html>

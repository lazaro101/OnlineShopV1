<link rel="stylesheet" type="text/css" href="showProduct.css">

<?php
session_start();
if(!isset($_SESSION['type'])){
	header('Location:login.php');
}
require("header.php");
include("../config.php");


$conn = config();
$id = $_REQUEST['varname'];
$sql = "SELECT * FROM product WHERE productID = '$id' ;";
$result = mysqli_query($conn,$sql);
$row =  mysqli_fetch_assoc($result);

// $inv = "SELECT * FROM inventory WHERE productID = '$id' ;";
// $result1 = mysqli_query($conn,$inv);
// $row1 =  mysqli_fetch_assoc($result1);
?>

<div class="col-sm-offset-1 col-sm-10" >
	<div class="col-sm-6">
		<img src="<?php
			if ($row['productPicture'] == 'ProductImage/'){
				echo '../images/preview.png';
			} else {
				echo '../'.$row['productPicture'];
				}
			?>" alt="" class="img-rounded imgtmb">
	</div>
	<div class="col-sm-6">
		<h1><strong><?php echo $row['productName'];?></strong><br><small><?php echo '&#8369; '.number_format($row['productPrice'], 2);?></small></h1>
		<br> 
  		<button type="button" class="btn btn-primary btn-lg" onclick="window.document.location.href='addToCart.php?varname=<?php echo $row["productID"]; ?> ';">Add to Cart</button>
  		<br><br>
  		<p class="lead"><?php echo $row['productDescription'];?></p>
	</div>
</div>


<script type="text/javascript">
	document.querySelector("#catalog").classList.add("active");
	<?php 
	if($_SESSION['type'] == 'user' || $_SESSION['type'] == 'admin') {
		$name = $_SESSION['name'] ;
	?>
		document.getElementById("sign").innerHTML = "Hi, <?php echo $name ?>";
		document.getElementById("cartbadge").innerHTML = "<?php echo $_SESSION['badge']?>";
	<?php
	} else {
	?> 
		document.getElementById("log").innerHTML = "</span><a href='login.php'><span class='glyphicon glyphicon-user'> Signin</a>";
	<?php
	}
	?>

</script>
<?php

require("footer.php");
?>
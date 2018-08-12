<link rel="stylesheet" type="text/css" href="cart.css">

<?php
session_start();
if(!isset($_SESSION['type'])){
	header('Location:login.php');
}
// if( $_SESSION['type'] == ''){
// 	header('Location:login.php');
// }

require("header.php");
include("../config.php");

if ($_SESSION['type'] != 'guest') {
	$order = $_SESSION['orderid'];
?>

<div class="page-header">
	<h1><strong>Your Cart</strong></h1>
</div>

<br><br>

<div class="container-fluid col-lg-offset-1 col-lg-10" style="margin-bottom: 80px;">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>Product</th>
					<th>Price</th>
					<th>Quantity</th>
					<th class="text-right">Total</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql = "SELECT orderdetails.orderID, orderdetails.productID, orderdetails.quantity, orderdetails.totalPrice, product.productName,product.productPrice, product.productPicture, product.productID
				 		FROM orderdetails 
				 		INNER JOIN product
				 		ON orderdetails.productID = product.productID
				 		WHERE orderID = '$order' 
				 		ORDER BY productName ASC; ";
						$subtotal = 0;
						$ctr = 0;
				 		$conn = config();
					if ($result = mysqli_query($conn,$sql)) {
						while ($row =  mysqli_fetch_assoc($result)){
							$tot = $row['productPrice']*$row['quantity'];
							$prodid = $row['productID'];
							$upd = "UPDATE orderdetails SET totalPrice = '$tot' WHERE productID = '$prodid' AND orderID = '$order' ";
							mysqli_query($conn,$upd);
			?>
				<tr>
					<td class="col-md-6">
						<div class="col-md-2 img">
							<img src="<?php
								if ($row['productPicture'] == 'ProductImage/'){
									echo '../images/preview.png';
								} else {
									echo '../'.$row['productPicture'];
									}
								?>" alt="" class="img-thumbnail">
						</div>
						<div class="col-md-5">
							<?php echo $row['productName']?>
						</div>
						<div class="col-md-5">
							<button type="button" class="btn btn-danger pull-right" onclick="window.document.location.href='deleteProductCart.php?varname=<?php echo $row["productID"]; ?> ';">Remove</button>
						</div>
					</td>
					<td class="col-md-2"><?php echo '&#8369; '.number_format($row['productPrice'], 2)?></td>
					<td class="col-md-2 ">
						<form method="post" action="addupdatedelete.php">
						<div class="input-group">
							<input value="<?php echo $row['productID']?>" name="id" style="display: none"> 
							<input value="<?php echo $row['productPrice']?>" name="totprice" style="display: none">
							<input type="number" name="qty" class="form-control" placeholder="Quantity" value="<?php echo $row['quantity']?>">
							<div class="input-group-btn">
							    <button type="submit" name="qtySet" class="btn btn-default">set</button>
						  	</div>
						</div>	
						</form>

					</td>
					<td class="col-md-2 text-right"><?php echo '&#8369; '.number_format($tot, 2)?></td>
				</tr>
				<?php
					$subtotal += $tot;
					$ctr += 1;
					}
				}
				$_SESSION['badge'] = $ctr ;
				?>
			</tbody>
		</table>
	</div>
</div>

<div class="col-md-offset-6 col-md-5" style="margin-bottom: 20px">
	<div class="col-md-offset-6 col-md-2">
		<h4>Subtotal</h4>
	</div>
	<div class="col-md-4">
		<h4 class="text-right"><?php echo '&#8369;'.number_format($subtotal, 2) ?></h4>
	</div>
</div>

<div class="col-md-offset-6 col-md-5" style="margin-bottom: 30px">
	<div class="col-md-offset-3 col-md-6">
		<button type="button" class="btn btn-default btn-block" onclick="window.document.location.href='catalog.php'">Back to Catalog</button>
	</div>
	<div class="col-md-3">
		<button type="button" class="btn btn-info btn-block" id="chk">Checkout</button>
	</div>
</div>


<?php 
$sub = "UPDATE orders SET subTotal = '$subtotal' WHERE orderID = '$order' ;";
$conn = config();
mysqli_query($conn,$sub);
mysqli_close($conn);

} else {
	?>

<div class="col-md-offset-4 col-md-4" style="margin-top:200px;margin-bottom: 100px;">
	<button type="button" class="btn btn-info btn-block btn-lg" onclick="window.document.location.href='login.php' ;">Sign in to Order</button>
</div>
	<?php
}
?>

<script type="text/javascript">
	document.querySelector("#cart").classList.add("active");
 	$('#chk').on('click', function () {
	<?php
	if (isset($_SESSION['badge'])) {
		if($_SESSION['badge'] >= 1 ) {
			echo 'window.document.location.href="checkout.php";';
		} else {
			echo "alert('Empty Cart!');";
		}
	}
	?>
	});

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
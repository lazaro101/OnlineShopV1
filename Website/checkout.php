<?php
session_start();
if(!isset($_SESSION['type'])){
	header('Location:login.php');
}

include("../config.php");

$order = $_SESSION['orderid'];
?>

<html>
<head>
	<title>Website</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap.css.map">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap.min.css.map">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap-theme.css.map">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap-theme.min.css.map">
	<script type="text/javascript" src="../bootstrap-3.3.7/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/assets/js/vendor/jquery.min.js"></script>

	<script type="text/javascript" src="../bootstrap-3.3.7/js/affix.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/alert.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/button.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/carousel.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/collapse.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/dropdown.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/modal.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/popover.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/scrollspy.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/tab.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/tooltip.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/transition.js"></script>
	<style type="text/css">
	.form {
		border:1px solid gray;
		padding: 50px;
	}
	.image {
		width: 60px;
		height: 30px;
	}
	</style>
</head>
<body>

<div class="page-header col-md-12">
	<div class="col-md-offset-2 col-md-5">
		<!-- <a href="home.php"><img src="Loziro logo.png"></a> -->
	</div>
	<div class="col-md-5">
		<ul class="nav nav-pills">
		  <li role="presentation"><a href="cart.php">My Cart</a></li>
		  <li role="presentation" class="active"><a href="#">Delivery and Payment</a></li>
		  <li role="presentation"><a href="#">Place Order</a></li>
		</ul>
	</div>
</div>

<div class="col-md-offset-1 col-md-5">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Payment and Delivery<span class="pull-right"><a href="addAccountShipAdd.php">+ Add new address</a></span></h3>
			
		</div>
		<div class="panel-body">
			<label class="col-sm-12">Method: Cash on Delivery</label>
			<hr width="80%" >
			<label class="title col-sm-12">Delivery Address:</label>
			<?php 
				$clientID = $_SESSION['clientID'];
				$sql = "SELECT * FROM address 
						INNER JOIN client 
						ON address.clientID = client.clientID 
						AND address.clientID = '$clientID' 
						AND address.deleted = '0'; ";
				$conn = config();	

				if ($result = mysqli_query($conn,$sql)) {
					while ($row =  mysqli_fetch_assoc($result)){

			?>
				<div class="form-group col-sm-12">
					<input type="radio" name="addid" class="col-sm-1" value="<?php echo $row['address_id'];?>">
					<span class="col-sm-5">
						<?php echo $row['addLastName'].', '.$row['addFirstName']; ?>
					</span>
					<span class="col-sm-6">
						<?php echo $row['phoneNumber']; ?>
					</span>
					<span class="col-sm-offset-1 col-sm-11">
						<?php echo $row['province'].','.$row['city'].','.$row['brgy'].'-'.$row['completeAdd'] ;?>
					</span>
				</div>
			<?php
				}
			}
			?>

	  	</div>
	</div>
</div>

<div class="col-md-5">
	<div class="panel panel-default">
		<div class="panel-heading">
	    <h3 class="panel-title">Your Order</h3>
		</div>
		<div class="panel-body">
			<div class="container-fluid col-lg-12">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$sql = "SELECT orderdetails.orderID, orderdetails.productID, orderdetails.quantity, orderdetails.totalPrice, product.productName,product.productPrice, product.productPicture
								FROM orderdetails 
								INNER JOIN product
								ON orderdetails.productID = product.productID
								WHERE orderID = '$order' 
								ORDER BY productName ASC; ";
								$subtotal = 0;
								$conn = config();
								if ($result = mysqli_query($conn,$sql)) {
								while ($row =  mysqli_fetch_assoc($result)){
						?>
							<tr>
								<td>
									<div class="col-md-4">
										<img src="<?php
										if ($row['productPicture'] == 'ProductImage/'){
										echo '../images/preview.png';
										} else {
										echo '../'.$row['productPicture'];
										}
										?>" alt="" class="img-thumbnail image">
									</div>
									<div class="col-md-8">
										<?php echo $row['productName']?>
									</div>
								</td>
								<td ><?php echo '&#8369; '.number_format($row['productPrice'], 2)?></td>
								<td class="text-center"><?php echo $row['quantity']?></td>
							</tr>
						<?php
								$subtotal += $row['totalPrice'];
									}
								}
						?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="col-md-offset-4 col-md-8">
				<div class="col-md-5">
					<strong>Product total:</strong>
				</div>
				<div class="col-md-7 text-right">
					<?php echo '&#8369;'.number_format($subtotal, 2) ?>
				</div>
				<hr width="100%">
				
				<div class="col-md-7 text-right">

				</div>
			</div>


	  </div>
	</div>

	<div class="col-md-offset-4 col-md-8">
		<button type="button" class="btn btn-primary btn-lg btn-block" onclick="return order()">Place your Order</button>
	</div>
</div>


<script type="text/javascript">
	function order(){
		var add = $('input[name="addid"]:checked').val();
		
		if (add == undefined){
			alert('Please select a delivery address!');
			return false;
		} else {
			window.document.location.href='placeOrder.php?&address='+add;
		}
	}
</script>
<?php
require("footer.php");
?>
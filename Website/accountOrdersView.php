<link rel="stylesheet" type="text/css" href=".css">

<?php
session_start();
if(!isset($_SESSION['type'])){
	header('Location:login.php');
}
include("../config.php");

$id = $_REQUEST['varname'];

// validates if there is such orderid
$sq = "SELECT * FROM orderdetails WHERE orderID = '$id' ;";
$conn = config();
$result1 = mysqli_query($conn,$sq);
if (mysqli_num_rows($result1) < 1){
	header('Location: accountOrders.php');
}

require("header.php");

// retrieval of product orders
$email = $_SESSION['email'];
$sql = "SELECT orderdetails.totalPrice, orderdetails.quantity, product.productName, product.productPrice 
		FROM orderdetails 
		INNER JOIN product 
		ON orderdetails.productID = product.productID 
		AND orderdetails.orderID = '$id' AND orderdetails.deleted = '0' ;";
$result = mysqli_query($conn,$sql);

// retrieval of order infos
$sql1 = "SELECT * FROM orders INNER JOIN address on address.address_id = orders.address_id and orders.orderID = '$id';";
$result1 = mysqli_query($conn,$sql1);
$row1 =  mysqli_fetch_assoc($result1)

?>

<div class="col-md-3">
	<div class="list-group">
	  <a class="list-group-item list-group-item-info" id="personal"><h4>My Personal</h4></a>
	  <a href="accountOrders.php" class="list-group-item" id="myorders">My Orders</a>
	  <a class="list-group-item list-group-item-info"><h4>Account Information</h4></a>
	  <a href="accountBasicInfo.php" class="list-group-item" id="binfo">Basic Information</a>
	  <a href="accountShipAdd.php" class="list-group-item" id="deladd">Delivery Address</a>
	  <a href="accountChangePass.php" class="list-group-item" id="pass">Change Password</a>
	</div>
</div>

<div class="col-md-9">
	<div class="col-md-12">
		<ol class="breadcrumb">
		  <li><a href="accountOrders.php">My Personal</a></li>
		  <li><a href="accountOrders.php">My Orders</a></li>
		  <li class="active">View Order</li>
		</ol>
	</div>
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li role="presentation" class="active"><a href="#">Sales Invoice</a></li>
		</ul>
	</div>
	<div class="col-md-12">
		<h3>Order ID:<?php echo $id ?></h3>
	</div>
	<div class="col-md-12 tbl" style="height: 40%;overflow-y: scroll;">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>Product</th>
					<th>Price</th>
					<th>Qty</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody><?<?php while($row =  mysqli_fetch_assoc($result)){	?>
				<tr>
					<td><?php echo $row['productName']; ?></td>
					<td><?php echo '&#8369; '.number_format($row['productPrice'], 2); ?></td>
					<td><?php echo $row['quantity'] ?></td>
					<td><?php echo '&#8369; '.number_format($row['totalPrice'], 2)?></td>
				</tr><?php } ?>
			</tbody>
		</table>
	</div>

	<div class="col-md-12" style="font-size: 12px;">
		<div class="col-md-6">
			<div class="panel panel-info">
			  <div class="panel-heading">
			    <h3 class="panel-title">Deliver to</h3>
			  </div>
			  <div class="panel-body">

			  	<dl class="dl-horizontal">
				  <dt>First & Last Name:</dt>
				  <dd><?php echo $row1['addFirstName'].' '.$row1['addLastName'] ?></dd>
				</dl>
				<dl class="dl-horizontal">
				  <dt>Mobile Number:</dt>
				  <dd><?php echo $row1['phone'] ?></dd>
				</dl>
			    <dl class="dl-horizontal">
				  <dt>Address</dt>
				  <dd><?php echo $row1['province'].','.$row1['city'].','.$row1['brgy'].'-'.$row1['completeAdd'] ;?></dd>
				</dl>
				<dl class="dl-horizontal">
				  <dt>Delivery Status:</dt>
				  <dd><?php 
				  		if($row1['status'] == 1) {
				  			echo 'Delivered';
				  		} elseif($row1['status'] == 0) {
				  			echo 'Processing Order';
				  		} else {
				  			echo "Cancelled";
				  		}
				  ?></dd>
				</dl> 
			  </div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-info">
			  <div class="panel-heading">
			    <h3 class="panel-title">Settlement and Method</h3>
			  </div>
			  <div class="panel-body">
			  	<dl class="dl-horizontal">
				  <dt>Amount:</dt>
				  <dd><?php echo '&#8369; '.number_format($row1['subTotal'], 2);?></dd>
				</dl>
			    <dl class="dl-horizontal">
				  <dt>Payment Method:</dt>
				  <dd>Cash on Delivery</dd>
				</dl>
			    <dl class="dl-horizontal">
				  <dt>Order Date:</dt>
				  <dd><?php echo $row1['orderDate'] ?></dd>
				</dl>
			    
			  </div>
			</div>
		</div>
	</div>

</div>

<script type="text/javascript">
	// document.querySelector("#orders").classList.add("active");
	document.getElementById("sign").innerHTML = "Hi, <?php echo $_SESSION['name']?>";
	document.getElementById("cartbadge").innerHTML = "<?php echo $_SESSION['badge']?>";
	document.getElementById("myorders").classList.add("active");
</script>

<?php

require("footer.php");


?>
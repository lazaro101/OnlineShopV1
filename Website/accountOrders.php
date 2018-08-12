<link rel="stylesheet" type="text/css" href=".css">

<?php
session_start();
if(!isset($_SESSION['type'])){
	header('Location:login.php');
}
require("header.php");
include("../config.php");

?>

<div class="col-md-3">
	<div class="list-group">
	  <a class="list-group-item list-group-item-info"><h4>My Personal</h4></a>
	  <a href="accountOrders.php" class="list-group-item active">My Orders</a>
	  <a class="list-group-item list-group-item-info"><h4>Account Information</h4></a>
	  <a href="accountBasicInfo.php" class="list-group-item">Basic Information</a>
	  <a href="accountShipAdd.php" class="list-group-item">Shipping Address</a>
	  <a href="accountChangePass.php" class="list-group-item">Change Password</a>
	</div>
</div>

<div class="col-md-9">
	<div class="col-md-12">
		<ol class="breadcrumb">
		  <li><a href="accountOrders.php">My Personal</a></li>
		  <li class="active">My Orders</li>
		</ol>
	</div>
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li role="presentation" class="active"><a href="#">All Orders</a></li>
		</ul>
	</div>

	<div class="col-md-12 tbl" style="margin-top: 50px">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>Order ID</th>
					<th>Date</th>
					<th>Total</th>
					<th>Order Status</th>
					<th>Management</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$email = $_SESSION['email'];
			$conn = config();
			$sql = "SELECT 	* FROM orders WHERE username = '$email' AND deleted = '0' AND checkout = '1' ;";
			$result = mysqli_query($conn,$sql);
			while ($row =  mysqli_fetch_assoc($result)){
			?>
				<tr>
					<td><?php echo '# '.$row['orderID']; ?></td>
					<td><?php echo $row['orderDate']; ?></td>
					<td><?php echo '&#8369; '.number_format($row['subTotal'], 2); ?></td>
					<td><?php if ($row['status'] == 0) {
								echo 'Processing Order';
							} elseif($row['status'] == 1) {
								echo 'Delivered';
							} else {
								echo 'Cancelled';
								} ;?></td>
					<td><a href="accountOrdersView.php?varname=<?php echo $row['orderID'] ;?>">View Details</a></td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>

</div>

<script type="text/javascript">
	document.querySelector("#orders").classList.add("active");
	document.getElementById("sign").innerHTML = "Hi, <?php echo $_SESSION['name']?>";
	document.getElementById("cartbadge").innerHTML = "<?php echo $_SESSION['badge']?>";
</script>

<?php

require("footer.php");


?>
<?php
session_start();
if(!isset($_SESSION['type'])){
	header('Location: website/login.php');
}
if($_SESSION['type'] == 'user'){
	header('Location: website/home.php');
}
require("header.php");
include("config.php");

$id = $_REQUEST['varname'];
$conn = config();

$val = "SELECT * FROM orders WHERE orderID = '$id' ;";
$result1 = mysqli_query($conn,$val);
if (mysqli_num_rows($result1) < 1){
	header('Location: ordersList.php');
}

$sql1 = "SELECT subtotal,status FROM orders WHERE orderID = '$id' ; ";
$result1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_assoc($result1);
?>

<div class="content">
	<FORM class="form-horizontal" method="post" action="add.php" enctype="multipart/form-data">
	<input value="<?php echo $id?>" name="id" style="display: none"> 
		<h2><a href="OrdersList.php">Orders</a> / <?php echo '# '.$id?>
		<div class="btn-group pull-right" role="group">
			<button type="reset" class="btn btn-default" onclick="location.href ='ordersList.php';">Back</button>
		</div>
		</h2>
		<br><br>
		
		<div class="col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Order Details</strong><div class="pull-right">Status: <?php if ($row1['status'] == 1) {echo "Delivered";} elseif ($row1['status'] == 0) {echo "Processing";} else {echo "Cancelled";} ?></div></div>
  				<div class="panel-body">
			  		<div class="col-sm-12">
				  		<table class="table ">
				  			<thead>
				  				<tr>
				  					<th>Product</th>
				  					<th>Price</th>
				  					<th>Quantity</th>
				  					<th>Total</th>
				  				</tr>
				  			</thead>
				  			<tbody>
				  			<?php
				  			$sql = "SELECT product.productName, product.productPrice, orderdetails.quantity, orderdetails.totalPrice 
									FROM orderdetails 
									INNER JOIN product 
									ON product.productID = orderdetails.productID
									AND orderdetails.orderID = '$id'; ";
							$result = mysqli_query($conn,$sql);
							while($row = mysqli_fetch_assoc($result)) {
							?>
				  				<tr>
				  					<td><?php echo $row['productName']?></td>
				  					<td><?php echo '&#8369; '.number_format($row['productPrice'], 2);?></td>
				  					<td><?php echo $row['quantity']?></td>
				  					<td><?php echo '&#8369; '.number_format($row['totalPrice'], 2);?></td>
				  				</tr>

				  			<?php
				  			}
				  			?>
				  			</tbody>
				  		</table>
				  	</div>
			  		<div class="col-sm-offset-6 col-sm-6">
			  			<div class="col-sm-6">
			  				Subtotal:
			  			</div>
			  			<div class="col-sm-6">
			  			<?php
							echo '&#8369; '.number_format($row1['subtotal'], 2);
			  			?>
			  			</div>
			  		</div> 

			  		<div class="col-sm-offset-8 col-sm-4" style="margin-top: 20px;">
			  			<button type="button" class="btn btn-primary" onclick="window.document.location.href='markFull.php?varname=<?php echo $id; ?>'; " <?php if ($row1['status'] == 1) {echo "disabled";} ?>>Mark as Delivered</button>
			  		</div>
			  		<div class="col-sm-offset-8 col-sm-4" style="margin-top: 20px;">
			  			<button type="button" class="btn btn-danger" onclick="window.document.location.href='cancelOrder.php?varname=<?php echo $id; ?>'; " <?php if ($row1['status'] == 1) {echo "disabled";} ?>>Cancel Order</button>
			  		</div>

		 		</div>
			</div>
		</div>

			<div class="col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading"><strong>Customer</strong></div>
	  				<div class="panel-body">
				  		<?php
			  				$sql2 = "SELECT * FROM client INNER JOIN user on user.clientID = client.clientID INNER JOIN orders ON user.username = orders.username AND orders.orderID = '$id'; ";
							$result2 = mysqli_query($conn,$sql2);
							$row2 = mysqli_fetch_assoc($result2);
							echo $row2['firstName']." ".$row2['lastName'].'<br>';
							echo $row2['phoneNumber'].'<br>';
							echo $row2['email'];
				  		?>
				  		<hr width="90%">
				  		<label>Delivery Address</label><br>
				  		<?php
			  				$sql3 = "SELECT * FROM `orders` INNER JOIN address on address.address_id = orders.address_id AND orders.orderID = '$id'; ";
							$result3 = mysqli_query($conn,$sql3);
							$row3 = mysqli_fetch_assoc($result3);
							echo $row3['addFirstName']." ".$row3['addLastName'].'<br>';
							echo $row3['phone'].'<br>';
							echo $row3['province'].','.$row3['city'].','.$row3['brgy'].'-'.$row3['completeAdd'] ;
				  		?>
					</div>
				</div>
			</div>


		</div>
	</FORM>	
</div>

<script type="text/javascript">
	document.querySelector("#orders").classList.add("active");
</script>

<?php
require("footer.php");
?>
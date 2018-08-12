<link rel="stylesheet" type="text/css" href="accountShipAdd.css">

<?php
session_start();
if(!isset($_SESSION['type'])){
	header('Location:login.php');
}
require("header.php");
include("../config.php");

	$email = $_SESSION['email'];
	$pass = $_SESSION['pass'];
	$conn = config();
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
		  <li><a href="accountBasicInfo.php">My Account</a></li>
		  <li class="active">Shipping Address</li>
		</ol>
	</div>
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li role="presentation" class="active"><a href="#">My Address List</a></li>
		</ul>
	</div>
	<div class="col-md-2 col-md-offset-9" style="margin-top: 20px">
		<button type="button" class="btn btn-default" onclick="window.document.location.href='addAccountShipAdd.php'">Add new address</button>
	</div>
	<div class="col-md-12 tbl">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>First & Last Name</th>
					<th>Mobile Number</th>
					<th>Complete Address</th>
					<th>Management</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$id = $_SESSION['clientID'];
			$sql = "SELECT 	* FROM address WHERE clientID = '$id' AND deleted = '0' ;";
			$result = mysqli_query($conn,$sql);
			while ($row =  mysqli_fetch_assoc($result)){
			?>
				<tr>
					<td><?php echo $row['addFirstName'].' '.$row['addLastName']?></td>
					<td><?php echo $row['phone']; ?></td>
					<td><?php echo $row['province'].','.$row['city'].','.$row['brgy'].'-'.$row['completeAdd'] ;?></td>
					<td><a href="editAccountShipAdd.php?varname=<?php echo $row['address_id'] ?>">Edit</a> / <a id="remove" onclick="return confirm()" href="deleteShipAdd.php?varname=<?php echo $row['address_id'] ?>">Remove</a></td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>

</div>

<!-- <div class="col-sm-6" id="alrt">
	<div class="bs-example bs-example-standalone" data-example-id="dismissible-alert-js">   
		<div class="alert alert-warning alert-dismissible fade in" role="alert" id="myAlert"> 
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button> 
			<h4>Delete Shipping Address!</h4> 
			<p>Are you sure you want to delete this address?</p> 
			<p> <button type="button" class="btn btn-danger" id="yes">Yes</button> 
				<button type="button" class="btn btn-default" class="close" data-dismiss="alert" aria-label="Close" id="myAlert">Cancel</button> </p>
		</div> 
	</div>
</div> -->

<script type="text/javascript">
	document.querySelector("#basicinfo").classList.add("active");
	document.getElementById("sign").innerHTML = "Hi, <?php echo $_SESSION['name']?>";
	document.getElementById("cartbadge").innerHTML = "<?php echo $_SESSION['badge']?>";
	document.getElementById("deladd").classList.add("active");

	
	// $('#remove').on('click', function () {
	// 	// document.getElementById('alrt').style.display = "block";
	// 	$('#myAlert').alert('open');
	
	// 	// $('#myAlert').on('close.bs.alert', function () {
 //  // 			// return false ;
	// 	// });

	// 	$('#yes').on('click', function () {
	// 		$('#remove').on('click', function () {
	// 			return true;
	// 		});
	// 	});
	// 	return false;
	// });
</script>

<?php
require("footer.php");

if (isset($_POST['saveBasicInfo'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$number = $_POST['number'];

	$conn = config() ;
	$sql = "UPDATE client SET firstName = '$fname' , lastName = '$lname' , phoneNumber = '$number' WHERE clientID = '$id' ;" ;
	mysqli_query($conn,$sql);
	mysqli_close($conn);

	echo "<meta http-equiv='refresh' content='0'>";
}
?>
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
		  <li class="active">Change Password</li>
		</ol>
	</div>
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li role="presentation" class="active"><a href="#">Change Password</a></li>
		</ul>
	</div>
	<div class="col-md-offset-2 col-md-8" style="margin-top: 50px">
		<form class="form-horizontal" method="post" action="#">

		  <div class="form-group">
		    <label class="col-sm-4 control-label">Old Password*</label>
		    <div class="col-sm-8">
		      <input type="Password" class="form-control" placeholder="">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">New Password*</label>
		    <div class="col-sm-8">
		      <input type="Password" class="form-control" placeholder="">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">Confirm New Password*</label>
		    <div class="col-sm-8">
		      <input type="Password" class="form-control" placeholder="">
		    </div>
		  </div>

		  <div class="col-md-offset-4 col-md-4">
		  	<button type="submit" class="btn btn-default btn-block" name="savePass">Submit</button>
		  </div>
  		</form>
	</div>
</div>





<script type="text/javascript">
	document.querySelector("#basicinfo").classList.add("active");
	document.getElementById("sign").innerHTML = "Hi, <?php echo $_SESSION['name']?>";
	document.getElementById("cartbadge").innerHTML = "<?php echo $_SESSION['badge']?>";
	document.getElementById("pass").classList.add("active");
</script>

<?php
require("footer.php");

if (isset($_POST['savePass'])) {
	
}
?>
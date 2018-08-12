<?php
session_start();
if(!isset($_SESSION['type'])){
	header('Location:login.php');
}
require("header.php");
include("../config.php");
?>
<script type="text/javascript" src="js/shipAdd.js"></script>


<div class="col-md-3">
	<div class="list-group">
	  <a class="list-group-item list-group-item-info"><h4>My Personal</h4></a>
	  <a href="accountOrders.php" class="list-group-item">My Orders</a>
	  <a class="list-group-item list-group-item-info"><h4>Account Information</h4></a>
	  <a href="accountBasicInfo.php" class="list-group-item">Basic Information</a>
	  <a href="accountShipAdd.php" class="list-group-item active">Shipping Address</a>
	  <a href="accountChangePass.php" class="list-group-item">Change Password</a>
	</div>
</div>


<div class="col-md-9">
	<div class="col-md-12">
		<ol class="breadcrumb">
		  <li><a href="accountBasicInfo.php">My Account</a></li>
		  <li><a href="accountShipAdd.php">Shipping Address</a></li>
		  <li class="active">Add Shipping Address</li>
		</ol>
	</div>
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li role="presentation" class="active"><a href="#">Add new address</a></li>
		</ul>
	</div>
	<div class="col-md-12">
	<div class="col-md-offset-1 col-md-10" style="margin-top: 50px;">
		<form class="form-horizontal" method="POST" action="addupdatedelete.php" name="form">
			<div class="form-group">
			    <label class="col-sm-4 control-label">First Name*</label>
			    <div class="col-sm-6" id="fname">
		      		<input type="text" class="form-control" placeholder="First Name" name="fname" onfocus="removeError(this.name)">
		    	</div>
		  	</div>
			<div class="col-sm-offset-4 col-sm-6" id="errFname">
				
			</div>
		  	<div class="form-group">
			    <label class="col-sm-4 control-label">Last Name*</label>
			    <div class="col-sm-6" id="lname">
		      		<input type="text" class="form-control" placeholder="Last Name" name="lname" onfocus="removeError(this.name)">
		    	</div>
		  	</div>
			<div class="col-sm-offset-4 col-sm-6" id="errLname">
				
			</div>
		  	<div class="form-group">
			    <label class="col-sm-4 control-label">Mobile Number*</label>
			    <div class="col-sm-6" id="number">
		      		<input type="number" class="form-control" placeholder="Number" name="number" onfocus="removeError(this.name)">
		    	</div>
		  	</div>
			<div class="col-sm-offset-4 col-sm-6" id="errNum">
				
			</div>
		  	<div class="form-group">
			    <label class="col-sm-4 control-label">Province*</label>
			    <div class="col-sm-6" id="prov">
		      		<input type="text" class="form-control" placeholder="Province" name="prov" onfocus="removeError(this.name)">
		    	</div>
		  	</div>
			<div class="col-sm-offset-4 col-sm-6" id="errProv">
				
			</div>
		  	<div class="form-group">
			    <label class="col-sm-4 control-label">City*</label>
			    <div class="col-sm-6" id="city">
		      		<input type="text" class="form-control" placeholder="City" name="city" onfocus="removeError(this.name)">
		    	</div>
		  	</div>
			<div class="col-sm-offset-4 col-sm-6" id="errCity">
				
			</div>
		  	<div class="form-group">
			    <label class="col-sm-4 control-label">Barangay*</label>
			    <div class="col-sm-6" id="brgy">
		      		<input type="text" class="form-control" placeholder="Barangay" name="brgy" onfocus="removeError(this.name)">
		    	</div>
		  	</div>
			<div class="col-sm-offset-4 col-sm-6" id="errBrgy">
				
			</div>
		  	<div class="form-group">
			    <label class="col-sm-4 control-label">Complete Address*</label>
			    <div class="col-sm-6" id="compadd">
			    	<textarea class="form-control" name="compadd" onfocus="removeError(this.name)"></textarea>
		    	</div>
		  	</div>
			<div class="col-sm-offset-4 col-sm-6" id="errComp">
				
			</div>
			<div class="col-sm-offset-4 col-sm-6" id="errAll">

			</div>
		  	<div class="col-md-offset-4 col-md-4">
			  	<button type="submit" name="saveAdd" class="btn btn-default" onclick="return validate()">Submit</button>
		  	</div>
		</form>
	</div>
</div>
</div>


<script type="text/javascript">
	document.querySelector("#basicinfo").classList.add("active");
	document.getElementById("sign").innerHTML = "Hi, <?php echo $_SESSION['name']?>";
	document.getElementById("cartbadge").innerHTML = "<?php echo $_SESSION['badge']?>";
</script>

<?php
require("footer.php");


?>
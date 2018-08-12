<link rel="stylesheet" type="text/css" href=".css">

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
	$sql = "SELECT 	*
			FROM user 
			INNER JOIN client
			on user.clientID = client.clientID and user.deleted = '0'
			WHERE username = '$email' and password ='$pass'  ;";
	$result = mysqli_query($conn,$sql);
	while ($row =  mysqli_fetch_assoc($result)){
		$fname = $row['firstName'];
		$lname = $row['lastName'];
		$number = $row['phoneNumber'];
		$id = $row['clientID'];
	}

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
		  <li class="active">Basic Information</li>
		</ol>
	</div>
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li role="presentation" class="active"><a href="#">Basic Information</a></li>
		</ul>
	</div>
	<div class="col-md-offset-2 col-md-8" style="margin-top: 50px">
		<form class="form-horizontal" method="post" action="#" name="form">
		<input name="id" value="<?php echo $id;?>" class="hidden">
		  <div class="form-group">
		    <label class="col-sm-4 control-label">Email</label>
		    <div class="col-sm-8">
		      <p class="form-control-static"><?php echo $_SESSION['email'];?></p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">First Name/Last Name*</label>
		    <div class="col-sm-4" id="fname">
		      <input type="text" class="form-control" placeholder="First Name" value="<?php echo $fname;?>" name="fname" onfocus="removeError(this.name)">
		    </div>
		    <div class="col-sm-4" id="lname">
		      <input type="text" class="form-control" placeholder="Last Name" value="<?php echo $lname;?>" name="lname" onfocus="removeError(this.name)">
		    </div>
		  </div>
		  <div class="col-sm-offset-4 col-sm-8" id="errName">
		  	
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label">Mobile Number*</label>
		    <div class="col-sm-8" id="number">
		      <input type="number" class="form-control" placeholder="Number" value="<?php echo $number;?>" name="number" onfocus="removeError(this.name)">
		    </div>
		  </div>
		  <div class="col-sm-offset-4 col-sm-8" id="errNum">
		  	
		  </div>
		  <div class="col-sm-offset-4 col-sm-8" id="errAll">
		  	
		  </div>
		  <div class="col-md-offset-4 col-md-4">
		  	<button type="submit" class="btn btn-default btn-block" name="saveBasicInfo" onclick="return validate('errAll','fname','lname','number','errName','errNum')">Submit</button>
		  </div>
  		</form>
	</div>
</div>

<script type="text/javascript">
	document.querySelector("#basicinfo").classList.add("active");
	document.getElementById("sign").innerHTML = "Hi, <?php echo $_SESSION['name']?>";
	document.getElementById("cartbadge").innerHTML = "<?php echo $_SESSION['badge']?>";
	document.getElementById("binfo").classList.add("active");


	function validate(formfield,first,last,num,name,numb){
		var ctr = 0 ;
		var err = "" ;
		document.getElementById(formfield).innerHTML = "";
		document.getElementById(name).innerHTML = "";
		document.getElementById(numb).innerHTML = "";
		var f = document.forms['form'][first].value;
		var l = document.forms['form'][last].value;
		var n = document.forms['form'][num].value;

		if (f == "" || l == "" || n == "") {
			if (f == "") {
				adderror(first);
			}
			if (l == "") {
				adderror(last);
			}
			if (n == "") {
				adderror(num);
			}
			document.getElementById(formfield).innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Field/s must be filled out!</div>';
			ctr = 1;
		}

		if (f.length > 16 || l.length > 16) {
			adderror(first);
			adderror(last);
			document.getElementById(name).innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Maximum of 16 characters!</div>';
			ctr = 1;
		}
		if (n.length > 11 || n.length < 11) {
			adderror(num);
			document.getElementById(numb).innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Enter a valid mobile number!</div>';
			ctr = 1 ;
		}
		

		if (ctr == 1) {
			return false; 
		} else {
			return true;
		}
	}

function adderror(n) {
		var x = document.querySelector("#"+n);
		x.classList.add("has-error");
		document.activeElement.blur();
}

function removeError(n) {
		var x = document.querySelector("#"+n);
		x.classList.remove("has-error");
}
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
	$_SESSION['name'] = $fname ;
	echo "<meta http-equiv='refresh' content='0'>";
}
?>
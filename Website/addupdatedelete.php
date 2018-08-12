<?php
session_start();
$order = $_SESSION["orderid"];

include("../config.php");

$conn = config() ;

if(isset($_POST['addRegister'])){
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$number = $_POST['number']; 

	$sql = "INSERT INTO client(firstName,lastName,phoneNumber,email) VALUES ('$fname','$lname','$number','$email');" ;
	mysqli_query($conn,$sql);

	$lastid = "SELECT LAST_INSERT_ID() AS id; ";
	$row =  mysqli_fetch_assoc(mysqli_query($conn,$lastid));
	$id = $row['id'];

	$user = "INSERT INTO user(username,password,clientID,userType) VALUES ('$email','$pass','$id','user');" ;
	mysqli_query($conn,$user);

	mysqli_close($conn);

	$_SESSION['type'] = 'user';
	$_SESSION['name'] = $fname;
	$_SESSION['email'] = $email;
	$_SESSION['pass'] = $pass;
	$_SESSION['clientID'] = $id;

	if($_SESSION['type']=='admin'){
			header('Location: ../productList.php');
	}
	elseif($_SESSION['type']=='user'){
			header('Location: home.php');
	}
}

if(isset($_POST['qtySet'])){
	$id = $_POST['id'];
	$qty = $_POST['qty'];
	$price = $_POST['totprice'];

	$set = "UPDATE orderdetails SET quantity = '$qty' , totalPrice = $qty * '$price'  WHERE productID = '$id' AND orderID = '$order' ; ";
	mysqli_query($conn,$set);

	mysqli_close($conn);
	header('Location: cart.php');
}

if (isset($_POST['saveAdd'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$number = $_POST['number'];
	$prov = $_POST['prov'];
	$city = $_POST['city'];
	$brgy = $_POST['brgy'];
	$compadd = $_POST['compadd'];
	$id = $_SESSION['clientID'];
	// die($fname.' '.$lname.' '.$number.' '.$prov.' '.$city.' '.$brgy.' '.$compadd.' '.$id);
	$sql = "INSERT INTO address(addFirstName,addLastName,phone,province,city,brgy,completeAdd,clientID) VALUES('$fname','$lname','$number','$prov','$city','$brgy','$compadd','$id') ;" ;
	mysqli_query($conn,$sql);
	mysqli_close($conn);

	header('Location: accountShipAdd.php');
}

if (isset($_POST['saveEditAdd'])) {
	$id = $_POST['id'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$number = $_POST['number'];
	$prov = $_POST['prov'];
	$city = $_POST['city'];
	$brgy = $_POST['brgy'];
	$compadd = $_POST['compadd'];

	$sql = "UPDATE address  SET addFirstName = '$fname', addLastName = '$lname', phone = '$number', province = '$prov', city = '$city', brgy = '$brgy', completeAdd = '$compadd' WHERE address_id = '$id' ;" ;
	mysqli_query($conn,$sql);
	mysqli_close($conn);

	header('Location: accountShipAdd.php');
}

?>

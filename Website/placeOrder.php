<?php

session_start();
include("../config.php");
$address = $_REQUEST['address'];

$order = $_SESSION['orderid'];
$date = date("Y-m-d");

$conn = config();
$sql = "UPDATE orders SET checkout = '1', orderDate = '$date', address_id = '$address' WHERE orderID = '$order' ";
mysqli_query($conn,$sql);

$sel = "SELECT * FROM orderdetails WHERE orderID = '$order' ;";
$result = mysqli_query($conn,$sel);

while($row =  mysqli_fetch_assoc($result)){
	$prod = $row['productID'];
	$quan = $row['quantity'];
	$upd = "UPDATE inventory SET quantity = quantity - '$quan' WHERE productID = '$prod' ; ";
	mysqli_query($conn,$upd);
}

mysqli_close($conn);

header('Location: home.php');

?>
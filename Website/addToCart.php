<?php
session_start();
if(!isset($_SESSION['type'])){
	header('Location:login.php');
}
include("../config.php");

$id = $_REQUEST['varname'];
$order = $_SESSION['orderid'];
$conn = config();

$prod = "SELECT productPrice FROM product WHERE productID = '$id' ;";
$result = mysqli_query($conn,$prod);
$row = mysqli_fetch_assoc($result);
$price = $row['productPrice'];

$ord = "SELECT * FROM orderdetails WHERE productID = '$id' AND orderID = '$order' ; ";
$result1 = mysqli_query($conn,$ord);
$row1 =  mysqli_fetch_assoc($result1);
if(empty($row1)){
	$sql = "INSERT INTO orderdetails(orderID,productID,quantity,totalPrice) VALUES ('$order','$id','1','$price') ; ";
} else {
	$sql = "UPDATE orderdetails SET quantity = quantity + 1 , totalPrice = totalPrice + '$price' WHERE productID = '$id' AND orderID = '$order' ;";
}

mysqli_query($conn,$sql);
mysqli_close($conn);

header('Location: cart.php');


?>

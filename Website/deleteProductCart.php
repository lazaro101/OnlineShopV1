<?php
session_start();

include("../config.php");

$id = $_REQUEST['varname'];
$order = $_SESSION['orderid'];
$conn = config();

$sql = "DELETE FROM orderdetails WHERE productID = '$id' AND orderID = '$order' ;";

mysqli_query($conn,$sql);
mysqli_close($conn);

header('Location: cart.php');


?>

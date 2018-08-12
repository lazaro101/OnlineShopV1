<?php

session_start();
include("config.php");

$id = $_REQUEST['varname'];

$conn = config();
$sql = "UPDATE orders SET status = '2' WHERE orderID = '$id' ";
mysqli_query($conn,$sql);
mysqli_close($conn);

header('Location: ordersList.php');

?>
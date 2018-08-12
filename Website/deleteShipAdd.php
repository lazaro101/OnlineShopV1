<?php
session_start();

include("../config.php");

$id = $_REQUEST['varname'];

$conn = config();

$sql = "UPDATE address SET deleted = '1' WHERE address_id = '$id' ;";

mysqli_query($conn,$sql);
mysqli_close($conn);

header('Location: accountShipAdd.php');


?>
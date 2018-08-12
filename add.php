<?php 

if ($_SESSION['type'] != 'admin') {
	header('Location: website/home.php');
} 
include("config.php");

if(isset($_POST['addProductType'])){
	$title = $_POST['titletype'];
	$conn = config() ;
	$sql = "INSERT INTO category(categoryName) VALUES ('$title');" ;
	mysqli_query($conn,$sql);
	mysqli_close($conn);
	header('Location: productTypeList.php');
}
if(isset($_POST['updateProductType'])){
	$id = $_POST['id'];
	$title = $_POST['titletype'];
	$conn = config() ;
	$sql = "UPDATE category SET categoryName = '$title' WHERE categoryID = '$id' ;" ;
	mysqli_query($conn,$sql);
	mysqli_close($conn);
	header('Location: productTypeList.php');
}
if(isset($_POST['delMultiProdType'])){
		$c = $_POST['chkbox'];
		$conn = config();
		foreach ($c as $key=>$value){
			mysqli_query($conn, "UPDATE category SET deleted = '1' WHERE categoryID = '$value';");
		}
		mysqli_close($conn);
	header('Location: productTypeList.php');
}

if(isset($_POST['delMultiVendor'])){
		$c = $_POST['chkbox'];
		$conn = config();
		foreach ($c as $key=>$value){
			mysqli_query($conn, "UPDATE vendor SET deleted = '1' WHERE vendorID = '$value' ; ");
		}
		mysqli_close($conn);
	header('Location: vendorList.php');
}
if(isset($_POST['delMultiOrder'])){
		$c = $_POST['chkbox'];
		$conn = config();
		foreach ($c as $key=>$value){
			mysqli_query($conn, "UPDATE orders SET deleted = '1' WHERE orderID = '$value' ; ");
		}
		mysqli_close($conn);
	header('Location: ordersList.php');
}
if(isset($_POST['delMultiTransfer'])){
		$c = $_POST['chkbox'];
		$conn = config();
		foreach ($c as $key=>$value){
			mysqli_query($conn, "UPDATE transfer SET deleted = '1' WHERE transferID = '$value' ; ");
		}
		mysqli_close($conn);
	header('Location: transferList.php');
}
if(isset($_POST['addProduct'])){
	$name = $_POST['title'];
	$desc = $_POST['description'];
	$type = $_POST['prodtype'];
	// $vendor = $_POST['vendor'];
	// $qty = $_POST['qty'];
	$price = $_POST['price'];
	
	$conn = config() ;
	$sql = "INSERT INTO product(productName,productDescription,productPrice,categoryID) VALUES ('$name','$desc','$price','$type');" ;
	mysqli_query($conn,$sql);

	$lastid = "SELECT LAST_INSERT_ID() AS id; ";
	$row =  mysqli_fetch_assoc(mysqli_query($conn,$lastid));
	$id = $row['id'];

	$target_dir = "ProductImage/";
	$target_file = $target_dir . basename($_FILES["fileimage"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$temp_name  = $_FILES['fileimage']['tmp_name']; 
	$imageFile = $target_dir.basename($id).'.'.$imageFileType;
	move_uploaded_file($temp_name, $imageFile); 	
	$img = "UPDATE product SET productPicture = '$imageFile' WHERE productID = '$id' ;";
	mysqli_query($conn,$img); 

	// $inv = "INSERT INTO inventory(productID,quantity) VALUES ('$id','$qty')";
	// mysqli_query($conn,$inv);

	mysqli_close($conn); 
	header('Location: productList.php');
}
if(isset($_POST['editProductList'])){
	$id = $_POST['id'];
	$name = $_POST['title'];
	$desc = $_POST['description'];
	$type = $_POST['prodtype'];
	// $qty = $_POST['qty'];
	// $vendor = $_POST['vendor'];
	$price = $_POST['price'];

	$conn = config() ;
	$product = "UPDATE product SET productName = '$name' , productDescription = '$desc' , categoryID = '$type', productPrice = '$price'  WHERE productID = '$id' ;" ;
	mysqli_query($conn,$product);

	$target_dir = "ProductImage/";
	$target_file = $target_dir . basename($_FILES["fileimage"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$temp_name  = $_FILES['fileimage']['tmp_name']; 
	$imageFile = $target_dir.basename($id).'.'.$imageFileType;
	move_uploaded_file($temp_name, $imageFile); 
	$img = "UPDATE product SET productPicture = '$imageFile' WHERE productID = '$id' ;";
	mysqli_query($conn,$img); 
	
	// $inventory = "UPDATE inventory SET quantity = '$qty' WHERE productID = '$id' ;" ;
	// mysqli_query($conn,$inventory);

	mysqli_close($conn);
	header('Location: productList.php');
}
if(isset($_POST['delMultiProd'])){
		$c = $_POST['chkbox'];
		$conn = config();
		foreach ($c as $key=>$value){
			mysqli_query($conn, "UPDATE product SET deleted = '1' WHERE productID = '$value' ; ");
		}
		mysqli_close($conn);
	header('Location: productList.php');
}
if(isset($_POST['qtyAdd'])){
	$id = $_POST['id'];
	$qty = $_POST['qty'];

	$conn = config() ;
	$set = "UPDATE inventory SET quantity = quantity + '$qty' WHERE productID = '$id' ; ";
	mysqli_query($conn,$set);

	mysqli_close($conn);
	header('Location: inventoryList.php');
}
if(isset($_POST['qtySet'])){
	$id = $_POST['id'];
	$qty = $_POST['qty'];

	$conn = config() ;
	$set = "UPDATE inventory SET quantity = '$qty' WHERE productID = '$id' ; ";
	mysqli_query($conn,$set);

	mysqli_close($conn);
	header('Location: inventoryList.php');
}
?>
<link rel="stylesheet" type="text/css" href="addProduct.css">

<?php
session_start();
if(!isset($_SESSION['type'])){
	header('Location: website/login.php');
}
if($_SESSION['type'] == 'user'){
	header('Location: website/home.php');
}
require("header.php");
include("config.php");

$id = $_REQUEST['varname'];
$conn = config();
$sql = "SELECT product.productID, product.productPicture,product.productDescription, product.productName, category.categoryID, product.productPrice
		FROM product 
		INNER JOIN category
		ON product.categoryID = category.categoryID
		WHERE product.productID = '$id'; ";
$result = mysqli_query($conn,$sql);
$row =  mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) < 1){
	header('Location: productList.php');
}

?>

<div class="content">
	<FORM class="form-horizontal" method="post" action="add.php" enctype="multipart/form-data">
	<input value="<?php echo $id?>" name="id" style="display: none"> 
		<h2><a href="productList.php">Products</a> / <?php echo $row['productName']?>
		<div class="btn-group pull-right" role="group">
			<button type="submit" class="btn btn-primary" name="editProductList">Save</button>
			<button type="reset" class="btn btn-default" onclick="location.href ='productList.php';">Cancel</button>
		</div>
		</h2>
		<br><br>
		<div class="inputs">
			<div class="col-xs-8 col-xs-offset-2">

				<div class="panel panel-default">
	  				<div class="panel-body">
				  		<div class="col-xs-12">
				  			<div class="form-group">
				  				<label>Title</label>
								<input type="text" class="form-control" placeholder="Text input" name="title" value="<?php echo $row['productName']?>">
							</div>
						</div>
				  		<div class="col-xs-12">
							<div class="form-group">
								<label>Description</label>
								<textarea class="form-control" rows="3" name="description"><?php echo $row['productDescription']?></textarea>
							</div>
						</div>

				  		<div class="col-xs-12">
							<div class="form-group">
								<label>Product Type</label>
								<select class="form-control" name="prodtype">
								<?php
									$sql1 = "SELECT * FROM category WHERE deleted = '0' ORDER BY categoryName ASC;" ;
									$conn = config();

									if ($result1 = mysqli_query($conn,$sql1)) {
										while ($row1 =  mysqli_fetch_assoc($result1)){
								?>
								  <option value="<?php echo $row1['categoryID'];?>" 
								  	<?php if($row['categoryID'] == $row1['categoryID']){
								  			echo  'selected' ;
								  		} else {
								  			echo '';
								  			}?>
								  ><?php echo $row1['categoryName'];?></option>
								<?php
										} 
									}
								?>
								</select>
							</div>	
						</div>

					</div>
				</div>

		  		<div class="panel panel-default">
					<div class="panel-heading">Image</div>
		  			<div class="panel-body">
		  				<div class="col-xs-12">
							<div class="form-group">
							    <input type="file" name="fileimage" id="fileimage">
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-default">
	  				<div class="panel-body">
						<div class="col-xs-3">
							<div class="form-group">
							    <label>Price</label>
							    <div class="input-group">
							    	<div class="input-group-addon">$</div>
							    	<input type="text" class="form-control" placeholder="Amount" name="price" value="<?php echo $row['productPrice'];?>">
							    </div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</FORM>	
</div>

<script type="text/javascript">
	document.querySelector("#product").classList.add("active");
</script>

<?php
require("footer.php");
?>
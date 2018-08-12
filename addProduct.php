<link rel="stylesheet" type="text/css" href="css/addProduct.css">

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
?>

<div class="content">
	<FORM class="form-horizontal" method="post" action="add.php" enctype="multipart/form-data">
		<h2><a href="productList.php">Products</a> / Add Product
			<div class="btn-group pull-right" role="group">
				<button type="submit" class="btn btn-primary" name="addProduct">Save</button>
				<button type="reset" class="btn btn-default" onclick="location.href ='productList.php';">Cancel</button>
			</div>
		</h2>
		<br><br>
		<div class="inputs">
			<div class="col-sm-8 col-sm-offset-2">

				<div class="panel panel-default">
	  				<div class="panel-body">
				  		<div class="col-sm-12">
				  			<div class="form-group">
				  				<label>Title</label>
								<input type="text" class="form-control" placeholder="Text input" name="title">
							</div>
						</div>
				  		<div class="col-sm-12">
							<div class="form-group">
								<label>Description</label>
								<textarea class="form-control" rows="3" name="description"></textarea>
							</div>
						</div>

				  		<div class="col-sm-12">
							<div class="form-group">
								<label>Product Type</label>
								<select class="form-control" name="prodtype">
									<option value="default">Select Type</option>
								<?php
									$sql = "SELECT * FROM category WHERE deleted = '0' ORDER BY categoryName ASC;" ;
									$conn = config();

									if ($result = mysqli_query($conn,$sql)) {
										while ($row =  mysqli_fetch_assoc($result)){
								?>
									<option value="<?php echo $row['categoryID']?>"><?php echo $row['categoryName']?></option>
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
		  				<div class="col-sm-12">
							<div class="form-group">
							    <input type="file" name="fileimage" id="fileimage">
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-default">
	  				<div class="panel-body">
						<div class="col-sm-3">
							<div class="form-group">
							    <label>Price</label>
							    <div class="input-group">
							    	<div class="input-group-addon">P</div>
							    	<input type="text" class="form-control" id="exampleInputAmount" placeholder="Amount" name="price">
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
<link rel="stylesheet" type="text/css" href="editAddProductType.css">

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
$sql = "SELECT * FROM category WHERE categoryID = '$id'; ";
$result = mysqli_query($conn,$sql);
$row =  mysqli_fetch_assoc($result);
?>

<div class="content">
	<FORM class="form-horizontal" method="post" action="add.php">
	<input value="<?php echo $id?>" name="id" style="display: none"> 
		<h2><a href="productTypeList.php">Product Type</a> / Edit Product Type
		<div class="btn-group pull-right" role="group">
			<button type="submit" class="btn btn-primary" name="updateProductType">Save</button>
			<button type="reset" class="btn btn-default" onclick="location.href ='productTypeList.php';">Cancel</button>
		</div>
		</h2>
		<br><br>
		<div class="inputs">
			<div class="col-xs-8 col-xs-offset-2">
		  		<div class="col-xs-12">
		  			<div class="form-group">
		  				<label>Title</label>
						<input type="text" class="form-control" placeholder="Text input" name="titletype" value="<?php echo $row['categoryName']?>">
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
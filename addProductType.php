<link rel="stylesheet" type="text/css" href="css/addProductType.css">

<?php
session_start();
if(!isset($_SESSION['type'])){
	header('Location: website/login.php');
}
if($_SESSION['type'] == 'user'){
	header('Location: website/home.php');
}
require("header.php");
?>

<div class="content">
	<FORM class="form-horizontal" method="post" action="add.php">
		<h2><a href="productTypeList.php">Product Type</a> / Add Product Type
			<div class="btn-group pull-right" role="group">
				<button type="submit" class="btn btn-primary" name="addProductType">Save</button>
				<button type="reset" class="btn btn-default" onclick="location.href ='productTypeList.php';">Cancel</button>
			</div>
		</h2>
		<br><br>

			<div class="col-xs-8 col-xs-offset-2">

				<div class="panel panel-default">
	  				<div class="panel-body">
				  		<div class="col-xs-12">
				  			<div class="form-group">
				  				<label>Title</label>
								<input type="text" class="form-control" placeholder="Text input" name="titletype">
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
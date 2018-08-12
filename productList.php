<link rel="stylesheet" type="text/css" href="css/productList.css">

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

<script type="text/javascript">
function toggle(lew) {
  checkboxes = document.getElementsByName('chkbox[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = lew.checked;
  }
}
function showUser() {
	se = document.getElementById('searchbox').value;
	// alert(se);
	fil = document.getElementById('filterbox').value;
	// alert(fil);
    if (se == "1") {
        document.getElementById("cont").innerHTML = "<tr><td colspan='6'>No Results Found<td></tr>";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cont").innerHTML = this.responseText;
            }
        };
        if(fil == 'all'){
        	fil = '' ;
        }
        xmlhttp.open("GET","searchProductList.php?srch="+se+"&fltr="+fil,true);
        xmlhttp.send();
    }
}
</script>

<div class="content">

	<h2>Products<button type="button" class="btn btn-primary pull-right" onclick="location.href = 'addProduct.php';">Add Product</button></h2>
	<ul class="nav nav-tabs">
  		<li role="presentation" class="active"><a href="productList.php">Product List</a></li>
		<li role="presentation"><a href="productTypeList.php">Product Type</a></li> 
	</ul><br>
	<div class="form-group col-md-12">
		<div class="form-group col-md-3">

			<label for="submit-form" class="btn btn-default">Delete</label>
			<!-- <button type="button" class="btn btn-default" for="submit-form">DELETE</button> -->
		</div>
		<div class="form-group col-md-4">
			<label class="col-md-3">Show:</label>
			<div class="col-md-8">
				<select name="filter" class="form-control" id="filterbox" onchange="showUser()">
					<option value="all">All</option>
				<?php
					$conn = config();
					$cat = "SELECT * FROM category WHERE deleted = '0' ORDER BY categoryName;";
					if ($result = mysqli_query($conn,$cat)) {
						while ($row =  mysqli_fetch_assoc($result)){
				?>
					<option value="<?php echo $row['categoryID'];?>"><?php echo $row['categoryName'];?></option>
				<?php
						}
					}
				?>
				</select>
			</div>
		</div>
		<div class="input-group col-md-5">
			<input type="text" class="form-control" placeholder="Search by Name" id="searchbox" onchange="showUser()">
			<span class="input-group-btn">
	    		<button class="btn btn-default" type="button" onclick="showUser()"><span class="glyphicon glyphicon-search"></span> Go!</button>
	  		</span>
	    </div>
    </div>
 
  	<br><br><br>

    <div class="table-container col-md-12" >
		<table class="table table-bordered table-hover">
		<thead>
			<tr class="info">
				<th class="chk">
					<div class="checkbox">
					  <label>
					    <input type="checkbox" aria-label="..." onClick="toggle(this);">
					  </label>
					</div>
				</th>
				<th class="pic">Picture</th>
				<th class="name">Name</th> 
				<th class="ctgry">Category</th> 
				<th class="price">Price</th>
			</tr>
			</thead>
			<form method="post" action="add.php" class="form-inline col-md-12">
			<tbody id="cont">
			<?php
					$sql = "SELECT product.productID,product.productPicture, product.productName, category.categoryName, product.productPrice
						FROM product 
						INNER JOIN category
						ON product.categoryID = category.categoryID
						WHERE product.deleted = 0
						ORDER BY productName ASC;" ;
				$conn = config();
				if ($result = mysqli_query($conn,$sql)) {
					while ($row =  mysqli_fetch_assoc($result)){
			?>
			<tr onclick="window.document.location.href='editProductList.php?varname=<?php echo $row["productID"]; ?> ';" style="cursor: pointer;">
				<td class="chk" onclick="if (event.stopPropagation) {event.stopPropagation;}event.cancelBubble = true;return true;">
					<div class="checkbox">
					  <label>
					    <input type="checkbox" value="<?php echo $row["productID"]; ?>" aria-label="..." name="chkbox[]">
					  </label>
					</div>
				</td>
				<td class="pic"><img class="img-thumbnail img-responsive" src="<?php 
					if ($row['productPicture'] == 'ProductImage/'){
						echo 'images/preview.png';
					} else {
						echo $row['productPicture'];
						}
						?>"></td>
				<td class="name"><?php echo $row['productName'];?></td> 
				<td class="ctgry"><?php echo $row['categoryName'];?></td> 
				<td class="price"><?php echo '&#8369; '.number_format($row['productPrice'], 2);?></td>
			</tr>
			<?php
					}
				}
			?>
		</tbody>
		</table>
		<button type="submit" class="delbtn btn btn-default hidden" name="delMultiProd" id="submit-form">DELETE</button>
		
	</div>
	</form>
</div>

<script type="text/javascript">
	document.querySelector("#product").classList.add("active");
</script>

<?php
require("footer.php");
?>
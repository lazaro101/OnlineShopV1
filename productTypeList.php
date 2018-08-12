<link rel="stylesheet" type="text/css" href="css/productTypeList.css">

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
	str = document.getElementById('searchbox').value;
    if (str == "1") {
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
        xmlhttp.open("GET","searchProductTypeList.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>

<div class="content">
	<h2>Product Type<button type="button" class="btn btn-primary pull-right" onclick="location.href = 'addProductType.php';">Add Product Type</button></h2>
	<ul class="nav nav-tabs">
  		<li role="presentation"><a href="productList.php">Product List</a></li>
		<li role="presentation" class="active"><a href="productTypeList.php">Product Type</a></li> 
	</ul><br>

	<div class="form-group col-md-12">
		<div class="form-group col-md-3">
			<label for="submit-form" class="btn btn-default">Delete</label>
		</div>
		<div class="form-group col-md-4">
			<!-- <label for="submit-form" class="btn btn-default">Delete</label> -->
		</div>
		<div class="input-group col-md-5">
			<input type="text" class="form-control" placeholder="Search by Name" id="searchbox" onchange="showUser()">
			<span class="input-group-btn">
	    		<button class="btn btn-default" type="button" onclick="showUser()"><span class="glyphicon glyphicon-search"></span> Go!</button>
	  		</span>
	    </div>
    </div>
	
			
  	<br><br><br>

    <div class="table-container col-md-12">
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
				<th>Name</th>
			</tr>
			</thead>
			<form method="post" action="add.php">
			<tbody id="cont">
			<?php
				$sql = "SELECT * FROM category WHERE deleted = '0' ORDER BY categoryName ASC;" ;
				$conn = config();
				if ($result = mysqli_query($conn,$sql)) {
					while ($row =  mysqli_fetch_assoc($result)){
		
			?>
			<tr onclick="window.document.location.href='editProductType.php?varname=<?php echo $row["categoryID"]; ?> ';">
				<td class="chk" onclick="if (event.stopPropagation) {event.stopPropagation;}event.cancelBubble = true;return true;">
					<div class="checkbox">
					  <label>
					    <input type="checkbox" aria-label="..." value="<?php echo $row["categoryID"]; ?>" name="chkbox[]">
					  </label>
					</div>
				</td>
				<td><?php echo $row['categoryName'];?></td>
			</tr>
			<?php 
					}
				}
			?>
		</tbody>
			<button type="submit" class="hidden btn btn-default" name="delMultiProdType" id="submit-form">DELETE</button>
		</table>
		</form>
	</div>
</div>

<script type="text/javascript">
	document.querySelector("#product").classList.add("active");
</script>
<?php
require("footer.php");
?>
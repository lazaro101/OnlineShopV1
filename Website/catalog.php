<?php
session_start();

if(!isset($_SESSION['type'])){
	header('Location:login.php');
}

require("header.php");
include("../config.php");
?>
<link rel="stylesheet" type="text/css" href="catalog.css">

<script type="text/javascript">
function showUser() {
	// se = document.getElementById('searchbox').value;
	// alert(se);
	fil = document.getElementById('filterbox').value;
	sort = document.getElementById('sortbox').value;

    if (fil == "") {
        document.getElementById("cont").innerHTML = "ERROR!";
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
        }
        if(fil == 'all'){
        	fil = '' ;
        }
        xmlhttp.open("GET","filterCatalog.php?&fltr="+fil+"&sort="+sort,true);
        xmlhttp.send();
    }
}
</script>

<div class="page-header">
	<h1><strong>Products</strong></h1>
</div>
<div class="page-header head col-sm-12">
	<h3>
	<div class="col-sm-offset-1 col-sm-2">
		<select class="form-control" id="filterbox" onchange="showUser()">
			<option value="all">Filter</option>
			<?php
				$sql1 = "SELECT * FROM category WHERE deleted = '0' ORDER BY categoryName ASC;" ;
				$conn = config();

				if ($result1 = mysqli_query($conn,$sql1)) {
					while ($row1 =  mysqli_fetch_assoc($result1)){
			?>
			  <option value="<?php echo $row1['categoryID'];?>"><?php echo $row1['categoryName'];?></option>
			<?php
					} 
				}
			?>
		</select>
	</div>	

	<div class="col-sm-6">
		<small><em><span id="number"></span> Products</em></small>	
	</div>

	<div class="col-sm-2">
		<select class="form-control" id="sortbox" onchange="showUser()">
			<option value="productName ASC">Sort</option>
			<option value="productName DESC">Alphabetically, Z-A</option>
			<option value="productPrice DESC">Price, High to Low</option>
			<option value="productPrice ASC">Price, Low to High</option>
		</select>
	</div>
	</h3>
</div>

<div class="col-sm-offset-1 col-sm-10">
	<div class="row" id="cont">
	<?php
		$sql = "SELECT * FROM product WHERE deleted = '0' ORDER BY productName ASC;" ;
		$conn = config();
		$ctr = 0;
		if ($result = mysqli_query($conn,$sql)) {
			while ($row =  mysqli_fetch_assoc($result)){
	?>
	<div class="col-sm-3 product">
    	<a href="showProduct.php?varname=<?php echo $row['productID'] ?>" class="thumbnail">
	      	<img src="<?php
			if ($row['productPicture'] == 'ProductImage/'){
				echo '../images/preview.png';
			} else {
				echo '../'.$row['productPicture'];
				}
			?>" alt="" class="img-thumbnail">
	      	<div class="caption">
	        	<h4><strong><?php echo $row['productName']?></strong></h4>
	        	<p><?php echo '&#8369; '.number_format($row['productPrice'], 2)?></p>
	      	</div>
 		</a>
 	</div>
    <?php 
    		$ctr += 1;
			}
		}
    ?>
	</div>
</div>



<script type="text/javascript">
	document.querySelector("#catalog").classList.add("active");
	<?php 
	if($_SESSION['type'] == 'user' || $_SESSION['type'] == 'admin') {
		$name = $_SESSION['name'] ;
	?>
		document.getElementById("sign").innerHTML = "Hi, <?php echo $name ?>";
		document.getElementById("cartbadge").innerHTML = "<?php echo $_SESSION['badge']?>";
	<?php
	} else {
	?> 
		document.getElementById("log").innerHTML = "</span><a href='login.php'><span class='glyphicon glyphicon-user'> Signin</a>";
	<?php
	}
	?>
    document.getElementById("number").innerHTML = "<?php echo $ctr?>";
   	
</script>



<?php

require("footer.php");
?>
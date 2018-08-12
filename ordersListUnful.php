<link rel="stylesheet" type="text/css" href="css/ordersList.css">

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

	<h2>Order<button type="button" class="btn btn-primary pull-right" onclick="location.href = '#';">Create Order</button></h2>
	<ul class="nav nav-tabs">
  		<li role="presentation"><a href="ordersList.php">All Orders</a></li>
  		<li role="presentation"><a href="ordersListFull.php">Delivered</a></li>
  		<li role="presentation" class="active"><a href="ordersListUnful.php">Processing</a></li>
  		<li role="presentation"><a href="ordersListCancel.php">Cancelled</a></li>
	</ul><br>
	<div class="form-group col-md-12">
		<div class="form-group col-md-3">

			<label for="submit-form" class="btn btn-default">Archive</label>
		</div>
<!-- 		<div class="form-group col-md-4">
			<label class="col-md-3">Show:</label>
			<div class="col-md-8">
				<select name="filter" class="form-control" id="filterbox" onchange="showUser()">
					<option value="all">All</option>
					<option value="full">Delivered</option>
					<option value="unfull">Processing</option>
				</select>
			</div>
		</div>
		<div class="input-group col-md-5">
			<input type="text" class="form-control" placeholder="Search for..." id="searchbox" onchange="showUser()">
			<span class="input-group-btn">
	    		<button class="btn btn-default" type="button" onclick="showUser()"><span class="glyphicon glyphicon-search"></span> Go!</button>
	  		</span>
	    </div> -->
    </div>
 
  	<br><br><br>

    <div class="table-container col-md-12" >
		<table class="table table-bordered table-hover table-condensed">
		<thead>
			<tr class="info">
				<th class="chk">
					<div class="checkbox">
					  <label>
					    <input type="checkbox" aria-label="..." onClick="toggle(this);">
					  </label>
					</div>
				</th>
				<th class="ord">Order</th>
				<th class="date">Date</th>
				<th class="cust">Customer</th>
				<th class="sta">Fullfilment Status</th>	
				<th class="total">Total</th>
			</tr>
			</thead>
			<form method="post" action="add.php" class="form-inline col-md-12">
			<tbody id="cont">
			<?php
				$sql = "SELECT orders.orderID, orders.orderDate, orders.status, orders.subTotal, client.firstName, client.lastName 
						FROM orders 
						INNER JOIN client 
						ON orders.username = client.email AND orders.deleted = '0' AND orders.checkout = '1' AND orders.status = '0'
						ORDER BY orderID ASC;" ;
				$conn = config();
				if ($result = mysqli_query($conn,$sql)) {
					while ($row =  mysqli_fetch_assoc($result)){
			?>
			<tr onclick="window.document.location.href='editOrdersList.php?varname=<?php echo $row["orderID"]; ?> ';" style="cursor: pointer;">
				<td class="chk" onclick="if (event.stopPropagation) {event.stopPropagation;}event.cancelBubble = true;return true;">
					<div class="checkbox">
					  <label>
					    <input type="checkbox" value="" aria-label="..." name="chkbox[]">
					  </label>
					</div>
				</td>
				<td class="ord"><?php echo '# '.$row['orderID'];?></td>
				<td class="date"><?php echo $row['orderDate'];?></td>
				<td class="cust"><?php echo $row['firstName'].' '.$row['lastName'];?></td>
				<td class="sta"><span class="bg-warning stat">Processing</span></td>
				<td class="total"><?php echo '&#8369; '.number_format($row['subTotal'], 2);?></td>
			</tr>
			<?php
					}
				}
			?>
		</tbody>
		</table>
		<button type="submit" class="delbtn btn btn-default hidden" name="delMultiOrder" id="submit-form">DELETE</button>
	</div>
	</form>
</div>

<script type="text/javascript">
	document.querySelector("#orders").classList.add("active");
</script>

<?php
require("footer.php");
?>
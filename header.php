<?php
if ($_SESSION['type'] != 'admin') {
	header('Location: website/home.php');
}
?>

<html>
<head>
	<title>Admin View</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/dist/css/bootstrap.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/dist/css/bootstrap.min.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/dist/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/dist/css/bootstrap-theme.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/dist/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/dist/css/bootstrap-theme.min.css.map">
	<script type="text/javascript" src="bootstrap-3.3.7/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.7/assets/js/vendor/jquery.min.js"></script>

	<script type="text/javascript" src="bootstrap-3.3.7/js/affix.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.7/js/alert.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.7/js/button.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.7/js/carousel.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.7/js/collapse.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.7/js/dropdown.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.7/js/modal.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.7/js/popover.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.7/js/scrollspy.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.7/js/tab.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.7/js/tooltip.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.7/js/transition.js"></script>
	<style type="text/css">
		body{
			background-color: white;
		}
		.sidebar{
			padding:10px;
			/*width:20%;*/
			/*border-radius:5px;*/
		}
		.sidebar li a {
			color: black;
		}
		.navbar {
			position: absolute;
			top:10%;
		}
		.content {
			width:80%;
			height:100%;
			position: absolute;
			right:0;
			padding:20px;
			padding-right:50px; 
			padding-left:50px;
		}

	</style>
	
</head>
<body>

<nav class="navbar navbar-nav">
	<div class="container-fluid">
<!-- 		<div class="navbar-collapse" style="padding: 10px;">
			<a href="#" class="brand"><img src="images/Loziro.png" width="200" height="100"></a>
		</div> -->
		

	    <div class="navbar-collapse" style="width: 200">
	    	<div class="list-group">
				<label class="title ">Dashboard</label>
				<a href="" class="list-group-item">Home</a>
				<a href="productList.php" class="list-group-item" id="product">Product</a>
				<a href="ordersList.php" class="list-group-item" id="orders">Orders</a>
				<!-- <a href="" class="list-group-item">Customers</a> -->
				<!-- <a href="reports.php" class="list-group-item">Reports</a> -->
				<a href="website/home.php" class="list-group-item">Online Store</a>
			</div>
		</div>
	</div>
</nav>


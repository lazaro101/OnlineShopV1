
<html>
<head>
	<title>Website</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap.css.map">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap.min.css.map">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap-theme.css.map">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap-theme.min.css.map">
	<script type="text/javascript" src="../bootstrap-3.3.7/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/assets/js/vendor/jquery.min.js"></script>

	<script type="text/javascript" src="../bootstrap-3.3.7/js/affix.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/alert.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/button.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/carousel.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/collapse.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/dropdown.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/modal.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/popover.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/scrollspy.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/tab.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/tooltip.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/transition.js"></script>
	<style type="text/css">
	.form {
		border:1px solid gray;
		padding: 50px;
		margin-bottom: 50px; 
	}
	</style>
</head>
<body>

<div class="page-header col-md-12">
	<div class="col-md-offset-2 col-md-7">
  		<!-- <a href="home.php"><img src="Loziro logo.png"></a> -->
	</div>
</div>

<div class="form col-md-offset-3 col-md-6">
	<form class="form-horizontal" method="post" action="addupdatedelete.php">
		<h2>Register as a New Member</h2><br>
		<div class="form-group">
			<label class="col-sm-3 control-label">Email*</label>
		    <div class="col-sm-9">
				<input type="email" class="form-control" placeholder="Email" name="email">
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-3 control-label">Password*</label>
		    <div class="col-sm-9">
				<input type="password" class="form-control" placeholder="Password" name="pass">
		    </div>
		</div>
		<br>
		<h2>Additional Information</h2><br>
		<div class="form-group">
		    <label class="col-sm-3 control-label">Name*</label>
		    <div class="col-sm-4">
				<input type="text" class="form-control" placeholder="First Name" name="fname">
		    </div>
		    <div class="col-sm-5">
				<input type="text" class="form-control" placeholder="Last Name" name="lname">
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-3 control-label">Mobile Number*</label>
		    <div class="col-sm-9">
				<input type="text" class="form-control" placeholder="09*********" name="number">
		    </div>
		</div>
		<br>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-6">
				<button type="submit" class="btn btn-success btn-lg btn-block" name="addRegister">Submit</button>
			</div>
		</div>
		<div class="col-sm-offset-7 col-sm-5">
			<a href="login.php">Have an account? Sign in</a>
		</div>
	</form>
</div>


<?php

require("footer.php");
?>
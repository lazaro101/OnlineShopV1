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
	}
	</style>
	<script type="text/javascript">
		function checkForm() {
		// Fetching values from all input fields and storing them in variables.
		var name = document.getElementById("username1").value;
		var password = document.getElementById("password1").value;
		var email = document.getElementById("email1").value;
		var website = document.getElementById("website1").value;
		//Check input Fields Should not be blanks.
		
			if (name == '' || password == '' || email == '' || website == '') {
				alert("Fill All Fields");
			} else {
			//Notifying error fields
				var username1 = document.getElementById("username");
				var password1 = document.getElementById("password");
				var email1 = document.getElementById("email");
				var website1 = document.getElementById("website");
				//Check All Values/Informations Filled by User are Valid Or Not.If All Fields Are invalid Then Generate alert.
				if (username1.innerHTML == 'Must be 3+ letters' || password1.innerHTML == 'Password too short' || email1.innerHTML == 'Invalid email' || website1.innerHTML == 'Invalid website') {
				alert("Fill Valid Information");
				} else {
					//Submit Form When All values are valid.
					document.getElementById("myForm").submit();
				}
			}
		}

		// AJAX code to check input field values when onblur event triggerd.
		function validate(field) {
			var email = document.getElementById('email').value;
			var pass = document.getElementById('pass').value;
			var xmlhttp;
			if (window.XMLHttpRequest) { // for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else { // for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
					document.getElementById(field).innerHTML = "Validating..";
				} else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById(field).innerHTML = xmlhttp.responseText;
				} else {
					document.getElementById(field).innerHTML = "Error Occurred. <a href='index.php'>Reload Or Try Again</a> the page.";
				}
			}
			xmlhttp.open("GET", "validate.php?field=" + field + "&email=" + email+"&pass="+pass, false);
			xmlhttp.send();
			return false;
		}
	</script>

</head>
<body>

<div class="page-header col-md-12">
	<div class="col-md-offset-2 col-md-7" style="height: 200">
		<!-- <a href="home.php"><img src="Loziro.png" width="600" height="200"></a> -->
	</div>
</div>

<div class="form col-md-offset-6 col-md-5">
	<form class="form-horizontal" method="post" action="validate.php">
		<div class="form-group">
			<label class="col-sm-2 control-label">Email</label>
		    <div class="col-sm-10">
		    	<input type="text" class="form-control" placeholder="Email" name="email" id="email">
		
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Password</label>
			<div class="col-sm-10">
				<input type="password" class="form-control" placeholder="Password" name="pass" id="pass">
			</div>
		</div>
		<div class="col-sm-offset-4 col-sm-8">
			<span style="color: red" id="error">
				
			</span>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
	      		<div class="checkbox">
	        	<label>
	          		<input type="checkbox"> Remember me
	        	</label>
	     		</div>
	    	</div>
	  	</div>
	  	<div class="form-group">
	    	<div class="col-sm-offset-2 col-sm-10">
	      		<button type="submit" class="btn btn-default btn-lg btn-block" name="signin" >Sign in</button>
	    	</div>
	  	</div>
	  	<div class="col-sm-offset-6 col-sm-6">
	  		<a href="register.php">Don't have an account? Signup!</a>
		</div>
	</form>
</div>


<script type="text/javascript">
	document.querySelector("#login").classList.add("active");
</script>

<!-- <?php
// session_start();
// if(empty($_SESSION['email']) == false){
// 	if($_SESSION['type']=='admin'){
// 			header('Location: ../productList.php');
// 	}
// 	elseif($_SESSION['type']=='user'){
// 			header('Location: home.php');
// 	}
// 		else{
// 		header('Location: login.php');
// 	}
// }

// require("footer.php");
?> -->
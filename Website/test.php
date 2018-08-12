<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
<script>
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
		function validate(field, query) {
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
			xmlhttp.open("GET", "validation.php?field=" + field + "&query=" + query, false);
			xmlhttp.send();
		}
</script>
</head>
<body>
<div id="mainform">
<div class="innerdiv">
<!-- Required Div Starts Here -->
<h2>Form Validation Using AJAX</h2>
<form action='#' id="myForm" method='post' name="myForm">
<h3>Fill Your Information!</h3>
<table>
<tr>
<td>Username</td>
<td><input id='username1' name='username' onblur="validate('username', this.value)" type='text'></td>
<td>
<div id='username'></div>
</td>
</tr>
<tr>
<td>Password</td>
<td><input id='password1' name='password' onblur="validate('password', this.value)" type='password'></td>
<td>
<div id='password'></div>
</td>
</tr>
<tr>
<td>Email</td>
<td><input id='email1' name='email' onblur="validate('email', this.value)" type='text'></td>
<td>
<div id='email'></div>
</td>
</tr>
<tr>
<td>website</td>
<td><input id='website1' name='website' onblur="validate('website', this.value)" type='text'></td>
<td>
<div id='website'></div>
</td>
</tr>
</table>
<input onclick="checkForm()" type='button' value='Submit'>
</form>
</div>
</body>
</html>
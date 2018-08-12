<?php
session_start();

include("../config.php");

if(isset($_POST['signin'])){
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$_SESSION['email'] = $email;
	$_SESSION['pass'] = $pass;

	$conn = config();
	$sql = "SELECT 	*
			FROM user 
			INNER JOIN client
			on user.clientID = client.clientID and user.deleted = '0'
			WHERE username = '$email' and password ='$pass'  ;";
	
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0){
		while ($row =  mysqli_fetch_assoc($result)){
			$_SESSION['type'] = $row['userType'];
			$_SESSION['name'] = $row['firstName'];
			$_SESSION['clientID'] = $row['clientID'];
		}
	} else {
	session_unset();
	session_destroy();
	header('Location: Login.php');
	}
	
	mysqli_close($conn);

	if($_SESSION['type']=='admin'){
			header('Location: ../productList.php');
	}
	elseif($_SESSION['type']=='user'){
			header('Location: home.php');
	}
}
		
		
		
?>
<?php
function config() {
		$servername = 'localhost';
		$username = 'root';
		$password = '';
		$dbname = 'online_shop';
		$conn = mysqli_connect($servername,$username,$password,$dbname);
		if(! $conn ) {
			die('Could not connect: ' . mysqli_connect_error());
		}
		return $conn ;
	}
?>
<?php
	$servername = "localhost";
	$username = "valamas";
	$password = "titok";
	$dbname = "GEO_KAP";	
	
	$conn = new mysqli($servername, $username, $password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
			mysqli_set_charset($conn,"utf8")
?>
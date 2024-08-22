<?php
		// connect to database (replace the values with your own)
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "user002";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
?>
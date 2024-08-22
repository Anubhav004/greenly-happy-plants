<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if(!isset($_SESSION['email'])) {
  // Redirect to the login
  header("Location: login.php");
  exit();
}

// Database configuration
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'user002';

// Create a new database connection
$connection = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

?>
<?php
// Retrieve the productId from the request
$productId = $_GET['productId'];

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user002";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL query
$sql = "SELECT * FROM products WHERE id = $productId";

// Execute the query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Retrieve the product details
    $product = $result->fetch_assoc();

    // Create a response array
    $response = [
        'product' => $product
    ];
} else {
    // Product not found
    $response = [
        'error' => 'Product not found'
    ];
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>

<?php
// Connect to your database (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user002";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the product ID from the AJAX request
$cartItemData = json_decode(file_get_contents('php://input'), true);
$productId = $cartItemData['productId'];

// Retrieve the available quantity from the database
$query = "SELECT quantity FROM products WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $productId);
$stmt->execute();
$result = $stmt->get_result();

$response = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $availableQuantity = $row["quantity"];

    $response["quantity"] = $availableQuantity;
} else {
    // Product not found
    $response["quantity"] = 0;
}

// Send the response as JSON
http_response_code(200);
header("Content-Type: application/json");
echo json_encode($response);

// Close the connection
$conn->close();
?>

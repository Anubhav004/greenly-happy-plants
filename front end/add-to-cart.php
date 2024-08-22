<?php
session_start();

// Check if the product ID is provided
if (!isset($_POST['productId'])) {
    die('Product ID is missing');
}

$productId = $_POST['productId'];

// Retrieve the product details from the database based on the product ID
$connection = new mysqli('localhost', 'root', '', 'user002');
if ($connection->connect_errno) {
    die('Failed to connect to the database: ' . $connection->connect_error);
}

$query = "SELECT * FROM products WHERE id = $productId";
$result = $connection->query($query);
if (!$result) {
    die('Failed to fetch product details: ' . $connection->error);
}

// Check if the product exists
if ($result->num_rows === 0) {
    die('Product not found');
}

$product = $result->fetch_assoc();
$productName = $product['name'];
$productPrice = $product['price'];
$productImage = $product['image']; // Assuming 'image' is the column name for the image path
$productQuantity = $product['quantity']; // Assuming 'quantity' is the column name for the product quantity

// Create the cart item array
$cartItem = array(
    'id' => $productId,
    'name' => $productName,
    'price' => $productPrice,
    'image' => $productImage, // Include the product image
    'quantity' => $productQuantity // Include the product quantity
);


// Check if the cart session exists and is not empty
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Check if the product is already in the cart
    $existingItem = array_search($productId, array_column($_SESSION['cart'], 'id'));

    if ($existingItem !== false) {
        // If the product is already in the cart, increment its quantity
        $_SESSION['cart'][$existingItem]['quantity']++;
    } else {
        // If the product is not in the cart, add it as a new item
        $_SESSION['cart'][] = $cartItem;
    }
} else {
    // If the cart session does not exist or is empty, create a new cart session
    $_SESSION['cart'] = array($cartItem);
}

// Return a success response
echo 'Product added to cart successfully';

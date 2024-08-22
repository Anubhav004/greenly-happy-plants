<?php

// Include the database configuration
include 'config.php';

// Check if the product ID is provided as a query parameter
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Prepare the delete query
    $query = "DELETE FROM products WHERE id = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $productId);
    $statement->execute();

    // Redirect back to the product listing page
    header('Location: all_products.php');
    exit;
} else {
    // Redirect to the product listing page if the product ID is not provided
    header('Location: all_products.php');
    exit;
}

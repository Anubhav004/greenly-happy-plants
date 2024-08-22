<?php

// Include the database configuration
include 'config.php';

// Check if the order ID is provided as a query parameter
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the updated status from the form submission
        $status = $_POST['status'];

        // Prepare the update query
        $query = "UPDATE orders SET status = ? WHERE order_id = ?";
        $statement = $connection->prepare($query);

        // Bind the parameters and execute the query
        $statement->bind_param('si', $status, $orderId);
        $statement->execute();

        // Redirect back to the view items page
        header('Location: view_items.php?order_id=' . $orderId);
        exit;
    }
} else {
    // Redirect to the appropriate page if the order ID is not provided
    header('Location: view_orders.php');
    exit;
}

<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    // Assuming you have a database connection established
    $connection = new mysqli('localhost', 'root', '', 'user002');
    if ($connection->connect_errno) {
        die('Failed to connect to the database: ' . $connection->connect_error);
    }

    // Retrieve the product ID from the query parameter
    $productId = $_GET['product_id'];

    // Prepare the SQL statement to delete the cart item
    $sql = "DELETE FROM cart WHERE product_id = ? AND user_id = (
        SELECT sno FROM users WHERE email = ? LIMIT 1
    )";

    // Prepare and bind the parameters
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('ss', $productId, $_SESSION['email']);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the previous page
        header("Location: cart.php");
        exit;
    } else {
        echo "Failed to delete the cart item: " . $stmt->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $connection->close();
} else {
    echo "User not logged in.";
}
?>

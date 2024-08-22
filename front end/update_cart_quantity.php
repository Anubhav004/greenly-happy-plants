<?php
session_start();

if (isset($_SESSION['email'])) {
    // Assuming you have a database connection established
    $connection = new mysqli('localhost', 'root', '', 'user002');
    if ($connection->connect_errno) {
        die('Failed to connect to the database: ' . $connection->connect_error);
    }

    // Get the product ID and quantity change from the AJAX request
    $productId = $_POST['product_id'];
    $quantityChange = $_POST['quantity_change'];

    // Prepare the SQL statement to fetch the available quantity of the product
    $sql = "SELECT quantity FROM products WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $productId);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a row is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $availableQuantity = $row['quantity'];

        // Get the user ID based on the email
        $sql = "SELECT sno FROM users WHERE email = ? LIMIT 1";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('s', $_SESSION['email']);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if a row is found
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userId = $row['sno'];

            // Retrieve the current quantity of the item in the cart
            $sql = "SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param('ii', $userId, $productId);

            // Execute the statement
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            // Check if a row is found
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $currentQuantity = $row['quantity'];

                // Calculate the new quantity after the change
                $newQuantity = $currentQuantity + $quantityChange;

                // Ensure the new quantity is not negative and not greater than available quantity
                $newQuantity = max($newQuantity, 1);
                $newQuantity = min($newQuantity, $availableQuantity);

                // Prepare the SQL statement to update the cart item quantity
                $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param('iii', $newQuantity, $userId, $productId);

                // Execute the statement
                $stmt->execute();

                // Check if any rows were affected
                if ($stmt->affected_rows > 0) {
                    echo "Quantity updated successfully.";
                } else {
                    echo "Failed to update quantity.";
                }
            } else {
                echo "Cart item not found.";
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "Product not found.";
    }

    // Close the statement, result, and the database connection
    $stmt->close();
    $result->close();
    $connection->close();
} else {
    echo "Please login to update the cart quantity.";
}
?>

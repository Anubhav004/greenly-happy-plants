<?php include 'header.php'; ?>

<?php

// Check if the order ID is provided in the query parameter
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    // Assuming you have a database connection established
    $connection = new mysqli('localhost', 'root', '', 'user002');
    if ($connection->connect_errno) {
        die('Failed to connect to the database: ' . $connection->connect_error);
    }

    // Fetch the order details from the database
    $sql = "SELECT * FROM orders WHERE order_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $orderId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the order is found
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        echo '<div class="order-items">';
        // Display the order details to the user
        echo '<h2>Order Confirmation</h2>';
        echo '<p>Order ID: ' . $order['order_id'] . '</p>';
        echo '<p>Name: ' . $order['name'] . '</p>';
        echo '<p>Email: ' . $order['email'] . '</p>';
        echo '<p>Phone: ' . $order['phone'] . '</p>';
        echo '<p>Address: ' . $order['address'] . '</p>';
        echo '<p>Pincode: ' . $order['pincode'] . '</p>';
        

        // Fetch the order items from the database
        $sql = "SELECT * FROM order_items WHERE order_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('i', $orderId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if order items are found
        if ($result->num_rows > 0) {
            echo '<h3>Order Items</h3>';
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Product Name</th>';
            echo '<th>Quantity</th>';
            echo '<th>Price</th>';
            echo '<th>Total Price</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($item = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $item['product_name'] . '</td>';
                echo '<td>' . $item['quantity'] . '</td>';
                echo '<td>₹' . $item['price'] . '</td>';
                echo '<td>₹' . $item['total_price'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '<p class="total-1">Total Price: ₹' . $order['total_price'] . '/-</p>';
        } else {
            echo '<p>No order items found.</p>';
        }
    } else {
        echo '<p>Order not found.</p>';
    }

    // Close the statement, result, and the database connection
    $stmt->close();
    $result->close();
    $connection->close();
} else {
    echo '<p>Invalid request.</p>';
    
}
echo '</div>';
?>

<?php include 'footer.php'; ?>
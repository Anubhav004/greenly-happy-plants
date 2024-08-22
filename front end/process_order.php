<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (isset($_SESSION['email'])) {
        // Assuming you have a database connection established
        $connection = new mysqli('localhost', 'root', '', 'user002');
        if ($connection->connect_errno) {
            die('Failed to connect to the database: ' . $connection->connect_error);
        }

        // Get the user ID based on the email
        $userEmail = $_SESSION['email'];
        $sql = "SELECT sno FROM users WHERE email = ? LIMIT 1";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('s', $userEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a row is found
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userId = $row['sno'];

            // Prepare the SQL statement to fetch cart items for the user
            $sql = "SELECT c.product_id, c.quantity, p.name, p.price
                    FROM cart c
                    INNER JOIN products p ON c.product_id = p.id
                    WHERE c.user_id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param('s', $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if cart items are found
            if ($result->num_rows > 0) {
                // Calculate the total price and create an array to store cart items
                $totalPrice = 0;
                $orderItems = array();

                // Iterate over each cart item and calculate the total price
                while ($row = $result->fetch_assoc()) {
                    $quantity = $row['quantity'];
                    $price = $row['price'];
                    $totalPrice += $quantity * $price;
                    $orderItems[] = array(
                        'product_id' => $row['product_id'],
                        'product_name' => $row['name'],
                        'quantity' => $quantity,
                        'price' => $price,
                        'total_price' => $quantity * $price
                    );
                }

                // Reduce the quantity of products in the products table
                foreach ($orderItems as $item) {
                    $productId = $item['product_id'];
                    $quantity = $item['quantity'];

                    // Update the quantity in the products table
                    $sql = "UPDATE products SET quantity = quantity - ? WHERE id = ?";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param('ii', $quantity, $productId);
                    $stmt->execute();
                }

                // Store the order details in the orders table
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $pincode = $_POST['pincode'];

                $sql = "INSERT INTO orders (user_id, name, email, phone, address, pincode, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param('issssis', $userId, $name, $email, $phone, $address, $pincode, $totalPrice);
                $stmt->execute();

                // Get the inserted order ID
                $orderId = $stmt->insert_id;

                // Store the order items in the order_items table
                $sql = "INSERT INTO order_items (order_id, product_name, quantity, price, total_price) VALUES (?, ?, ?, ?, ?)";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param('isidd', $orderId, $productName, $quantity, $price, $totalPrice);

                foreach ($orderItems as $item) {
                    $productName = $item['product_name'];
                    $quantity = $item['quantity'];
                    $price = $item['price'];
                    $totalPrice = $item['total_price'];
                    $stmt->execute();
                }

                // Clear the user's cart
                $sql = "DELETE FROM cart WHERE user_id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param('i', $userId);
                $stmt->execute();

                // Close the statement and the database connection
                $stmt->close();
                $connection->close();

                // Redirect the user to the order confirmation page
                header('Location: view_order.php?success=true');
                exit();
            } else {
                echo '<div class="msgprint">';
                echo "No items in the cart.";
                echo '</div>';
            }
        } else {
            echo '<div class="msgprint">';
            echo "User not found.";
            echo '</div>';
        }

        // Close the statement, result, and the database connection
        $stmt->close();
        $result->close();
        $connection->close();
    } else {
        echo '<div class="msgprint">';
        echo "Please login to proceed with the checkout.";
        echo '</div>';
    }
} else {
    echo '<div class="msgprint">';
    echo "Invalid request.";
    echo '</div>';
}
?>



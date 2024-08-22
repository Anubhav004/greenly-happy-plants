<?php
session_start();
include 'header.php';

// Database connection
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'user002';

// Create a new database connection
$connection = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check if the connection was successful
if ($connection->connect_errno) {
    die('Failed to connect to the database: ' . $connection->connect_error);
}

function getOrderStatusClass($status) {
    if ($status === 'Pending' || $status === 'Cancelled') {
        return 'status-pending';
    } elseif ($status === 'Shipped') {
        return 'status-shipped';
    } elseif ($status === 'Delivered') {
        return 'status-delivered';
    } else {
        return '';
    }
}

// Display the current order
if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];

    // Fetch the user ID based on the email
    $sql = "SELECT sno FROM users WHERE email = ? LIMIT 1";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('s', $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['sno'];

        // Fetch the active order details from the database based on the user ID
        $sql = "SELECT * FROM orders WHERE user_id = ? AND status IN ('Pending', 'Shipped') ORDER BY order_id DESC";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Display the current order
            echo "<h2 class='c-order'>Your Orders</h2>";
            echo "<div class='v-order-container'>";
            while ($order = $result->fetch_assoc()) {
                echo "<div class='v-order-details'>";
                echo "<h2>Current Order</h2>";
                echo "<p>Order ID: #00S0" . $order['order_id'] . "</p>";
                echo "<p>Status: <b class='" . getOrderStatusClass($order['status']) . "'>" . $order['status'] . "</b></p>";
                echo "<p>Name: " . $order['name'] . "</p>";
                echo "<p>Email: " . $order['email'] . "</p>";
                echo "<p>Phone: " . $order['phone'] . "</p>";
                echo "<p class='address'>Address: " . $order['address'] . "</p>";
                echo "<p>Pincode: " . $order['pincode'] . "</p>";
                echo "<p>Order Date: " . date('j F Y, g:i A', strtotime($order['order_date'])) . "</p>";
                echo "</div>";

                // Fetch the order items from the database
                $sql = "SELECT * FROM order_items WHERE order_id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param('i', $order['order_id']);
                $stmt->execute();
                $resultItems = $stmt->get_result();

                if ($resultItems->num_rows > 0) {
                    echo "<div class='v-order-items'>";
                    echo "<h3>Order Items</h3>";
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Product Name</th>";
                    echo "<th>Quantity</th>";
                    echo "<th>Price</th>";
                    echo "<th>Total Price</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($item = $resultItems->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $item['product_name'] . "</td>";
                        echo "<td>" . $item['quantity'] . "</td>";
                        echo "<td>₹" . $item['price'] . "</td>";
                        echo "<td>₹" . $item['total_price'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "<p class='total-1'>Grand Total: ₹" . $order['total_price'] . "/-</p>";
                    echo "</div>";
                } else {
                    echo '<div class="msgprint">';
                    echo "<p>No order items found.</p>";
                    echo '</div>';
                }
            }
            echo "</div>";
        } else {
            echo '<div class="msgprint">';
            echo "<p>No current orders found.</p>";
            echo '</div>';
        }
    } else {
        echo '<div class="msgprint">';
        echo "<p>User not found.</p>";
        echo '</div>';
    }
} else {
    echo '<div class="msgprint">';
    echo "<p>Please log in to view your current order.</p>";
    echo '</div>';
}


// Display the order history
if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];

    // Fetch the user ID based on the email
    $sql = "SELECT sno FROM users WHERE email = ? LIMIT 1";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('s', $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['sno'];

        // Fetch the order history for the user from the database based on the user ID
        $sql = "SELECT o.order_id, o.name, o.email, o.phone, o.address, o.pincode, o.total_price, o.status, o.order_date
                FROM orders o
                WHERE o.user_id = ? AND o.status IN ('Delivered', 'Cancelled')
                ORDER BY o.order_id DESC";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {          
            echo "<h2 class='o-hostory'>Order History</h2>";
            echo "<div class='v-history'>";
            while ($order = $result->fetch_assoc()) {         
                echo "<div class='v-order-history'>";
                echo "<div class='order'>";
                echo "<p>Order ID: #00S0" . $order['order_id'] . "</p>";
                echo "<p>Status: <b class='" . getOrderStatusClass($order['status']) . "'>" . $order['status'] . "</b></p>";
                echo "<p>Name: " . $order['name'] . "</p>";
                echo "<p>Email: " . $order['email'] . "</p>";
                echo "<p>Phone: " . $order['phone'] . "</p>";
                echo "<p class='address'>Address: " . $order['address'] . "</p>";
                echo "<p>Pincode: " . $order['pincode'] . "</p>";
                echo "<p>Order Date: " . date('j F Y, g:i A', strtotime($order['order_date'])) . "</p>";                
                echo "</div>";
                echo "<div class='order-items'>";
                echo "<h3>Order Items</h3>";
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Product</th>";
                echo "<th>Quantity</th>";
                echo "<th>Price</th>";
                echo "<th>Total Price</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $stmt_items = $connection->prepare("SELECT i.product_name, i.quantity, i.price, i.total_price, p.image FROM order_items i INNER JOIN products p ON i.product_name = p.name WHERE i.order_id = ?");
                $stmt_items->bind_param('i', $order['order_id']);
                $stmt_items->execute();
                $result_items = $stmt_items->get_result();
                while ($item = $result_items->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>";
                    echo "<img src='" . $item['image'] . "' alt='Product Image' width='50'>";
                    echo $item['product_name'];
                    echo "</td>";
                    echo "<td>" . $item['quantity'] . "</td>";
                    echo "<td>₹" . $item['price'] . "</td>";
                    echo "<td>₹" . $item['total_price'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "<p class='total-1'>Grand Total: ₹" . $order['total_price'] . "/-</p>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo '<div class="msgprint">';
            echo "<p>No order history found.</p>";
            echo '</div>';
        }
    } else {
        echo '<div class="msgprint">';
        echo "<p>User not found.</p>";
        echo '</div>';
    }
} else {
    echo '<div class="msgprint">';
    echo "<p>Please log in to view your order history.</p>";
    echo '</div>';
}


// Close the database connection
include 'footer.php';
?>
<?php
if (isset($_GET['success']) && $_GET['success'] === 'true') {
    echo "<script>alert('Order placed successfully. Check your order status');</script>";
}
?> 

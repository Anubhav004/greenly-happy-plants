<?php

// Include the database configuration
include 'config.php';

// Check if the order ID is provided as a query parameter
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    // Fetch the order details from the orders table
    $query = "SELECT o.name, o.email, o.phone, o.address, o.pincode, o.status, o.total_price AS grand_total
              FROM orders o
              WHERE o.order_id = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $orderId);
    $statement->execute();
    $result = $statement->get_result();
    $order = $result->fetch_assoc();

    // Fetch the order items from the order_items table
    $orderItemsQuery = "SELECT oi.quantity, p.name AS product_name, p.price AS product_price, p.image AS product_image
                        FROM order_items oi
                        INNER JOIN products p ON oi.product_name = p.name
                        WHERE oi.order_id = ?";
    $orderItemsStatement = $connection->prepare($orderItemsQuery);
    $orderItemsStatement->bind_param('i', $orderId);
    $orderItemsStatement->execute();
    $orderItemsResult = $orderItemsStatement->get_result();
    $orderItems = array();
    while ($row = $orderItemsResult->fetch_assoc()) {
        $orderItems[] = $row;
    }

    // Check if the order exists
    if (!$order) {
        die('Order not found.');
    }
} else {
    // Redirect to the appropriate page if the order ID is not provided
    header('Location: view_orders.php');
    exit;
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Code for linking CSS file -->
    <link rel="stylesheet" type="text/css" href="admin-style.css">
    <title>View Items</title>
</head>
<body>
<?php include "sidebar.php"?>
<div class="view-items-1">
    <div class="view-items">
        <div class="user-details">
            <h3>User Details</h3>
            <p><strong>Name:</strong> <?php echo $order['name']; ?></p>
            <p><strong>Email:</strong> <?php echo $order['email']; ?></p>
            <p><strong>Phone:</strong> <?php echo $order['phone']; ?></p>
            <p><strong>Address:</strong> <?php echo $order['address']; ?></p>
            <p><strong>Pincode:</strong> <?php echo $order['pincode']; ?></p>
        </div>

        <div class="order-details">
        
            <h3>Order Status</h3>
            <div class="order-status">
            <p class="<?php echo getOrderStatusClass($order['status']); ?>"><?php echo $order['status']; ?></p>
        </div>

        </div>

        <div class="cart-items">
            <h3>Cart Items</h3>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price per Item</th>
                    <th>Total Price</th>
                </tr>
                <?php foreach ($orderItems as $item) { ?>
                    <tr>
                        <td class="product-column">
                            <img src="<?php echo $item['product_image']; ?>" alt="<?php echo $item['product_name']; ?>" style="width: 100px;">
                            <?php echo $item['product_name']; ?>
                        </td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo $item['product_price']; ?></td>
                        <td><?php echo $item['quantity'] * $item['product_price']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="grand-total">
            <h3>Grand Total: </h3>
            <p><?php echo $order['grand_total']; ?>/-</p>
        </div>
        </div>
        <div class="update-status-container" <?php if ($order['status'] === 'Cancelled' || $order['status'] === 'Delivered') echo 'style="display: none;"'; ?>>
                <div class="update-status">
                    <h3>Update Status</h3>
                    <form method="POST" action="update_order_status.php?order_id=<?php echo $orderId; ?>">
                        <?php if ($order['status'] === 'Pending') { ?>
                            <select name="status">
                                <option value="Shipped" <?php if ($order['status'] === 'Shipped') echo 'selected'; ?>>Shipped</option>
                                <option value="Cancelled" <?php if ($order['status'] === 'Cancelled') echo 'selected'; ?>>Cancel</option>
                            </select>
                            <button type="submit">Update Status</button>
                        <?php } elseif ($order['status'] === 'Shipped') { ?>
                            <select name="status">
                                <option value="Delivered" <?php if ($order['status'] === 'Delivered') echo 'selected'; ?>>Delivered</option>
                                <option value="Cancelled" <?php if ($order['status'] === 'Cancelled') echo 'selected'; ?>>Cancel</option>
                            </select>
                            <button type="submit">Update Status</button>
                        <?php } ?>
                    </form>
                </div>
            </div>
    </div>
</body>
<script>
    function getOrderStatusClass($status) {
    switch ($status) {
        case 'Pending':
        case 'Cancelled':
            return 'status-pending';
        case 'Shipped':
            return 'status-shipped';
        case 'Delivered':
            return 'status-delivered';
        default:
            return '';
    }
}
</script>
</html>

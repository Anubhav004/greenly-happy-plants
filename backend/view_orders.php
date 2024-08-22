<?php

// Include the database configuration
include 'config.php';

// Fetch the orders from the database
$query = "SELECT o.order_id, o.user_id, o.name, o.email, o.phone, o.address, o.pincode, o.total_price, o.order_date, o.status, GROUP_CONCAT(p.name SEPARATOR ', ') AS items
          FROM orders o
          INNER JOIN order_items oi ON o.order_id = oi.order_id
          INNER JOIN products p ON oi.product_name = p.name
          GROUP BY o.order_id
          ORDER BY CASE
                WHEN o.status = 'Pending' THEN 1
                WHEN o.status = 'Shipped' THEN 2
                WHEN o.status = 'Delivered' THEN 3
                WHEN o.status = 'Cancelled' THEN 4
                ELSE 5
            END, o.order_date DESC";
$result = $connection->query($query);

if (!$result) {
    die('Failed to fetch orders: ' . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Code for linking CSS file -->
    <link rel="stylesheet" type="text/css" href="admin-style.css">
    <title>View Orders</title>
</head>
<body>
<?php include "sidebar.php"?>
<div class="view-orders-1">
    <div class="view-orders">
        <h2>View Orders</h2>
        <table>
    <tr>
        <th>Order ID</th>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Pincode</th>
        <th>Total Price</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>View Items</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['pincode']; ?></td>
            <td><?php echo $row['total_price']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
            <td>
                <?php
                $status = $row['status'];
                if ($status === 'Pending' || $status === 'Cancelled') {
                    echo '<span class="status-pending">' . $status . '</span>';
                } elseif ($status === 'Shipped') {
                    echo '<span class="status-shipped">' . $status . '</span>';
                } elseif ($status === 'Delivered') {
                    echo '<span class="status-delivered">' . $status . '</span>';
                } else {
                    echo $status;
                }
                ?>
            </td>
            <td><a href="view_items.php?order_id=<?php echo $row['order_id']; ?>">View Items</a></td>
        </tr>
    <?php } ?>
</table>
    </div>
    </div>
</body>
</html>

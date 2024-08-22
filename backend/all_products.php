<?php

include 'config.php';
// Fetch data from the database for products
$query = "SELECT * FROM products";
$result = $connection->query($query);

// Create an array to store the products
$products = array();

// Fetch and store each product in the array
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
?>
<?php
if (isset($_GET['success']) && $_GET['success'] === 'true') {
    echo "<script>alert('Product Updated successfully.');</script>";
}
if (isset($_GET['success']) && $_GET['success'] === 'false') {
    echo "<script>alert('Product Update Failed.');</script>";
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Code for linking css file -->
    <link rel="stylesheet" type="text/css" href="admin-style.css">
    <title>All Products</title>
</head>
<body>
<?php include "sidebar.php"?>
<!-- HTML table to display the products -->
<div class="all-product">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Categ_ID</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) { ?>
        <tr>
            <td><?php echo $product['id']; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['description']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><?php echo $product['quantity']; ?></td>
            <td><?php echo $product['category_id']; ?></td>
            <td><img src="<?php echo $product['image']; ?>" alt="Product Image"></td>
            <td class="actions">
              <a href="update.php?id=<?php echo $product['id']; ?>">Update</a>
              <a href="delete.php?id=<?php echo $product['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</div>

</body>
</html>
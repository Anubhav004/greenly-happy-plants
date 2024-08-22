<?php

// Include the database configuration
include 'config.php';

// Check if the product ID is provided as a query parameter
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the updated values from the form submission
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $categoryName = $_POST['category'];
        
        // Fetch the category ID from the category table based on the category name
        $categoryQuery = "SELECT id FROM category WHERE name = ?";
        $categoryStatement = $connection->prepare($categoryQuery);
        $categoryStatement->bind_param('s', $categoryName);
        $categoryStatement->execute();
        $categoryResult = $categoryStatement->get_result();
        $categoryRow = $categoryResult->fetch_assoc();
        $categoryId = $categoryRow['id'];

        // Check if a new image file is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $image = $_FILES['image'];
            $imagePath = '../image/' . $image['name']; // Adjust the path to your upload directory
            
            // Move the uploaded file to the destination directory
            move_uploaded_file($image['tmp_name'], $imagePath);
        } else {
            // If no new image is uploaded, retain the existing image path
            $imagePath = $product['image'];
        }

        // Prepare the update query
        $query = "UPDATE products SET name = ?, description = ?, price = ?, quantity = ?, category_id = ?";
        
        // Conditionally append the image update to the query
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $query .= ", image = ?";
        }
        
        $query .= " WHERE id = ?";
        
        $statement = $connection->prepare($query);

        // Bind the parameters and execute the query
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $statement->bind_param('ssdiisi', $name, $description, $price, $quantity, $categoryId, $imagePath, $productId);
        } else {
            $statement->bind_param('ssdiis', $name, $description, $price, $quantity, $categoryId, $productId);
        }
        $statement->execute();

        // Redirect back to the product listing page
        header('Location: all_products.php?success=true');
        exit;
    }

    // Fetch the product details for pre-populating the form
    $query = "SELECT * FROM products WHERE id = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $productId);
    $statement->execute();
    $result = $statement->get_result();
    $product = $result->fetch_assoc();

    // Fetch the categories from the category table
    $categoryQuery = "SELECT * FROM category";
    $categoryResult = $connection->query($categoryQuery);
    $categories = array();
    while ($row = $categoryResult->fetch_assoc()) {
        $categories[] = $row;
    }

} else {
    // Redirect to the product listing page if the product ID is not provided
    header('Location: all-products.php?success=false');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Code for linking css file -->
    <link rel="stylesheet" type="text/css" href="admin-style.css">
    <title>Update Product</title>
</head>
<body>
<?php include "sidebar.php"?>
    <div class="update-1">
    <div class="update-2">
    <h2>Update Product</h2>
    <form method="POST" action="update.php?id=<?php echo $productId; ?>" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>"><br>

        <label>Description:</label>
        <textarea name="description"><?php echo $product['description']; ?></textarea><br>

        <label>Price:</label>
        <input type="number" name="price" step="0.01" min="0" value="<?php echo number_format($product['price'], 2); ?>"><br>

        <label>Quantity:</label>
        <input type="number" name="quantity" min="0" value="<?php echo $product['quantity']; ?>"><br>

        <label>Category:</label>
        <select name="category">
            <?php foreach ($categories as $category) { ?>
                <option value="<?php echo $category['name']; ?>" <?php if ($category['id'] == $product['category_id']) echo 'selected'; ?>><?php echo $category['name']; ?></option>
            <?php } ?>
        </select><br>

        <label>Image:</label>
        <img src="<?php echo $product['image']; ?>" alt="Current Image"><br>
        <input type="file" name="image"><br>

        <button type="submit">Update</button>
    </form>
    </div>
    </div>
</body>
</html>

<?php

// Include the database configuration
include 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form values
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
        // Set a default image path if no image is uploaded
        $imagePath = '../image/'; // Adjust the default image path
    }

    // Prepare the insert query
    $query = "INSERT INTO products (name, description, price, quantity, category_id, image) VALUES (?, ?, ?, ?, ?, ?)";
    $statement = $connection->prepare($query);

    // Bind the parameters and execute the query
    $statement->bind_param('ssdiis', $name, $description, $price, $quantity, $categoryId, $imagePath);
    $statement->execute();

    // Redirect back to the product listing page or display success message
    header('Location: all_products.php?success=true');
    exit;
}

// Fetch the categories from the category table
$categoryQuery = "SELECT * FROM category";
$categoryResult = $connection->query($categoryQuery);
$categories = array();
while ($row = $categoryResult->fetch_assoc()) {
    $categories[] = $row;
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Code for linking CSS file -->
    <link rel="stylesheet" type="text/css" href="admin-style.css">
    <title>Create Product</title>
</head>
<body>
<?php include "sidebar.php"?>
<div class="update-1">
    <div class="update-2">
        <h2>Create Product</h2>
        <form method="POST" action="create_product.php" enctype="multipart/form-data">
            <label>Name:</label>
            <input type="text" name="name" required><br>

            <label>Description:</label>
            <textarea name="description" required></textarea><br>

            <label>Price:</label>
            <input type="number" name="price" step="0.01" min="0" required><br>

            <label>Quantity:</label>
            <input type="number" name="quantity" min="0" required><br>

            <label>Category:</label>
            <select name="category" required>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></option>
                <?php } ?>
            </select><br>

            <label>Image:</label>
            <input type="file" name="image" required><br>

            <button type="submit">Create</button>
        </form>
      </div>
    </div>
</body>
</html>

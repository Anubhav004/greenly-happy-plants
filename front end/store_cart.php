<?php
session_start();

// Retrieve the cart item data from the AJAX request
$cartItemData = json_decode(file_get_contents('php://input'), true);

// Initialize variables to store messages
$successMessage = "";
$errorMessage = "";

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];

    // Assuming you have a database connection established
    $connection = new mysqli('localhost', 'root', '', 'user002');
    if ($connection->connect_errno) {
        die('Failed to connect to the database: ' . $connection->connect_error);
    }

    // Prepare the SQL statement to fetch the user ID
    $sql = "SELECT sno FROM users WHERE email = ? LIMIT 1";

    // Prepare and bind the parameters
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('s', $userEmail);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a row is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['sno'];

        // Retrieve the available quantity from the products table
        $productQuantitySql = "SELECT quantity FROM products WHERE id = ?";
        $productQuantityStmt = $connection->prepare($productQuantitySql);
        $productQuantityStmt->bind_param('s', $cartItemData['productId']);
        $productQuantityStmt->execute();
        $productQuantityResult = $productQuantityStmt->get_result();

        if ($productQuantityResult->num_rows > 0) {
            $productQuantityRow = $productQuantityResult->fetch_assoc();
            $availableQuantity = $productQuantityRow['quantity'];

            // Check if the requested quantity exceeds the available quantity
            if ($cartItemData['productQuantity'] <= $availableQuantity) {
                // Check if the product already exists in the cart for the user
                $existingProductSql = "SELECT product_id FROM cart WHERE product_id = ? AND user_id = ? LIMIT 1";
                $existingProductStmt = $connection->prepare($existingProductSql);
                $existingProductStmt->bind_param('ss', $cartItemData['productId'], $userId);
                $existingProductStmt->execute();
                $existingProductResult = $existingProductStmt->get_result();

                if ($existingProductResult->num_rows > 0) {
                    // If the product already exists, update the quantity
                    $updateQuantitySql = "UPDATE cart SET quantity = ? WHERE product_id = ? AND user_id = ?";
                    $updateQuantityStmt = $connection->prepare($updateQuantitySql);
                    $updateQuantityStmt->bind_param('iss', $cartItemData['productQuantity'], $cartItemData['productId'], $userId);
                    if ($updateQuantityStmt->execute()) {
                        $successMessage = "This product is already in your cart, its quantity has been updated successfully!";
                        http_response_code(200);
                        echo $successMessage;
                    } else {
                        $errorMessage = "Failed to update the cart item quantity: " . $connection->error;
                        http_response_code(400);
                        echo $errorMessage;
                    }
                } else {
                    // If the product doesn't exist, check if the quantity is not zero
                    if ($cartItemData['productQuantity'] > 0) {
                        // Insert a new cart item
                        $insertCartItemSql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
                        $insertCartItemStmt = $connection->prepare($insertCartItemSql);
                        $insertCartItemStmt->bind_param('ssi', $userId, $cartItemData['productId'], $cartItemData['productQuantity']);
                        if ($insertCartItemStmt->execute()) {
                            $successMessage = "Cart item stored successfully!";
                            http_response_code(200);
                            echo $successMessage;
                        } else {
                            $errorMessage = "Failed to store the cart item: " . $connection->error;
                            http_response_code(400);
                            echo $errorMessage;
                        }
                    } else {
                        $errorMessage = "Product is out of stock!";
                        http_response_code(400);
                        echo $errorMessage;
                    }
                }
            } else {
                $errorMessage = "Insufficient product quantity!";
                http_response_code(400);
                echo $errorMessage;
            }
        } else {
            $errorMessage = "Product not found!";
            http_response_code(400);
            echo $errorMessage;
        }
    } else {
        $errorMessage = "User not found!";
        http_response_code(400);
        echo $errorMessage;
    }

    // Close the database connection
    $connection->close();
} else {
    $errorMessage = "User not logged in!";
    http_response_code(400);
    echo $errorMessage;
}
?>

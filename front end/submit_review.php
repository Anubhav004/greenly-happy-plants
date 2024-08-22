<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['email'])) {
    $_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];
    header("Location: index.php");
    exit;
}

$connection = new mysqli('localhost', 'root', '', 'user002');
if ($connection->connect_errno) {
    die('Failed to connect to the database: ' . $connection->connect_error);
}

// Get the product ID from the URL parameter or adjust as per your requirement
$productId = isset($_POST['reviewProductId']) ? $_POST['reviewProductId'] : '';

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Fetch the sno from the database based on the user's email
    $selectQuery = "SELECT sno FROM users WHERE email = ?";
    $selectStatement = $connection->prepare($selectQuery);
    $selectStatement->bind_param('s', $email);
    $selectStatement->execute();
    $selectResult = $selectStatement->get_result();

    if ($selectResult && $selectResult->num_rows > 0) {
        $row = $selectResult->fetch_assoc();
        $userId = $row['sno'];

        // Handle the review submission logic
        if (isset($_POST['title']) && isset($_POST['rating_number']) && isset($_POST['comment'])) {
            $title = $_POST['title'];
            $ratingNumber = $_POST['rating_number'];
            $comment = $_POST['comment'];

            // Prepare and execute the query to insert the review into the database
            $insertQuery = "INSERT INTO ratings (product_id, user_id, rating_number, title, comment, created)
                            VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
            $insertStatement = $connection->prepare($insertQuery);
            $insertStatement->bind_param('iiiss', $productId, $userId, $ratingNumber, $title, $comment);
            
            if ($insertStatement->execute()) {
                // Store the success message in a session variable
                $_SESSION['review_success_message'] = 'Thanks for your valuable review!';
            } else {
                // Handle the case when the review submission fails
                $_SESSION['review_error_message'] = 'Failed to submit the review: ' . $insertStatement->error;
            }

            // Close the insert statement
            $insertStatement->close();

            // Redirect back to the previous page
            header("Location: $_SERVER[HTTP_REFERER]");
            exit;
        }
    } else {
        // Handle the case when the user is not found in the database
        die('User not found in the database.');
    }
}

// Close the database connection
$connection->close();
?>

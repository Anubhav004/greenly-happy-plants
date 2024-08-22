<?php

// Include your database connection code
include 'config.php';

// Check if the blog post ID is provided
if (isset($_POST['id'])) {
    $postId = $_POST['id'];

    // Delete the blog post from the database
    $sql = "DELETE FROM blog_posts WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $postId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Display alert message using JavaScript
        echo '<script>';
        echo 'alert("Blog post deleted successfully!");';
        echo 'window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";';
        echo '</script>';
        exit;
    } else {
        echo '<script>';
        echo 'alert("Failed to delete blog post.");';
        echo 'window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";';
        echo '</script>';
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo "Invalid request.";
}

// Close the database connection
$connection->close();
?>

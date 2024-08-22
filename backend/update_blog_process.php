<?php

// Include your database connection code
include 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $postId = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    // Handle featured image update
    if ($_FILES['featured_image']['size'] > 0) {
        $featuredImage = $_FILES['featured_image']['name'];
        $featuredImageTmp = $_FILES['featured_image']['tmp_name'];
        $featuredImagePath = '../image/' . $featuredImage; // Specify the directory where you want to store the uploaded images

        // Move the uploaded file to the desired location
        move_uploaded_file($featuredImageTmp, $featuredImagePath);

        // Update the blog post with the new featured image path
        $sql = "UPDATE blog_posts SET title = ?, content = ?, author = ?, featured_image = ? WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssi", $title, $content, $author, $featuredImagePath, $postId);
    } else {
        // Update the blog post without changing the featured image
        $sql = "UPDATE blog_posts SET title = ?, content = ?, author = ? WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssi", $title, $content, $author, $postId);
    }

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Redirect to the previous page with alert message
        echo '<script>';
        echo 'alert("Blog post updated successfully!");';
        echo 'window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";';
        echo '</script>';
        exit;
    } else {
        echo '<script>';
        echo 'alert("Failed to update blog post.");';
        echo 'window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";';
        echo '</script>';
    }
}

// Close the prepared statement
$stmt->close();

// Close the database connection
$connection->close();
?>

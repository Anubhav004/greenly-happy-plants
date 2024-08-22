<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create Blog Post</title>
    <!-- Include CKEditor files -->
    <script src="../ckeditor/ckeditor.js"></script>
    <!-- Code for linking CSS file -->
    <link rel="stylesheet" type="text/css" href="admin-style.css">
</head>
<body>
<?php include "sidebar.php"?>
<?php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include your database connection code
    include 'config.php';

    // Retrieve form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $date = date('Y-m-d H:i:s');

    // Handle featured image upload
    $featuredImage = $_FILES['featured_image']['name'];
    $featuredImageTmp = $_FILES['featured_image']['tmp_name'];
    $featuredImagePath = '../image/' . $featuredImage; // Specify the directory where you want to store the uploaded images

    // Move the uploaded file to the desired location
    move_uploaded_file($featuredImageTmp, $featuredImagePath);

    // Prepare and execute the SQL query
    $sql = "INSERT INTO blog_posts (title, content, author, date, featured_image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssss", $title, $content, $author, $date, $featuredImagePath);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Close the database connection
        $stmt->close();
        $connection->close();
        
        // Display success message and redirect to view_blog.php
        echo '<script>alert("Blog post created successfully!"); window.location.href = "view_blog.php";</script>';
        exit;
    } else {
        echo '<div class="error-message">Failed to create blog post.</div>';
    }

    // Close the database connection
    $stmt->close();
    $connection->close();
}
?>
    <div class="create-blog-1">
    <div class="create-blog">
    <h2>Create Blog Post</h2>
    <form method="POST" action="create_blog.php" enctype="multipart/form-data">
        <label for="featured_image">Featured Image:</label>
        <input type="file" name="featured_image" required><br><br>

        <label for="title">Title:</label>
        <input type="text" name="title" required><br><br>

        <label for="author">Author:</label>
        <input type="text" name="author" required><br><br>

        <label for="content">Content:</label>
        <textarea name="content" id="editor" required></textarea><br><br>
     
        <button type="submit">Create Blog Post</button>
        <script>
            CKEDITOR.replace( 'content', {
             height: 300,
             filebrowserUploadUrl: "upload.php"
            });
        </script>
    </form>
    </div>
    </div>
    <!-- Initialize CKEditor -->
    

</body>
</html>

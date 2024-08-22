<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Update Blog Post</title>
    <!-- Include CKEditor files -->
    <script src="../ckeditor/ckeditor.js"></script>
</head>
<body>
<?php include "sidebar.php"?>
    <?php
    
    // Include your database connection code
    include 'config.php';

    // Check if the blog post ID is provided in the URL
    if (isset($_GET['id'])) {
        $postId = $_GET['id'];

        // Retrieve the blog post from the database
        $sql = "SELECT * FROM blog_posts WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $title = $row['title'];
            $content = $row['content'];
            $author = $row['author'];
            $featuredImage = $row['featured_image'];
        
            // Display the blog post form
            echo '<div class="create-blog-1">';
            echo '<div class="create-blog">';
            echo '<h2>Update Blog Post</h2>';
            echo '<form method="POST" action="update_blog_process.php" enctype="multipart/form-data">';
            echo '<input type="hidden" name="id" value="' . $postId . '">';
        
            echo '<label for="featured_image">Featured Image:</label>';
            echo '<input type="file" name="featured_image"><br><br>';
        
            echo '<label for="title">Title:</label>';
            echo '<input type="text" name="title" value="' . $title . '"><br><br>';
        
            echo '<label for="author">Author:</label>';
            echo '<input type="text" name="author" value="' . $author . '"><br><br>';
        
            echo '<label for="content">Content:</label>';
            echo '<textarea name="content" id="editor">' . $content . '</textarea><br><br>';
        
            echo '<button type="submit">Update Blog Post</button>';
            echo '</form>';
        
            // Initialize CKEditor with file upload support
            echo '<script>CKEDITOR.replace("editor", { filebrowserUploadUrl: "upload.php" });</script>';
        } else {
            echo '<div class="error-message">Blog post not found.</div>';
        }        

        // Close the prepared statement
        $stmt->close();
    } else {
        echo '<div class="error-message">Invalid request.</div>';
    }
    echo '</div>';
    echo '</div>';
    // Close the database connection
    $connection->close();
    ?>
</body>
</html>

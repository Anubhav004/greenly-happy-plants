<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Blog Posts</title>
</head>
<body>
<?php include "sidebar.php"?>
    <?php
    
    // Include your database connection code
    include 'config.php';

    // Retrieve blog posts from the database
    $sql = "SELECT * FROM blog_posts";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="view-blog-1">';
        echo '<a class="c-blog" href="create_blog.php">Create Blog Post</a>';
        echo '<div class="view-blog">';
        echo '<table>';
        echo '<tr>';
        echo '<th>SNo.</th>';
        echo '<th>Title</th>';
        echo '<th>Author</th>';
        echo '<th>Date</th>';
        echo '<th>F-Image</th>';
        echo '<th>Actions</th>';
        echo '</tr>';

        $serialNo = 1; // Initialize the serial number

        while ($row = $result->fetch_assoc()) {
            $postId = $row['id'];
            $title = $row['title'];
            $author = $row['author'];
            $date = $row['date'];
            $featuredImage = $row['featured_image'];

            // Output the blog post row
            echo '<tr>';
            echo '<td>' . $serialNo . '</td>';
            echo '<td>' . $title . '</td>';
            echo '<td>' . $author . '</td>';
            echo '<td>' . date('j M Y, h:i A', strtotime($date)) . '</td>';
            echo '<td><img src="' . $featuredImage . '" alt="Featured Image" class="featured-image"></td>';
            echo '<td>';
            echo '<a href="update_blog.php?id=' . $postId . '">Update</a>';
            echo '<form method="POST" action="delete_blog.php">';
            echo '<input type="hidden" name="id" value="' . $postId . '">';
            echo '<button type="submit">Delete</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';

            $serialNo++; // Increment the serial number
        }

        echo '</table>';
    } else {
        echo '<div class="no-posts">No blog posts found.</div>';
        echo '<a class="c-blog" href="create_blog.php">Create Blog Post</a>';
    }
    echo '</div>';
    echo '</div>';
    // Close the database connection
    $connection->close();
    ?>
</body>
</html>

<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="blog-cover-image">
    <div class="blog-container">
        <h1>Blog</h1>
        <p>"A Delightful Blog for Nature Lovers"</p>
    </div>
    </div>
    <div class="blog-container-1">
<?php
// Database connection
$connection = new mysqli('localhost', 'root', '', 'user002');

// Check if the connection was successful
if ($connection->connect_errno) {
    die('Failed to connect to the database: ' . $connection->connect_error);
}

// Fetch blog post data from the database
function getBlogPosts($connection) {
    // Database query to retrieve blog posts
    // Modify the query based on your database schema
    $query = "SELECT id, title, content, author, date, featured_image FROM blog_posts";
    
    // Execute the query and fetch the results
    $result = $connection->query($query);
    
    // Check if the query was successful
    if ($result) {
        // Fetch the blog post data
        $blogPosts = array();
        while ($row = $result->fetch_assoc()) {
            $blogPosts[] = $row;
        }
        return $blogPosts;
    } else {
        die('Failed to fetch blog posts: ' . $connection->error);
    }
}

// Get the blog post data
$blogPosts = getBlogPosts($connection);

// Calculate the number of columns
$totalPosts = count($blogPosts);
$postsPerRow = 3;
$numColumns = ceil($totalPosts / $postsPerRow);

echo '<div class="post-head">';
echo '<h1>Gardening Basics</h1>';
echo '</div>';
echo '<div class="blog-page">';

// Loop through the columns
for ($col = 0; $col < $numColumns; $col++) {
    echo '<div class="column">';
    
    // Loop through the posts in the current column
    for ($i = $col * $postsPerRow; $i < ($col * $postsPerRow) + $postsPerRow; $i++) {
        if ($i < $totalPosts) {
            $post = $blogPosts[$i];
            $postId = $post['id'];
            $title = $post['title'];
            $content = $post['content'];
            $author = $post['author'];
            $date = $post['date']; 
            $featuredImage = $post['featured_image'];
            
            // Display the blog post information
            echo '<div class="blog-post">';
            echo '<div class="blog-image">';
            echo '<img src="' . $featuredImage . '" alt="Featured Image">';
            echo '</div>';
            echo '<h2><a class="post-title" href="full-post.php?id=' . $postId . '">' . $title . '</a></h2>';
            echo '<p class="post-author">By: ' . $author . '</p>';
            echo '<p class="post-date">' . date('F j, Y', strtotime($date)) . '</p>';
            echo '<div class="post-content">' . substr($content, 0, 238) . ' ...</div>';
            echo '<a class="read-more" href="full-post.php?id=' . $postId . '">Read More</a>';
            echo '</div>';
        }
    }
    
    echo '</div>';
}

echo '</div>';

// Close the database connection
$connection->close();
?>
</div>
</body>
</html>
<?php include 'footer.php'; ?>

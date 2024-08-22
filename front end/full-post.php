<?php include 'header.php'; ?>
<?php
// Establish a database connection
$connection = new mysqli('localhost', 'root', '', 'user002');
if ($connection->connect_errno) {
    die('Failed to connect to the database: ' . $connection->connect_error);
}

// Get the post ID from the query string
if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    // Fetch the blog post data from the database based on the post ID
    function getBlogPost($connection, $postId) {
        // Database query to retrieve a single blog post
        $query = "SELECT id, title, content, author, date, featured_image FROM blog_posts WHERE id = $postId";

        // Execute the query and fetch the result
        $result = $connection->query($query);

        // Check if the query was successful
        if ($result && $result->num_rows > 0) {
            // Fetch the blog post data
            $post = $result->fetch_assoc();
            return $post;
        } else {
            die('Blog post not found.');
        }
    }

    // Get the blog post data
    $blogPost = getBlogPost($connection, $postId);

    // Display the blog post content
    if ($blogPost) {
        $title = $blogPost['title'];
        $content = $blogPost['content'];
        $author = $blogPost['author'];
        $date = $blogPost['date'];
        $featuredImage = $blogPost['featured_image'];

        // Display the full blog post
        echo '<div class="featured-image-1">';
        echo '<img src="' . $featuredImage . '" alt="Featured Image">';
        echo '</div>';
        echo '<div class="full-post">';
        echo '<h2 class="post-title">' . $title . '</h2>';
        echo '<p class="post-author">By: ' . $author . '</p>';
        echo '<p class="post-date">' . date('F j, Y', strtotime($date)) . '</p>';
        echo '<div class="post-content">' . $content . '</div>';
    } else {
        echo 'Blog post not found.';
    }
} else {
    echo 'Invalid post ID.';
}
echo '</div>';
// Close the database connection
$connection->close();
?>

<?php include 'footer.php'; ?>
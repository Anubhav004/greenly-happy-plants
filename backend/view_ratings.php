<?php
// Include the database configuration
include 'config.php';

// Retrieve the product ID from the search field
if (isset($_GET['search'])) {
    $productId = $_GET['search'];
} else {
    $productId = '';
}

// Fetch the ratings for the given product ID from the database
$query = "SELECT * FROM ratings WHERE product_id = ?";
$statement = $connection->prepare($query);
$statement->bind_param('s', $productId);
$statement->execute();
$result = $statement->get_result();
$ratings = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Code for linking CSS file -->
    <link rel="stylesheet" type="text/css" href="admin-style.css">
    <title>View Ratings</title>
</head>
<body>
<?php include "sidebar.php"?>
<div class="view-rating-1">
    <div class="view-rating">
<h2>View Reviews</h2>
    <div class="form-container">
        <form method="GET" action="view_ratings.php">
            <input type="text" name="search" placeholder="Enter Product ID" value="<?php echo $productId; ?>">
            <button type="submit">Search</button>
        </form>
    </div>
    <h3>Ratings for Product ID: <?php echo $productId; ?></h3>
    <?php if (count($ratings) > 0) { ?>
        <div class="table-container">
            <table>
                <tr>
                    <th>Rating ID</th>
                    <th>User ID</th>
                    <th>Rating Number</th>
                    <th>Title</th>
                    <th>Comment</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($ratings as $rating) { ?>
                    <tr>
                        <td><?php echo $rating['rating_id']; ?></td>
                        <td><?php echo $rating['user_id']; ?></td>
                        <td><?php echo $rating['rating_number']; ?></td>
                        <td><?php echo $rating['title']; ?></td>
                        <td><?php echo $rating['comment']; ?></td>
                        <td><?php echo $rating['created']; ?></td>
                        <td>
                            <form class="delete-form" method="POST" action="delete_rating.php">
                                <input type="hidden" name="rating_id" value="<?php echo $rating['rating_id']; ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php } else { ?>
        <p>No reviews found.</p>
    <?php } ?>
    </div>
    </div>
</body>

</html>

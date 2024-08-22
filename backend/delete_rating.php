<?php

// Include the database configuration
include 'config.php';

// Retrieve the rating ID from the URL query parameter
if (isset($_POST['rating_id'])) {
    $ratingId = $_POST['rating_id'];
} else {
    die('Rating ID not provided.');
}

// Delete the rating from the database
$query = "DELETE FROM ratings WHERE rating_id = ?";
$statement = $connection->prepare($query);
$statement->bind_param('i', $ratingId);
$statement->execute();

// Redirect back to the view_ratings.php page
header('Location: view_ratings.php?product_id=' . $_GET['product_id']);
exit;
?>

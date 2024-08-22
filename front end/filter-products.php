<?php
$connection = new mysqli('localhost', 'root', '', 'user002');
if ($connection->connect_errno) {
    die('Failed to connect to the database: ' . $connection->connect_error);
}

// Get the filter values
$minPrice = isset($_POST['minPrice']) ? $_POST['minPrice'] : '';
$maxPrice = isset($_POST['maxPrice']) ? $_POST['maxPrice'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$rating = isset($_POST['rating']) ? $_POST['rating'] : '';

// Prepare the SQL query with the dynamic filters
$query = "SELECT p.*, AVG(r.rating_number) AS average_rating
          FROM products p
          LEFT JOIN ratings r ON p.id = r.product_id
          LEFT JOIN category c ON p.category_id = c.id
          WHERE 1=1";

// Add the filter conditions
if ($minPrice && $maxPrice) {
    $query .= " AND p.price BETWEEN $minPrice AND $maxPrice";
}

if ($category) {
    // Modify the query to handle multiple categories
    $categoryArray = is_array($category) ? $category : array($category);
    $categoryString = "'" . implode("', '", $categoryArray) . "'";
    $query .= " AND c.name IN ($categoryString)";
}

$query .= " GROUP BY p.id";

// Filter by average rating using HAVING clause
if ($rating) {
    $ratingFloor = floor($rating); // Lower bound of the rating range
    $ratingCeil = ceil($rating); // Upper bound of the rating range

    if ($ratingFloor == $ratingCeil) {
        // Single rating value
        $query .= " HAVING FLOOR(average_rating) = $ratingFloor";
    } else {
        // Rating range
        $query .= " HAVING FLOOR(average_rating) >= $ratingFloor AND FLOOR(average_rating) < $ratingCeil";
    }
}

// Execute the query
$result = $connection->query($query);
if (!$result) {
    die('Failed to fetch products: ' . $connection->error);
}

// Generate the HTML markup for the filtered products
$output = '';
while ($row = $result->fetch_assoc()) {
    $productId = $row['id'];
    $productName = $row['name'];
    $productImage = $row['image'];
    $productPrice = $row['price'];
    $averageRating = $row['average_rating'];

    $output .= '<div class="product">';
    $output .= '<img src="' . $productImage . '" alt="' . $productName . '">';
    $output .= '<h3>' . $productName . '</h3>';
    $output .= '<div class="rating">';

    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $averageRating) {
            $output .= '<span class="star filled">&#9733;</span>';
        } elseif ($i - $averageRating < 1) {
            $output .= '<span class="star half-filled">&#9733;</span>';
        } else {
            $output .= '<span class="star">&#9734;</span>';
        }
    }
    $output .= '<span class="average-rating-value">' . round($averageRating, 1) . '</span>';
    $output .= '</div>';
    $output .= '<span class="price">₹' . $productPrice . '</span>';
    $output .= '<a href="view-product.php?id=' . $productId . '" class="view-order-button">View Product</a>';
    $output .= '</div>';
}

$connection->close();

if ($output === '') {
    // No products found
    echo '<div class="product-not-found">Sorry, no products found.</div>';
} else {
    // Display the filtered products
    echo $output;
}

?>

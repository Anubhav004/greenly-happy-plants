<?php
$connection = new mysqli('localhost', 'root', '', 'user002');
if ($connection->connect_errno) {
    die('Failed to connect to the database: ' . $connection->connect_error);
}

// Fetch categories from the database
$query = "SELECT c.name FROM products p
          INNER JOIN category c ON p.category_id = c.id
          GROUP BY c.name";
$result = $connection->query($query);
if (!$result) {
    die('Failed to fetch categories: ' . $connection->error);
}

// Loop through the fetched categories and generate the HTML markup
$options = '<option value="">All</option>';
while ($row = $result->fetch_assoc()) {
    $category = $row['name'];
    $options .= '<option value="' . $category . '">' . $category . '</option>';
}

$connection->close();

echo $options; // Return the generated options for the category filter
?>

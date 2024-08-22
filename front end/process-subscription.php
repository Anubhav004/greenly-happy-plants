<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted email
    $email = $_POST["email"];

    // Validate the email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "invalid";
    } else {
        // Replace with your database connection code
        // Assuming you have a database connection established
    $connection = new mysqli('localhost', 'root', '', 'user002');
    if ($connection->connect_errno) {
        die('Failed to connect to the database: ' . $connection->connect_error);
    }

        // Prepare and execute a SQL query to insert the email
        $sql = "INSERT INTO subscribers (email) VALUES ('$email')";

        if ($connection->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "error";
        }

        // Close the database connection
        $connection->close();
    }
} else {
    echo "invalid";
}
?>

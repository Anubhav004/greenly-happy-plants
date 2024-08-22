<?php
session_start();

if(!isset($_SESSION['email'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
  }

// Check if the contact ID was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["contact_id"])) {
    // Retrieve the contact ID from the form submission
    $contact_id = $_POST["contact_id"];

    // Connect to the database (replace the values with your own)
    $db_connection = mysqli_connect("localhost", "root", "", "user002");

    // Check if the connection was successful
    if (!$db_connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete the contact from the database
    $query = "DELETE FROM contacts WHERE id = '$contact_id'";
    $result = mysqli_query($db_connection, $query);

    // Check if the deletion was successful
    if ($result) {
        // Redirect back to the view contacts page
        header("Location: view_contacts.php");
        exit();
    } else {
        echo "Error deleting contact: " . mysqli_error($db_connection);
    }

    // Close the database connection
    mysqli_close($db_connection);
} else {
    // If the contact ID was not provided, redirect back to the view contacts page
    header("Location: view_contacts.php");
    exit();
}
?>

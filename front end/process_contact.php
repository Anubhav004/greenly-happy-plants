<?php
// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Validate form data
    $errors = array();

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $errors[] = "Phone number is invalid. Please enter a 10-digit phone number without spaces or special characters.";
    }    

    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    // If no errors, save the contact data to the database
    if (count($errors) == 0) {
        // Connect to the database (replace the values with your own)
        $db_connection = mysqli_connect("localhost", "root", "", "user002");

        // Check if the connection was successful
        if (!$db_connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare the SQL query to insert the contact data into the table
        $query = "INSERT INTO contacts (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

        // Execute the query
        if (mysqli_query($db_connection, $query)) {
            // Contact data saved successfully
            mysqli_close($db_connection);
            header("Location: contact.php?success=1");
            exit();
        } else {
            // Error occurred while saving the contact data
            echo "Error: " . mysqli_error($db_connection);
        }

        // Close the database connection
        mysqli_close($db_connection);
    } else {
        // Redirect back to the contact form with errors
        header("Location: contact.php?errors=" . urlencode(implode(",", $errors)));
        exit();
    }
} else {
    // Redirect back to the contact form if accessed directly without form submission
    header("Location: contact.php");
    exit();
}
?>

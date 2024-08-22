<?php
// Connect to the database (replace the values with your own)
$db_connection = mysqli_connect("localhost", "root", "", "user002");

// Check if the connection was successful
if (!$db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all contacts from the database
$query = "SELECT * FROM contacts";
$result = mysqli_query($db_connection, $query);

// Check if any contacts exist
if (mysqli_num_rows($result) > 0) {
    $contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $contacts = array();
}

// Close the database connection
mysqli_close($db_connection);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Contacts</title>
</head>
<body>
<?php include "sidebar.php"?>
<div class="v-contact">
    <h1>View Contacts</h1>
    <?php if (!empty($contacts)) : ?>
        <table>
            <tr>
                <th>Sno.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php 
            $serialNumber = 1;
            foreach ($contacts as $contact) : ?>
                <tr>
                    <td><?php echo $serialNumber++; ?></td>
                    <td><?php echo $contact['name']; ?></td>
                    <td><?php echo $contact['email']; ?></td>
                    <td><?php echo $contact['phone']; ?></td>
                    <td><?php echo $contact['message']; ?></td>
                    <td><?php echo date('j M, Y, g:i A', strtotime($contact['created_at'])); ?></td>
                    <td>
                        <form action="delete_contact.php" method="POST">
                            <input type="hidden" name="contact_id" value="<?php echo $contact['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No contacts found.</p>
    <?php endif; ?>
    </div>
</body>
</html>

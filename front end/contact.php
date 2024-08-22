<?php include 'header.php'; 

// Check if there are any success or error messages
if (isset($_GET['success'])) {
    $success_message = "Thank you for contacting us! We will get back to you soon.";
} elseif (isset($_GET['errors'])) {
    $error_messages = explode(",", $_GET['errors']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
</head>
<body>
    <div class="cover-image">
    <div class="container-2">
        <h1>Contact Us</h1>
        <p>Questions? Comments? Let your <br> customers get in touch with you by filling <br> out the email form below.</p>
    </div>
    </div>
    <div class="container-1">
        <div class="contact-form">
        <?php if (isset($success_message)) : ?>
            <div class="success-message">
                <p><?php echo $success_message; ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($error_messages)) : ?>
            <div class="error-messages">
                <?php foreach ($error_messages as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
            <h2>Contact Form</h2>
            <form action="process_contact.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Info@example.com" required>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" placeholder="+1234567890" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" placeholder="Write Message" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
        <div class="contact-details">
            <h2>Contact Details</h2>
            <h3>Name:</h3>
            <p>Greenly Agritech Pvt Ltd</p>

            <h3>Address:</h3>
            <p>Greenly, 03-111, Third floor, WeWork Eleven West,<br> Pancard Club Road, Baner, Pune 411045,<br> Telephone : +91-91-74945-301</p>
        
            <h3>Email:</h3>
            <p>sanisah4444@gmail.com</p>
        
            <h3>Phone:</h3>
            <p>+91-91-74945-301</p>
        
            <h3>Follow Us:</h3>
            <p>Feel Free To Follow Us On Our Social Media.</p>
            <div class="social-media-icons">
                <a href="https://www.facebook.com/don3sani?mibextid=ZbWKwL" class="fa fa-facebook" target="_blank"></a>
                <a href="https://twitter.com/Anubhav07662068?t=n0617CghxMusxrETsINp-Q&s=08" class="fa fa-twitter" target="_blank"></a>
                <a href="https://instagram.com/experience_bolte?igshid=NGExMmI2YTkyZg==" class="fa fa-instagram" target="_blank"></a>
                <a href="https://www.linkedin.com/in/anubhav-shah-2643941b4" class="fa fa-linkedin" target="_blank"></a>
            </div>
        </div>

    </div>
</body>
</html>
<?php include 'footer.php'; ?>
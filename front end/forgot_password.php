<?php
session_start();

// check if user is already logged in, redirect to login page
if (isset($_SESSION["email"])) {
    header("location: index.php");
    exit;
}

// check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrieve form data
    $email = $_POST['email'];
    $hobby = $_POST['hobby'];

    // validate form data
    $errors = array();

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($hobby)) {
        $errors[] = "Hobby is required.";
    }

    // if no errors, proceed with password retrieval
    if (count($errors) == 0) {
        // connect to database (replace the values with your own)
        include 'config.php';

        // check if email and hobby match
        $sql = "SELECT * FROM users WHERE email='$email' AND hobby='$hobby'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // email and hobby match, retrieve the user's password and email
            $user = mysqli_fetch_assoc($result);
            $password = $user['pasword'];

            // display the user's password
            $success_msg = "Your password is: $password";
        } else {
            // email or hobby do not match
            $errors[] = "Email and hobby do not match.";
        }

        // close database connection
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <title>Forgot Password</title>
</head>
<body>

<!-- New header section -->
<header class="new-header">
    <div class="social-media">
        <a href="#" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-twitter"></a>
        <a href="#" class="fa fa-instagram"></a>
        <a href="#" class="fa fa-youtube-play"></a>
    </div>
    <div class="text">
        <h4>"Boost Your Well-being with Indoor Greenery, Explore Our Plant Sale."</h4>
    </div>
</header>

<div class="container">
    <?php
    // display errors
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<center><h3>$error</h3></center>";
        }
        echo "</ul>";
    }

    // display success message
    if (isset($success_msg)) {
        echo "<center><h3>$success_msg</h3></center>";
    }
    ?>
    <h1>Forgot Password</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
        <label for="hobby">Hobby:</label>
        <input type="text" id="hobby" name="hobby" placeholder="Enter your hobby" required>
        <input type="submit" value="Retrieve Password" class="btn">
        <p>Remember your password? <a href="index.php">Login here</a>.</p>
    </form>
</div>
</body>
</html>

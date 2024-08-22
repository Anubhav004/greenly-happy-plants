<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user input values
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Assuming the validation is successful, perform password change
    $changePasswordResult = changePassword($_SESSION['email'], $currentPassword, $newPassword, $confirmPassword);
    if ($changePasswordResult === true) {
        // Password change successful
        $successMessage = "Password changed successfully.";
    } else {
        // Password change failed, display an error message
        $errorMessage = $changePasswordResult;
    }
}

// Function to change the user's password
function changePassword($email, $currentPassword, $newPassword, $confirmPassword) {
    // Connect to your MySQL database (replace with your own credentials)
    include 'config.php';

    // Escape the user input to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);
    $currentPassword = mysqli_real_escape_string($conn, $currentPassword);
    $newPassword = mysqli_real_escape_string($conn, $newPassword);
    $confirmPassword = mysqli_real_escape_string($conn, $confirmPassword);

    // Query the database to check if the user exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User found, verify the current password
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['pasword'];

        if ($currentPassword === $storedPassword) {
            // Current password is correct, check if the new password and confirm password match
            if ($newPassword === $confirmPassword) {
                // Update the password in the database
                $updateSql = "UPDATE users SET pasword='$newPassword' WHERE email='$email'";
                if (mysqli_query($conn, $updateSql)) {
                    mysqli_close($conn);
                    return true;
                } else {
                    mysqli_close($conn);
                    return "Error updating password.";
                }
            } else {
                mysqli_close($conn);
                return "New password and confirm password do not match.";
            }
        } else {
            mysqli_close($conn);
            return "Current password is incorrect.";
        }
    }

    // User not found or email incorrect
    mysqli_close($conn);
    return "Wrong Email.";
}
?>

<?php include 'header.php'; ?>
<div class="container">
    <div class="cpass">
    <h1>Change Password</h1>

    <?php if (isset($successMessage)) { ?>
        <p style="color: green; text-align: center; font-size: 14px; font-weight: bold;"><?php echo $successMessage; ?></p>
    <?php } ?>

    <?php if (isset($errorMessage)) { ?>
        <p style="color: red; text-align: center; font-size: 14px; font-weight: bold;"><?php echo $errorMessage; ?></p>
    <?php } ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="current_password">Current Password:</label>
        <input type="password" name="current_password" id="current_password" required><br>

        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" id="new_password" required><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required><br>

        <input type="submit" value="Change Password">
    </form>
    </div>
    </div>
    <?php include 'footer.php'; ?>
<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

include 'config.php';

// Retrieve user data from the database
$email = $_SESSION['email'];
$selectUserDataSql = "SELECT * FROM users WHERE email = '$email'";
$selectUserDataResult = mysqli_query($conn, $selectUserDataSql);

if ($selectUserDataResult && mysqli_num_rows($selectUserDataResult) > 0) {
    $userData = mysqli_fetch_assoc($selectUserDataResult);
} else {
    // Handle error if user data retrieval fails
    $errorMessage = "Error retrieving user data.";
}

// Initialize variables for error and success messages
$errorMessage = "";
$successMessage = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user input values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $birth = $_POST['birth'];

    // Perform validation on the inputs (you can customize this based on your requirements)
    if (validateInputs($name, $email, $gender, $birth)) {
        // Assuming validation is successful, update the user's profile
        $updateResult = updateProfile($_SESSION['email'], $name, $email, $gender, $birth);
        if ($updateResult === true) {
            // Check if the email is changed
            if ($email !== $_SESSION['email']) {
                // Email is changed, log out the user and redirect to the login page
                session_unset();
                session_destroy();
                header("Location: index.php");
                exit;
            } else {
                // Update the user data
                $userData['name'] = $name;
                $userData['email'] = $email;
                $userData['gender'] = $gender;
                $userData['birth'] = $birth;

                // Retrieve the updated profile image path if available
                if (!empty($imagePath)) {
                    $userData['profile_image'] = $imagePath;
                }

                $successMessage = "Profile updated successfully.";
            }
        } else {
            // Profile update failed, display an error message
            $errorMessage = $updateResult;
        }
    } else {
        // Validation failed, display an error message
        $errorMessage = "Invalid input values.";
    }
}
// Function to validate the input values
function validateInputs($name, $email, $gender, $birth) {
    if (!empty($name) && !empty($email) && !empty($gender) && !empty($birth)) {
        return true;
    } else {
        return false;
    }
}

// Function to update the user's profile
function updateProfile($currentEmail, $name, $newEmail, $gender, $birth) {
    // Connect to your MySQL database (replace with your own credentials)
    include 'config.php';

    // Escape the user input to prevent SQL injection
    $currentEmail = mysqli_real_escape_string($conn, $currentEmail);
    $name = mysqli_real_escape_string($conn, $name);
    $newEmail = mysqli_real_escape_string($conn, $newEmail);
    $gender = mysqli_real_escape_string($conn, $gender);
    $birth = mysqli_real_escape_string($conn, $birth);

    // Handle profile image upload
    $profileImage = $_FILES['profile_image'];
    $imageFileName = $profileImage['name'];
    $imageTmpName = $profileImage['tmp_name'];

    // Declare the $imagePath variable
    $imagePath = "";

    // Check if a new profile image is uploaded
    if (!empty($imageFileName)) {
        // Define the directory to save the uploaded images
        $uploadDirectory = '../uploads/';

        // Generate a unique filename for the uploaded image
        $imagePath = $uploadDirectory . uniqid() . '_' . $imageFileName;

        // Move the uploaded image to the desired directory
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            // Query the database to update the user's profile with the new image path
            $updateSql = "UPDATE users SET name='$name', email='$newEmail', gender='$gender', birth='$birth', profile_image='$imagePath' WHERE email='$currentEmail'";

            if (mysqli_query($conn, $updateSql)) {
                mysqli_close($conn);
                return true;
            } else {
                mysqli_close($conn);
                return "Error updating profile.";
            }
        } else {
            return "Error uploading image.";
        }
    } else {
        // Query the database to update the user's profile without changing the image path
        $updateSql = "UPDATE users SET name='$name', email='$newEmail', gender='$gender', birth='$birth' WHERE email='$currentEmail'";

        if (mysqli_query($conn, $updateSql)) {
            mysqli_close($conn);
            return true;
        } else {
            mysqli_close($conn);
            return "Error updating profile.";
        }
    }
}
?>

<?php include 'header.php'; ?>
<div class="edit-profile">
    <div class="profile-image">
        <!-- Display profile image here -->
        <?php
        // Retrieve the user's current profile image path from the database
        include 'config.php';
        $email = $_SESSION['email'];
        $selectImageSql = "SELECT profile_image FROM users WHERE email = '$email'";
        $selectImageResult = mysqli_query($conn, $selectImageSql);
        if ($selectImageResult && mysqli_num_rows($selectImageResult) > 0) {
            $row = mysqli_fetch_assoc($selectImageResult);
            $currentImagePath = $row['profile_image'];
            if (!empty($currentImagePath) && file_exists($currentImagePath)) {
                ?>
                <img src="<?php echo $currentImagePath . '?v=' . time(); ?>" alt="Profile Image">
            <?php } else { ?>
                <img src="../image/avtar.png" alt="Default Avatar">
            <?php }
        } else { ?>
            <img src="../image/avtar.png" alt="Default Avatar">
        <?php } ?>

    </div>

    <div class="edit">
    <?php if (isset($errorMessage)): ?>
            <p style="color: red; font-size: 14px; font-weight: bold;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <?php if (isset($successMessage)): ?>
            <p style="color: green; font-size: 14px; font-weight: bold;"><?php echo $successMessage; ?></p>
        <?php endif; ?>
        <h1>Edit Profile</h1>

        <form method="POST" enctype="multipart/form-data">
            <!-- Edit fields here -->
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo isset($userData['name']) ? $userData['name'] : ''; ?>" required><br><br>

            <label for="email">Email:</label>
            <p style="color: red; font-weight: bold; font-size: 12px;">Note: If you change your email, you will need to log in again.</p>
            <input type="email" id="email" name="email" value="<?php echo isset($userData['email']) ? $userData['email'] : ''; ?>" required><br><br>


            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="">Select</option>
                <option value="male" <?php echo (isset($userData['gender']) && $userData['gender'] === 'male') ?    'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo (isset($userData['gender']) && $userData['gender'] === 'female') ? 'selected' : ''; ?>>Female</option>
                <option value="other" <?php echo (isset($userData['gender']) && $userData['gender'] === 'other') ?  'selected' : ''; ?>>Other</option>
            </select><br><br>


            <label for="birth">Birthdate:</label>
            <input type="date" id="birth" name="birth" value="<?php echo isset($userData['birth']) ? $userData['birth'] : ''; ?>" required><br><br>

            <label for="profile_image">Profile Image:</label>
            <input type="file" id="profile_image" name="profile_image"><br><br>

            <input type="submit" value="Save">
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>

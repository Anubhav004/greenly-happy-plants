<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

include 'header.php';

// Database connection 
$host = 'localhost';
$dbName = 'user002';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);

    // Enable PDO error reporting
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Assuming you have already established a database connection
    $query = "SELECT gender, birth, name FROM users WHERE email = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':user_id', $_SESSION['email']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Store the retrieved values in session variables
    if ($result) {
        $_SESSION['gender'] = $result['gender'];
        $_SESSION['birth'] = $result['birth'];
        $_SESSION['name'] = $result['name'];
    } else {
        $_SESSION['gender'] = 'N/A';
        $_SESSION['birth'] = 'N/A';
        $_SESSION['name'] = 'N/A';
    }
} catch (PDOException $e) {
    // Handle database connection errors
    die("Database connection failed: " . $e->getMessage());
}
?>

<!-- HTML section of the profile page -->
<div class="container">
<div class="profile">
    <div class="user-profile">
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
                  <img src="<?php echo $currentImagePath . '?v=' . time(); ?>" alt="Profile Image" class="profile-image">
              <?php } else { ?>
                  <img src="../image/avtar.png" alt="Default Avatar" class="profile-image">
              <?php }
          } else { ?>
              <img src="../image/avtar.png" alt="Default Avatar" class="profile-image">
          <?php } ?>
        <p class="profile-name"><?php echo $_SESSION['name']; ?></p>
        <p class="profile-email"><?php echo $_SESSION['email']; ?></p>
        <a href="editprofile.php" class="edit-profile-link"><i class="fa fa-pencil"></i> Edit Profile</a>
    </div>

    <div class="user-details">
        <h3>Profile Details</h3>
        <p><strong>Your Name:</strong> <?php echo $_SESSION['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
        
        <p><strong>Gender:</strong> <?php echo isset($_SESSION['gender']) ? $_SESSION['gender'] : 'N/A'; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo isset($_SESSION['birth']) ? $_SESSION['birth'] : 'N/A'; ?></p>
        <!-- Add more user details here -->
        <p class="cpassword">If you want to change your password, <a href="cpassword.php">click here</a>.</p>
    </div>
</div>
</div>

<?php include 'footer.php'; ?>

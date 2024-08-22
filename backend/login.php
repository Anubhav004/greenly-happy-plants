<?php
session_start();

if(isset($_SESSION['email'])) {
  // Redirect to admin dashboard if admin is already logged in
  header("Location: admin.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate user inputs
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  if(empty($email) || empty($password)) {
    $error_msg = "Email and password are required.";
  } else {
    // Connect to database and check if email exists
    $db_connection = mysqli_connect("localhost", "root", "", "user002");
    $email = mysqli_real_escape_string($db_connection, $email);
    $query = "SELECT * FROM admins WHERE email = '$email'";
    $result = mysqli_query($db_connection, $query);

    if(mysqli_num_rows($result) == 1) {
      // Email exists, check if password is correct
      $user = mysqli_fetch_assoc($result);
      if($password == $user['password']) {
        // Password is correct, store admin ID in session variable
        $_SESSION['email'] = $user['email'];

        // Redirect to admin dashboard
        header("Location: admin.php");
        exit();
      } else {
        // Password is incorrect
        $error_msg = "Invalid password.";
      }
    } else {
      // Email does not exist
      $error_msg = "Email does not exist.";
    }
  }
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link rel="stylesheet" href="admin-style.css">
</head>
<body>
  <div class="a-login">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <?php if(isset($error_msg)): ?>
    <p><?php echo $error_msg; ?></p>
  <?php endif; ?>
  <h1>Admin Login</h1>
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <br>
    <input type="submit" name="submit" value="Log In">
  </form>
  </div>
</body>
</html>

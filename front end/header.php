<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Get the user input values
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Assuming the validation is successful, perform authentication
        $authenticationResult = authenticateUser($email, $password);
        if ($authenticationResult === true) {
            // Authentication successful, set session variable
            $_SESSION['email'] = $email;

            // Check if the product ID is available
            if ($productId) {
                $_SESSION['product_id'] = $productId; // Store the product ID in the session
            }

            // Redirect back to the previous page
            $previousPage = isset($_SESSION['previous_page']) ? $_SESSION['previous_page'] : 'index.php';
            header("Location: $previousPage");
            exit;
        } else {
            // Authentication failed, display an error message
            $error = $authenticationResult;
        }
    }
}

// Function to authenticate the user
function authenticateUser($email, $pasword) {
    // Connect to your MySQL database (replace with your own credentials)
    include 'config.php';

    // Escape the user input to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query the database to check if the user exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User found, verify the password
        $row = mysqli_fetch_assoc($result);
        $stored_email = $row['email'];
        $stored_password = $row['pasword'];

        if ($email === $stored_email) {
            // Email is correct, compare submitted password with stored password
            if ($pasword === $stored_password) {
                // Password is correct, authentication successful
                $_SESSION['name'] = $row['name']; // Fetch the name from the row and store it in the session
                return true;
            } else {
                // Password incorrect
                mysqli_close($conn);
                return "Wrong Password.";
            }
        }        
    }

    // User not found or email incorrect
    mysqli_close($conn);
    return "Wrong Email.";
}

// Store the previous page URL in session
if (!isset($_SESSION['email']) && !strpos($_SERVER['REQUEST_URI'], 'index.php')) {
    $_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" type="image/icon" href="../image/flower1.png">
    <title>Greenly - Happy plants</title>
    <!-- Code for jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Code for font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  CSS -->
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <!-- Code for linking css file -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">



</head>
<body>
        
<!-- New header section -->
<header class="new-header">
    <div class="social-media">
      <a href="https://www.facebook.com/don3sani?mibextid=ZbWKwL" class="fa fa-facebook" target="_blank"></a>
      <a href="https://twitter.com/Anubhav07662068?t=n0617CghxMusxrETsINp-Q&s=08" class="fa fa-twitter" target="_blank"></a>
      <a href="https://instagram.com/experience_bolte?igshid=NGExMmI2YTkyZg==" class="fa fa-instagram" target="_blank"></a>
      <a href="https://www.linkedin.com/in/anubhav-shah-2643941b4" class="fa fa-linkedin" target="_blank"></a>
    </div>
    <div class="text">
      <p>"Plant Happiness at Your Doorstep, Shop our Vibrant Selection Today!"</p>
    </div>
    <div class="text-1">
    <p class="fa fa-phone"> +91-91-74945-301</p>
    </div>
  </header>
  
<!-- header section -->
<header class="header">
<a href="index.php" class="logo"> <i class="fa fa-pagelines"></i>Greenly</a>


<nav class="navbar">
<a href="index.php">Home</a>
<a href="product.php">Products</a>
<a href="about.php">About</a>
<a href="contact.php">Contact us</a>
<a href="blog.php">Blogs</a>

</nav>


<div class="icons">
<div class="fa fa-bars" id="menu-btn"></div>
<div class="fa fa-search" id="search-btn"></div>
<a href="cart.php"><div class="fa fa-shopping-cart" id="cart-btn"></div></a>
<div class="fa fa-user" id="login-btn"></div>
</div>

<form class="search-form">
    <input type="search" id="search-box" placeholder="Search Here...">
    <label for="search-box" class="fa fa-search"></label>
</form>


<!-- Existing code... -->

<div class="shopping-cart">
  <!-- Cart items -->
  <div class="box">
    <!-- ...existing code... -->
  </div>

  <!-- Total price and checkout -->
  <div class="checkout-container">
    <div class="total">Total: <span id="total-price">₹0.00/-</span></div>
    <!-- Checkout button -->
    <a href="#" class="btn">Checkout</a>
  </div>
</div>






<!-- HTML form for login -->

<?php if (isset($_SESSION['email'])) { ?>
    <!-- User is logged in -->
    <div class="login-form">
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
         <p><?php echo $_SESSION['name']; ?></p>
         <p><?php echo $_SESSION['email']; ?></p>
     </div>

     <ul class="user-options">
         <li><a href="profile.php">view Profile</a></li>
         <li><a href="view_order.php">Your Orders</a></li>
         <li><a href="logout.php" class="logout-1">Logout</a></li>
     </ul>
    </div>
<?php } else { ?>
    <!-- User is not logged in -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="login-form">
        <h3>Login now</h3>
        <input type="email" name="email" placeholder="Enter email" class="box" required>
        <input type="password" name="password" placeholder="Enter password" class="box" required>

        <?php if (isset($error)) { ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php } ?>

        <p>Forget Your Password? <a href="forgot_password.php">Click Here</a></p>
        <p>Don't Have an Account? <a href="register.php">Create Now</a></p>

        <input type="submit" value="Login Now" class="btn">
    </form>
<?php } ?>


</header>
<!-- header section close -->


<script src="../js/script.js"></script>
</body>
</html>


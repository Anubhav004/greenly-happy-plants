<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if(!isset($_SESSION['email'])) {
  // Redirect to the login
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Scripts -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Code for linking css file -->
  <link rel="stylesheet" type="text/css" href="admin-style.css">
  <title>Admin Dashboard</title>
</head>
<body oncontextmenu="return false;">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Sidebar -->
  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block sidebar">
        <h1 class="navbar-brand">Greenly Admin</h1>
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item sidebar-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin.php') ? 'active-link' : ''; ?>" href="admin.php">Dashboard</a>
            </li>
            <li class="nav-item sidebar-item dropdown">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'all_products.php' || basename($_SERVER['PHP_SELF']) == 'create_product.php') ? 'active-link' : ''; ?>" id="productDropdown" role="button" onclick="toggleDropdown('productDropdown')" aria-haspopup="true" aria-expanded="false">
                Product</a>
              <div class="dropdown-menu" id="productDropdownMenu" aria-labelledby="productDropdown">
                <a class="dropdown-item" href="all_products.php">All Products</a>
                <a class="dropdown-item" href="create_product.php">Create Product</a>
              </div>
            </li>
            <li class="nav-item sidebar-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'view_orders.php') ? 'active-link' : ''; ?>" href="view_orders.php">View Orders</a>
            </li>
            <li class="nav-item sidebar-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'view_contacts.php') ? 'active-link' : ''; ?>" href="view_contacts.php">View Contacts</a>
            </li>
            <li class="nav-item sidebar-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'view_blog.php') ? 'active-link' : ''; ?>" href="view_blog.php">Blog Posts</a>
            </li>
            <li class="nav-item sidebar-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'view_ratings.php') ? 'active-link' : ''; ?>" href="view_ratings.php">Ratings</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
   </div>

</body>
<script src="script.js"></script>
</html>

<?php

if(isset($_SESSION['email'])) {
  // Redirect to the login
  header("Location: login.php");
  exit();
}

// Assuming you have a database connection established
$connection = new mysqli('localhost', 'root', '', 'user002');
if ($connection->connect_errno) {
    die('Failed to connect to the database: ' . $connection->connect_error);
}

// Fetch data from the database
$query = "SELECT COUNT(*) AS userCount FROM users";
$result = $connection->query($query);
$row = $result->fetch_assoc();
$userCount = $row['userCount'];

$query = "SELECT COUNT(*) AS productCount FROM products";
$result = $connection->query($query);
$row = $result->fetch_assoc();
$productCount = $row['productCount'];

$query = "SELECT COUNT(*) AS orderCount FROM orders WHERE status IN ('pending', 'shipped')";
$result = $connection->query($query);
$row = $result->fetch_assoc();
$orderCount = $row['orderCount'];

$query = "SELECT SUM(total_price) AS totalRevenue FROM orders WHERE status != 'Cancelled'";
$result = $connection->query($query);
$row = $result->fetch_assoc();
$totalRevenue = $row['totalRevenue'];



// Fetch data from the database for sales chart
$salesData = array();
$query = "SELECT DATE(order_date) AS orderDate, SUM(total_price) AS salesAmount FROM orders GROUP BY DATE(order_date)";
$result = $connection->query($query);
while ($row = $result->fetch_assoc()) {
    $salesData[] = array(
        'date' => $row['orderDate'],
        'salesAmount' => $row['salesAmount']
    );
}

// Fetch data from the database for user registrations chart
$userData = array();
$query = "SELECT DATE(cdt) AS registrationDate, COUNT(*) AS userCount FROM users GROUP BY DATE(cdt)";
$result = $connection->query($query);
while ($row = $result->fetch_assoc()) {
    $userData[] = array(
        'date' => $row['registrationDate'],
        'userCount' => $row['userCount']
    );
}

// Fetch data from the database for product stock
$query = "SELECT SUM(quantity) AS totalStock, SUM(CASE WHEN quantity = 0 THEN 1 ELSE 0 END) AS totalOutOfStock FROM products";
$result = $connection->query($query);
$row = $result->fetch_assoc();
$stockQuantity = $row['totalStock'];
$outOfStockQuantity = $row['totalOutOfStock'];

$productStockData = array(
    array(
        'stockStatus' => 'In Stock',
        'stockQuantity' => $stockQuantity
    ),
    array(
        'stockStatus' => 'Out of Stock',
        'stockQuantity' => $outOfStockQuantity
    )
);

// Close the database connection
$connection->close();
?>

<?php include "sidebar.php"?>
  <!-- Sidebar -->
  <div class="container-fluid">
    <div class="row">
      

      <!-- Content Area -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <h1 class="mt-4">Dashboard</h1>
          <div class="row">
              <div class="col-md-2">
                  <div class="card-1">
                      <div class="card-body">
                          <h5 class="card-title">Total Users</h5>
                          <p class="card-text"><?php echo $userCount; ?></p>
                      </div>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="card-1">
                      <div class="card-body">
                          <h5 class="card-title">Total Products</h5>
                          <p class="card-text"><?php echo $productCount; ?></p>
                      </div>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="card-1">
                      <div class="card-body">
                          <h5 class="card-title">New Orders</h5>
                          <p class="card-text"><?php echo $orderCount; ?></p>
                      </div>
                  </div>
              </div>
              <div class="col-md-5">
                  <div class="card-1">
                      <div class="card-body">
                          <h5 class="card-title">Total Revenue</h5>
                          <p class="card-text"><?php echo $totalRevenue; ?></p>
                      </div>
                  </div>
              </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Sales Chart</h5>
                      <canvas id="salesChart"></canvas>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">User Registrations</h5>
                      <canvas id="userChart"></canvas>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Product stock or out of stock </h5>
                      <canvas id="productStockChart"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </main>
          </div>
        </div>

<script>
  // Sales Chart
var salesData = <?php echo json_encode($salesData); ?>;
var salesLabels = salesData.map(function(item) {
    return item.date;
});
var salesAmounts = salesData.map(function(item) {
    return item.salesAmount;
});

var salesChartCanvas = document.getElementById('salesChart');
var salesChart = new Chart(salesChartCanvas, {
    type: 'bar',
    data: {
        labels: salesLabels,
        datasets: [{
            label: 'Sales Amount',
            data: salesAmounts,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// User Registrations Chart
var userData = <?php echo json_encode($userData); ?>;
var userRegistrationLabels = userData.map(function(item) {
    return item.date;
});
var userCounts = userData.map(function(item) {
    return item.userCount;
});

var userChartCanvas = document.getElementById('userChart');
var userChart = new Chart(userChartCanvas, {
    type: 'line',
    data: {
        labels: userRegistrationLabels,
        datasets: [{
            label: 'User Registrations',
            data: userCounts,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


// Product Stock Chart
var productStockData = <?php echo json_encode($productStockData); ?>;
var stockQuantities = productStockData.map(function(item) {
    return item.stockQuantity;
});

var productStockChartCanvas = document.getElementById('productStockChart');
var productStockChart = new Chart(productStockChartCanvas, {
    type: 'doughnut',
    data: {
        labels: ['In Stock', 'Out of Stock'],
        datasets: [{
            label: 'Stock Quantity',
            data: stockQuantities,
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>

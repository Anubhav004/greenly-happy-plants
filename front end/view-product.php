<?php
session_start();

$connection = new mysqli('localhost', 'root', '', 'user002');
if ($connection->connect_errno) {
    die('Failed to connect to the database: ' . $connection->connect_error);
}

// Function to get the average rating and review count for a product
function getReviewData($productId, $connection) {
  // Prepare the query to get the average rating and review count
  $query = "SELECT AVG(rating_number) AS average_rating, COUNT(*) AS review_count FROM ratings WHERE product_id = $productId";
  $result = $connection->query($query);
  if (!$result) {
      die('Failed to fetch review data: ' . $connection->error);
  }

  // Retrieve the average rating and review count
  $row = $result->fetch_assoc();
  $averageRating = $row['average_rating'];
  $reviewCount = $row['review_count'];

  return array(
      'averageRating' => $averageRating,
      'reviewCount' => $reviewCount
  );
}

// Get the product ID from the session, if available
$productId = isset($_SESSION['product_id']) ? $_SESSION['product_id'] : null;

// Check if the product ID is not available in the session and in the URL parameter
if (!$productId && !isset($_GET['id'])) {
    die('Product ID is missing');
}

// Set the product ID in the session if it is available in the URL parameter
if (isset($_GET['id'])) {
    $_SESSION['product_id'] = $_GET['id'];
    $productId = $_GET['id'];
}

// Remove the product ID from the session if it is not available in the URL parameter
if (!$productId) {
    unset($_SESSION['product_id']);
}

// Fetch the product details from the database based on the product ID
$query = "SELECT * FROM products WHERE id = $productId";
$result = $connection->query($query);
if (!$result) {
    die('Failed to fetch product details: ' . $connection->error);
}

// Check if the product exists
if ($result->num_rows === 0) {
    die('Product not found');
}

// Retrieve the product details
$product = $result->fetch_assoc();
$productName = $product['name'];
$productImage = $product['image'];
$productPrice = $product['price'];
$productDescription = $product['description'];
$productQuantity = $product['quantity'];

// Update the status based on available quantity
if ($productQuantity > 3) {
    $productStatus = '<span class="in-stock">' . $productQuantity . ' In stock</span>';
} elseif ($productQuantity > 0) {
    $productStatus = '<span class="low-stock">' . $productQuantity . ' in stock</span>';
} else {
    $productStatus = '<span class="out-of-stock">Out of stock</span>';
}

// Close the result and connection
$result->close();
$connection->close();

// Handle the purchase logic
if (isset($_POST['quantity'])) {
  $quantityToBuy = $_POST['quantity'];

  if ($quantityToBuy > $productQuantity) {
      die('Insufficient stock');
  }

  // Update the quantity in the database
  $connection = new mysqli('localhost', 'root', '', 'user002');
  if ($connection->connect_errno) {
      die('Failed to connect to the database: ' . $connection->connect_error);
  }
  
  $newQuantity = $productQuantity - $quantityToBuy;
  $updateQuery = "UPDATE products SET quantity = $newQuantity WHERE id = $productId";
  $updateResult = $connection->query($updateQuery);
  if (!$updateResult) {
      die('Failed to update quantity: ' . $connection->error);
  }
  
  $connection->close();
  
}
?>

<?php include 'header.php'; ?>
<div class="product-details">
  <input type="hidden" id="product-image" value="<?php echo $productImage; ?>">
  <div class="product-image-container">
    <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>">
  </div>
  <div class="product-info">
    <h3 class="product-name"><?php echo $productName; ?></h3>
    <div class="rating">
      <?php
      $connection = new mysqli('localhost', 'root', '', 'user002');
      if ($connection->connect_errno) {
        die('Failed to connect to the database: ' . $connection->connect_error);
      }

      // Fetch the review data
      $reviewData = getReviewData($productId, $connection);
      $connection->close();

      $averageRating = $reviewData['averageRating'];
      $reviewCount = $reviewData['reviewCount'];

      $roundedRating = round($averageRating);
      $filledStars = floor($roundedRating);
      $hasHalfStar = ($roundedRating - $filledStars) >= 0.5;

      for ($i = 1; $i <= 5; $i++) {
        if ($i <= $filledStars) {
          echo '<span class="star filled">&#9733;</span>';
        } elseif ($hasHalfStar) {
          echo '<span class="star half-filled">&#9733;</span>';
          $hasHalfStar = false; // To display only one half-filled star
        } else {
          echo '<span class="star">&#9734;</span>';
        }
      }
      ?>
      <div class="rating-info">
        <span class="average-rating"><?php echo round($averageRating, 1); ?></span>
        <span class="review-count">(<?php echo $reviewCount; ?> Reviews)</span>
      </div>
    </div>
    <span class="price"><?php echo '₹' . $productPrice; ?></span>
    <form action="checkout.php" method="GET">
          <input type="hidden" name="action" value="buy_now">
          <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
          <div class="quantity">
              <label for="quantity">Quantity: </label>
              <div class="quantity-control">
                  <span class="minus" onclick="decrementQuantity()">-</span>
                  <input type="number" id="quantity" name="quantity" min="1" max="<?php echo $productQuantity; ?>"      value="<?php echo min(1, $productQuantity); ?>">
                  <span class="plus" onclick="incrementQuantity()">+</span>
              </div>
          </div>
          <div class="buttons">
              <?php if ($productStatus !== 'Out of stock'): ?>
                  <button type="submit" class="buy-now">Buy Now</button>
                  <?php if (isset($_SESSION['email']) && $_SESSION['email']): ?>
                      <button type="button" class="add-to-cart">Add to Cart</button>
                  <?php else: ?>
                      <button type="button" class="add-to-cart">Add to Cart</button>
                  <?php endif; ?>
              <?php else: ?>
                  <button class="buy-now" disabled="disabled">Buy Now</button>
                  <button class="add-to-cart" disabled="disabled">Add to Cart</button>
              <?php endif; ?>
          </div>
      </form>

    <div class="status">Status: <?php echo $productStatus; ?></div>
    <h4>Description:</h4>
    <div class="description"><?php echo $productDescription; ?></div>
    <button class="submit-review" onclick="showReviewForm(<?php echo $productId; ?>)">Write Review</button>
  </div>
</div>


<!-- Review Form -->
<?php
// Check if the user is logged in
    if (isset($_SESSION['email'])) {
        // User is logged in, display the review form
        echo '<div class="review-form" id="reviewFormContainer" style="display: none;">
  <h4>Write a Review</h4>
  <form action="submit_review.php" method="post">
  <input type="hidden" name="reviewProductId" id="reviewProductId" value="">
    <label for="reviewRating">Rating</label>
    <div class="rating">
      <input type="radio" id="star5" name="rating_number" value="5" required>
      <label for="star5" title="5 stars">&#9733;</label>
      
      <input type="radio" id="star4" name="rating_number" value="4" required>
      <label for="star4" title="4 stars">&#9733;</label>
      
      <input type="radio" id="star3" name="rating_number" value="3" required>
      <label for="star3" title="3 stars">&#9733;</label>
      
      <input type="radio" id="star2" name="rating_number" value="2" required>
      <label for="star2" title="2 stars">&#9733;</label>
      
      <input type="radio" id="star1" name="rating_number" value="1" required>
      <label for="star1" title="1 star">&#9733;</label>
    </div>
    <label for="reviewName">Review Title</label>
    <input type="text" id="reviewName" name="title" placeholder="Give your Review title" required>
    
    <label for="reviewComment">Review</label>
    <textarea id="reviewComment" name="comment" placeholder="Write your comments here.." required></textarea>

    <button type="submit">Submit</button>
    <button type="button" onclick="hideReviewForm()">Cancel</button>
    </form>
  </div>';
    // Check if a review success message is available in the session
    if (isset($_SESSION['review_success_message'])) {
        // Display the success message
        echo '<p class="r-success-message">' . $_SESSION['review_success_message'] . '</p>';

        // Clear the session variable
       unset($_SESSION['review_success_message']);
    }

} else {
       // User is not logged in, display a message to login
       echo '<div class="review-message" id="reviewMessage" style="display: none;">
             <p>Please login to write a review.</p>
             </div>';
    }
    
// Fetch and display reviews from the database
$productID = isset($_SESSION['product_id']) ? $_SESSION['product_id'] : null;
if ($productID) {
    // Establish a new database connection
    $connection = new mysqli('localhost', 'root', '', 'user002');
    if ($connection->connect_errno) {
        die('Failed to connect to the database: ' . $connection->connect_error);
    }

    // Get the total number of reviews
    $totalReviewsQuery = "SELECT COUNT(*) AS total FROM ratings WHERE product_id = ?";
    $stmtTotal = $connection->prepare($totalReviewsQuery);
    $stmtTotal->bind_param('i', $productID);
    $stmtTotal->execute();
    $totalResult = $stmtTotal->get_result();
    $totalReviews = $totalResult->fetch_assoc()['total'];

    // Define the number of reviews to display per page
    $reviewsPerPage = 5;

    // Calculate the total number of pages
    $totalPages = ceil($totalReviews / $reviewsPerPage);

    // Get the current page number from the query parameters
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calculate the offset for pagination
    $offset = ($currentPage - 1) * $reviewsPerPage;

    // Fetch reviews for the current page
    $reviewsQuery = "SELECT r.rating_number, r.title, r.comment, r.created, u.profile_image, u.name
                     FROM ratings r
                     INNER JOIN users u ON r.user_id = u.sno
                     WHERE r.product_id = ?
                     ORDER BY r.created DESC
                     LIMIT ?, ?";
    $stmt = $connection->prepare($reviewsQuery);
    $stmt->bind_param('iii', $productID, $offset, $reviewsPerPage);
    $stmt->execute();
    $reviewsResult = $stmt->get_result();
    $reviews = $reviewsResult->fetch_all(MYSQLI_ASSOC);

    // Display the number of reviews
    echo '<div id="reviews-section">';
    echo '<div class="display-review">';
    echo '<p>(' . $totalReviews . ') PEOPLE HAVE GIVEN REVIEWS REGARDING THIS PRODUCT.</p>';

    // Display the reviews
    if (!empty($reviews)) {
        echo '<h4>People Reviews</h4>';

        foreach ($reviews as $review) {
            $userImage = $review['profile_image'] ? $review['profile_image'] : '../image/avtar.png';
            $dateSubmitted = date('j M Y', strtotime($review['created']));
            $ratingNumber = $review['rating_number'];

            echo '<div class="review">
                    <div class="user-image">
                        <img src="' . $userImage . '" alt="' . $review['name'] . '">
                    </div>
                    <div class="user-details">
                        <div class="user-name">' . $review['name'] . '</div>
                        <div class="review-rating">';

            // Display the rating stars
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $ratingNumber) {
                    echo '<span class="star filled">&#9733;</span>';
                } else {
                    echo '<span class="star empty">&#9734;</span>';
                }
            }

            echo '</div>
                  <div class="review-title">' . $review['title'] . '</div>
                  <div class="review-comment">' . $review['comment'] . '</div>
                  <div class="review-date">' . $dateSubmitted . '</div>
                </div>
              </div>';
        }
      
        // Display pagination links
        echo '<div class="pagination">';
        for ($page = 1; $page <= $totalPages; $page++) {
            $activeClass = ($page == $currentPage) ? 'active' : '';
            $url = "?product_id={$productID}&page={$page}#reviews-section";
            echo '<a href="' . $url . '" class="' . $activeClass . '">' . $page . '</a>';
        }
        echo '</div>';
        echo '</div>';
    } else {
        echo '<p>No reviews available for this product yet.</p>';
    }

    // Close the database connection
    $connection->close();
} else {
    echo 'Product ID is missing.';
}
echo '</div>';
?>


 <script>
  function showReviewForm(productId) {
    // Check if the user is logged in
    <?php if (isset($_SESSION['email'])) : ?>
      const reviewFormContainer = document.getElementById('reviewFormContainer');
      reviewFormContainer.style.display = 'block';
    <?php else : ?>
      const reviewMessage = document.getElementById('reviewMessage');
      reviewMessage.style.display = 'block';
    <?php endif; ?>

    document.getElementById('reviewProductId').value = productId;
  }
</script>


<script>
  var addToCartButton = document.querySelector(".add-to-cart");
  addToCartButton.addEventListener("click", function() {
    <?php if (isset($_SESSION['email']) && $_SESSION['email']): ?>
      // Retrieve the product details
      var productId = "<?php echo $productId; ?>";
      var productQuantity = parseInt(document.getElementById("quantity").value);

      // Create a cart item object
      var cartItem = {
        productId: productId,
        productQuantity: productQuantity
      };

      // Make an AJAX request to store the cart item in the database
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "store_cart.php", true);
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          console.log("Response:", xhr.responseText); // Debug: Check the response received
          if (xhr.status === 200) {
            alert(xhr.responseText); // Display success message from PHP
            location.reload(); // Refresh the page to clear the message
          } else {
            alert(xhr.responseText); // Display error message from PHP
          }
        }
      };
      xhr.send(JSON.stringify(cartItem));
    <?php else: ?>
      alert("Please login to add this item to your cart.");
    <?php endif; ?>
  });
</script>



<?php include 'footer.php'; ?>

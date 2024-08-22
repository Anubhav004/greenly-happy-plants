<?php include 'header.php'; ?>
<?php

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];

    // Assuming you have a database connection established
    $connection = new mysqli('localhost', 'root', '', 'user002');
    if ($connection->connect_errno) {
        die('Failed to connect to the database: ' . $connection->connect_error);
    }

    // Prepare the SQL statement to fetch the user ID
    $sql = "SELECT sno FROM users WHERE email = ? LIMIT 1";

    // Prepare and bind the parameters
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('s', $userEmail);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a row is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['sno'];

        // Prepare the SQL statement to fetch cart items for the user
        $sql = "SELECT c.product_id, c.quantity, p.name, p.price, p.image
                FROM cart c
                INNER JOIN products p ON c.product_id = p.id
                WHERE c.user_id = ?";

        // Prepare and bind the parameter
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('s', $userId);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if cart items are found
        if ($result->num_rows > 0) {
            $totalPrice = 0;
            ?>
            <div class="cart">
              <h2>Your Cart</h2>
              <table>
                  <thead>
                      <tr>
                          <th>Product</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Total</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php while ($row = $result->fetch_assoc()) : ?>
                          <tr>
                              <td class="product-column">
                                  <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                                  <?php echo $row['name']; ?>
                              </td>
                              <td>
                              <div class="quantity">
                                      <button class="decrease-qty" data-product-id="<?php echo $row['product_id']; ?>">-</button>
                                      <span><?php echo $row['quantity']; ?></span>
                                      <button class="increase-qty" data-product-id="<?php echo $row['product_id']; ?>">+</button>
                                  </div>
                              </td>
                              <td>₹<?php echo $row['price']; ?></td>
                              <td>₹<?php echo $row['price'] * $row['quantity']; ?></td>
                              <td>
                                  <a href="delete_cart_item.php?product_id=<?php echo $row['product_id']; ?>">
                                      <i class="fa fa-trash"></i>
                                  </a>
                              </td>
                          </tr>
                          <?php
                          $totalPrice += $row['price'] * $row['quantity'];
                      endwhile;
                      ?>
                  </tbody>
                  <tfoot>
                      <tr>
                          <td colspan="4">Grand Total: ₹<?php echo $totalPrice; ?>/-</td>
                      </tr>
                  </tfoot>
              </table>
              <a href="checkout.php" class="btn">Checkout</a>
          </div>
                    
              
            <?php
        } else {
            echo '<div class="msgprint">';
            echo "No items in the cart.";
            echo '</div>';
        }
    } else {
        echo '<div class="msgprint">';
        echo "User not found.";
        echo '</div>';
    }

    // Close the statement, result, and the database connection
    $stmt->close();
    $result->close();
    $connection->close();
} else {
    echo '<div class="msgprint">';
    echo "Please login to view your cart.";
    echo '</div>';
}
?>

<script>
    // Quantity increase button event listener
    var increaseButtons = document.querySelectorAll('.increase-qty');
    increaseButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            var productId = event.target.getAttribute('data-product-id');
            updateQuantity(productId, 1);
        });
    });

    // Quantity decrease button event listener
    var decreaseButtons = document.querySelectorAll('.decrease-qty');
    decreaseButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            var productId = event.target.getAttribute('data-product-id');
            updateQuantity(productId, -1);
        });
    });

    // Function to update the quantity via AJAX
    function updateQuantity(productId, quantityChange) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_cart_quantity.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                location.reload(); // Reload the page to reflect the updated quantity
            } else {
                console.log('Request failed. Error code: ' + xhr.status);
            }
        };
        xhr.send('product_id=' + productId + '&quantity_change=' + quantityChange);
    }
</script>
<?php include 'footer.php'; ?>
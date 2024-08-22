<?php include 'header.php'; ?>
<?php
// Check if the action is "buy_now" and a product ID is provided
if (isset($_GET['action']) && $_GET['action'] === 'buy_now' && isset($_GET['product_id']) && isset($_GET['quantity'])) {
    // Assuming you have a database connection established
    $connection = new mysqli('localhost', 'root', '', 'user002');
    if ($connection->connect_errno) {
        die('Failed to connect to the database: ' . $connection->connect_error);
    }

    $productId = $_GET['product_id'];
    $selectedQuantity = $_GET['quantity'];

    // Prepare the SQL statement to fetch the product details
    $sql = "SELECT p.id, p.name, p.price, p.image
            FROM products p
            WHERE p.id = ? LIMIT 1";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('s', $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the product is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Check if the user is logged in
        if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
            $userEmail = $_SESSION['email'];
            $sql = "SELECT sno FROM users WHERE email = ? LIMIT 1";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param('s', $userEmail);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if a user is found
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $userId = $row['sno'];

                // Check if the product is already in the cart
                $sql = "SELECT * FROM cart WHERE user_id = ? AND product_id = ? LIMIT 1";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param('ss', $userId, $productId);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Product already in the cart, retrieve the current quantity
                    $row = $result->fetch_assoc();
                    $currentQuantity = $row['quantity'];

                    // Update the quantity with the selected quantity
                    $newQuantity = $selectedQuantity;
                    $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param('sss', $newQuantity, $userId, $productId);
                    $stmt->execute();
                } else {
                    // Product not in the cart, insert a new entry with the selected quantity
                    $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param('ssi', $userId, $productId, $selectedQuantity);
                    $stmt->execute();
                }

                // Redirect to the checkout page to display the cart items
                header("Location: checkout.php");
                exit();
            }
        }
        
    }

    // Close the statement, result, and the database connection
    $stmt->close();
    $result->close();
    $connection->close();
}
?>

<?php
if (isset($_SESSION['email'])) {
    // Assuming you have a database connection established
    $connection = new mysqli('localhost', 'root', '', 'user002');
    if ($connection->connect_errno) {
        die('Failed to connect to the database: ' . $connection->connect_error);
    }

    // Get the user ID based on the email
    $userEmail = $_SESSION['email'];
    $sql = "SELECT sno FROM users WHERE email = ? LIMIT 1";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('s', $userEmail);
    $stmt->execute();
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
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('s', $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if cart items are found
        if ($result->num_rows > 0) {
            // Calculate the total price and create an array to store cart items
            $totalPrice = 0;
            $cartItems = array();

            // Iterate over each cart item and calculate the total price
            while ($row = $result->fetch_assoc()) {
                $quantity = $row['quantity'];
                $price = $row['price'];
                $totalPrice += $quantity * $price;
                $cartItems[] = $row;
            }
            ?>
            <h2 class="checkout-h">Checkout Here</h2>
            <div class="checkout-container">  
            <div class="checkout">        
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item) : ?>
                            <tr>
                                <td class="product-column">
                                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>"     height="50">
                                    <?php echo $item['name']; ?>
                                </td>
                                <td><?php echo $item['quantity']; ?></td>
                                <td>₹<?php echo $item['price']; ?></td>
                                <td>₹<?php echo $item['quantity'] * $item['price']; ?></td>
                                <!-- Add hidden input fields for each product's details -->
                                <input type="hidden" name="product_name[]" value="<?php echo $item['name']; ?>">
                                <input type="hidden" name="quantity[]" value="<?php echo $item['quantity']; ?>">
                                <input type="hidden" name="price[]" value="<?php echo $item['price']; ?>">
                                <input type="hidden" name="total_price[]" value="<?php echo $item['quantity'] * $item['price']; ?>">
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">Grand Total:</td>
                            <td>₹<?php echo $totalPrice; ?>/-</td>
                        </tr>
                    </tfoot>
                </table>
                </div>
                <div class="checkout-details">
                <h2>Enter Your Details</h2>
                <script>
                  function validateForm() {
                    var name = document.getElementById('name').value;
                    var email = document.getElementById('email').value;
                    var phone = document.getElementById('phone').value;
                    var address = document.getElementById('address').value;
                    var pincode = document.getElementById('pincode').value;
                
                    // Perform validation for each field
                    if (name === "") {
                      alert("Please enter your name.");
                      return false;
                    }
                
                    if (email === "") {
                      alert("Please enter your email.");
                      return false;
                    }
                
                    // Perform additional validation for email format
                    var emailRegex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
                    if (!email.match(emailRegex)) {
                      alert("Please enter a valid email address.");
                      return false;
                    }
                
                    if (phone === "") {
                      alert("Please enter your phone number.");
                      return false;
                    }
                
                    // Perform additional validation for phone number format
                    var phoneRegex = /^\d{10}$/;
                    if (!phone.match(phoneRegex)) {
                      alert("Please enter a 10-digit phone number.");
                      return false;
                    }
                
                    if (address === "") {
                      alert("Please enter your address.");
                      return false;
                    }
                
                    if (pincode === "") {
                      alert("Please enter your pincode.");
                      return false;
                    }
                
                    // Perform additional validation for pincode format
                    var pincodeRegex = /^\d{6}$/;
                    if (!pincode.match(pincodeRegex)) {
                      alert("Please enter a 6-digit pincode.");
                      return false;
                    }
                
                    // If all validations pass, the form can be submitted
                    return true;
                  }
                </script>
                <form action="process_order.php" method="POST" onsubmit="return validateForm();">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" placeholder="Enter full name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" >
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="text" id="phone" name="phone" placeholder="10 digit mob. no." >
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea id="address" name="address" rows="4" placeholder="Enter your address" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pincode">Pincode:</label>
                        <input type="text" id="pincode" name="pincode" placeholder="Enter your area pincode" >
                    </div>
                    <button type="submit" class="btn">Place Order</button>
                </form>
            </div>
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
    echo "Please login to proceed with purchase.";
    echo '</div>';
}
?>
<?php include 'footer.php'; ?>


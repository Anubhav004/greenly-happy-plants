// Function to retrieve cart items from local storage
function getCartItemsFromStorage() {
  var cartItemsJson = localStorage.getItem("cartItems");
  if (cartItemsJson) {
    return JSON.parse(cartItemsJson);
  } else {
    return [];
  }
}

// Function to save cart items to local storage
function saveCartItemsToStorage(cartItems) {
  var cartItemsJson = JSON.stringify(cartItems);
  localStorage.setItem("cartItems", cartItemsJson);
}

// Function to create a cart item element
function createCartItemElement(productId, productName, productPrice, productQuantity, productImage) {
  var cartItem = document.createElement("div");
  cartItem.className = "box";
  cartItem.setAttribute("data-product-id", productId);
  cartItem.innerHTML = `
    <i class="fa fa-trash"></i>
    <img src="${productImage}" alt="${productName}">
    <div class="content">
      <h3>${productName}</h3>
      <span class="price">₹${productPrice.toFixed(2)}/-</span>
      <span class="quantity">Qty: ${productQuantity}</span>
      <button class="increase">+</button>
      <button class="decrease">-</button>
    </div>
  `;

  return cartItem;
}

// Function to calculate and update the total price
function updateTotalPrice(productPrice, quantityChange) {
  var totalPriceElement = document.getElementById("total-price");
  var currentTotalPrice = parseFloat(totalPriceElement.innerText.replace("Total Price: ₹", "").replace("/-", ""));
  var newTotalPrice = currentTotalPrice + productPrice * quantityChange;
  totalPriceElement.innerText = "Total Price: ₹" + newTotalPrice.toFixed(2) + "/-";
}

// Function to handle adding a product to the cart
function addToCart(productId) {
  // Make an AJAX request to fetch the available quantity
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "get_quantity.php?productId=" + productId, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      var availableQuantity = response.quantity;

      // Continue with the addToCart function and pass the availableQuantity as an argument
      continueAddToCart(productId, availableQuantity);
    }
  };
  xhr.send();
}

// Function to continue adding a product to the cart
function continueAddToCart(productId, availableQuantity) {
  // Check if the product already exists in the cart
  var existingCartItem = document.querySelector(`.box[data-product-id="${productId}"]`);
  if (existingCartItem) {
    // Increment the quantity of the existing cart item
    var quantityElement = existingCartItem.querySelector(".quantity");
    var currentQuantity = parseInt(quantityElement.innerText.replace("Qty: ", ""));
    var quantityInput = document.getElementById("quantity");
    var increaseBy = parseInt(quantityInput.value);

    // Limit the quantity increase based on the available quantity
    var remainingQuantity = availableQuantity - currentQuantity;
    if (increaseBy > remainingQuantity) {
      increaseBy = remainingQuantity;
      quantityInput.value = remainingQuantity.toString();
    }

    var newQuantity = currentQuantity + increaseBy;
    quantityElement.innerText = "Qty: " + newQuantity;

    // Calculate and update the total price
    var productPrice = parseFloat("<?php echo $productPrice; ?>");
    updateTotalPrice(productPrice, increaseBy);

    // Update the cart items in local storage
    var cartItems = getCartItemsFromStorage();
    var existingCartItemIndex = cartItems.findIndex(item => item.productId === productId);
    cartItems[existingCartItemIndex].quantity = newQuantity;
    saveCartItemsToStorage(cartItems);

    return; // Exit the function
  }

  // Retrieve the product details
  var productName = "<?php echo $productName; ?>";
  var productPrice = parseFloat("<?php echo $productPrice; ?>");
  var productQuantity = parseInt(document.getElementById("quantity").value);

  // Retrieve the product image URL from the hidden input field
  var productImage = document.getElementById("product-image").value;

  // Create the cart item element
  var cartItem = createCartItemElement(productId, productName, productPrice, productQuantity, productImage);

  // Append the cart item to the shopping cart
  var shoppingCart = document.querySelector(".shopping-cart");
  shoppingCart.appendChild(cartItem);

  // Calculate and update the total price
  updateTotalPrice(productPrice, productQuantity);

  // Update the cart items in local storage
  var cartItems = getCartItemsFromStorage();
  cartItems.push({
    productId: productId,
    productName: productName,
    productPrice: productPrice,
    productQuantity: productQuantity,
    productImage: productImage
  });
  saveCartItemsToStorage(cartItems);

  // Add event listener to the trash icon
  var trashIcon = cartItem.querySelector(".fa-trash");
  trashIcon.addEventListener("click", function() {
    // Retrieve the quantity of the deleted cart item
    var deletedQuantity = parseInt(cartItem.querySelector(".quantity").innerText.replace("Qty: ", ""));

    // Remove the cart item from the shopping cart
    cartItem.remove();

    // Calculate and update the total price
    updateTotalPrice(productPrice, -deletedQuantity);

    // Update the cart items in local storage
    var cartItems = getCartItemsFromStorage();
    var deletedCartItemIndex = cartItems.findIndex(item => item.productId === productId);
    cartItems.splice(deletedCartItemIndex, 1);
    saveCartItemsToStorage(cartItems);
  });

  // Add event listener to the increase button
  var increaseButton = cartItem.querySelector(".increase");
  increaseButton.addEventListener("click", function() {
    var currentQuantity = parseInt(cartItem.querySelector(".quantity").innerText.replace("Qty: ", ""));
    if (currentQuantity < availableQuantity) {
      var increaseBy = 1;
      var newQuantity = currentQuantity + increaseBy;
      cartItem.querySelector(".quantity").innerText = "Qty: " + newQuantity;
      updateTotalPrice(productPrice, increaseBy);

      // Update the cart items in local storage
      var cartItems = getCartItemsFromStorage();
      var existingCartItemIndex = cartItems.findIndex(item => item.productId === productId);
      cartItems[existingCartItemIndex].quantity = newQuantity;
      saveCartItemsToStorage(cartItems);
    }
  });

  // Add event listener to the decrease button
  var decreaseButton = cartItem.querySelector(".decrease");
  decreaseButton.addEventListener("click", function() {
    var currentQuantity = parseInt(cartItem.querySelector(".quantity").innerText.replace("Qty: ", ""));
    if (currentQuantity > 1) {
      var newQuantity = currentQuantity - 1;
      cartItem.querySelector(".quantity").innerText = "Qty: " + newQuantity;
      updateTotalPrice(productPrice, -1);

      // Update the cart items in local storage
      var cartItems = getCartItemsFromStorage();
      var existingCartItemIndex = cartItems.findIndex(item => item.productId === productId);
      cartItems[existingCartItemIndex].quantity = newQuantity;
      saveCartItemsToStorage(cartItems);
    }
  });
}

// Function to initialize the shopping cart on page load
function initializeShoppingCart() {
  // Retrieve the cart items from local storage
  var cartItems = getCartItemsFromStorage();

  // Retrieve the total price element
  var totalPriceElement = document.getElementById("total-price");

  // Iterate over the cart items and create the cart item elements
  var shoppingCart = document.querySelector(".shopping-cart");
  cartItems.forEach(function(item) {
    var cartItem = createCartItemElement(item.productId, item.productName, item.productPrice, item.productQuantity, item.productImage);
    shoppingCart.appendChild(cartItem);
    updateTotalPrice(item.productPrice, item.productQuantity);
  });

  // Update the total price element
  var currentTotalPrice = parseFloat(totalPriceElement.innerText.replace("Total Price: ₹", "").replace("/-", ""));
  totalPriceElement.innerText = "Total Price: ₹" + currentTotalPrice.toFixed(2) + "/-";
}

// Call the initializeShoppingCart function on page load
window.addEventListener("load", initializeShoppingCart);

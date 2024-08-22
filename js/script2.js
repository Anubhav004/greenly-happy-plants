$(document).ready(function() {
  // Fetch categories from the database
  $.ajax({
    url: 'fetch-categories.php', // PHP script to fetch categories
    method: 'GET',
    success: function(response) {
      $('#category-filter').html(response); // Populate categories in the filter sidebar
    },
    error: function(xhr, status, error) {
      console.log('Error:', error); // Log any errors
    }
  });

  // Handle filter button click event
  $('#filter-button').on('click', function() {
    var minPrice = $('#min-price').val();
    var maxPrice = $('#max-price').val();
    var category = $('#category-filter').val();
    var rating = $('#rating').val();

    // Create an empty object to store the filter values
    var filters = {};

    // Add the price range to the filters object
    if (minPrice && maxPrice) {
      filters.minPrice = minPrice;
      filters.maxPrice = maxPrice;
    }

    // Add the category to the filters object if selected
    if (category) {
      filters.category = category;
    }

    // Add the rating to the filters object if provided
    if (rating) {
      filters.rating = rating;
    }

    // Send AJAX request to filter-products.php
    $.ajax({
      url: 'filter-products.php',
      method: 'POST',
      data: filters, // Pass the filters object as data
      success: function(response) {
        $('.product-list').html(response); // Update the product list with filtered products
      },
      error: function(xhr, status, error) {
        console.log('Error:', error); // Log any errors
      }
    });
  });
});

// Clear-button filter inputs
document.getElementById("clear-button").addEventListener("click", function() {
  // Clear all filter inputs
  document.getElementById("min-price").value = "";
  document.getElementById("max-price").value = "";
  document.getElementById("rating").value = "";
  document.getElementById("category-filter").value = "";

  // Clear category checkboxes
  var categoryCheckboxes = document.getElementsByClassName("category-filter");
  for (var i = 0; i < categoryCheckboxes.length; i++) {
    categoryCheckboxes[i].checked = false;
  }

  // Fetch and display all products
  fetchProducts();
});

// Function to fetch and display products based on applied filters
function fetchProducts() {
  // Send an AJAX request to the server with the filter values
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "filter-products.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  // Prepare the filter data
  var formData = new FormData();
  formData.append("minPrice", document.getElementById("min-price").value);
  formData.append("maxPrice", document.getElementById("max-price").value);
  formData.append("rating", document.getElementById("rating").value);

  var categoryCheckboxes = document.getElementsByClassName("category-filter");
  for (var i = 0; i < categoryCheckboxes.length; i++) {
    if (categoryCheckboxes[i].checked) {
      formData.append("category[]", categoryCheckboxes[i].value);
    }
  }

  // Handle the AJAX response
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Update the product list with the fetched products
        document.getElementsByClassName("product-list")[0].innerHTML = xhr.responseText;
      } else {
        console.error("Failed to fetch products: " + xhr.status);
      }
    }
  };

  // Send the AJAX request with the filter data
  xhr.send(formData);
}

// Initial fetch and display of all products
fetchProducts();


// faq script
const items = document.querySelectorAll(".accordion a");

function toggleAccordion(){
  this.classList.toggle('active');
  this.nextElementSibling.classList.toggle('active');
}

items.forEach(item => item.addEventListener('click', toggleAccordion));



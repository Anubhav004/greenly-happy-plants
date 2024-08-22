let searchForm = document.querySelector('.search-form');
let shoppingCart = document.querySelector('.shopping-cart');
let loginForm = document.querySelector('.login-form');
let navbar = document.querySelector('.navbar');

document.querySelector('#search-btn').onclick = () => {
    searchForm.classList.toggle('active');
    shoppingCart.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
}

document.querySelector('#cart-btn').onclick = () => {
    shoppingCart.classList.toggle('active');
    searchForm.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
}

document.querySelector('#login-btn').onclick = () => {
    loginForm.classList.toggle('active');
    shoppingCart.classList.remove('active');
    searchForm.classList.remove('active');
    navbar.classList.remove('active');
}

document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
    loginForm.classList.remove('active');
    shoppingCart.classList.remove('active');
    searchForm.classList.remove('active');
}

// Update the event listener for the search form
window.addEventListener('click', (event) => {
    if (!event.target.matches('#search-btn') && !event.target.closest('.search-form')) {
        searchForm.classList.remove('active');
    }
    if (!event.target.matches('#cart-btn')) {
        shoppingCart.classList.remove('active');
    }
    if (!event.target.matches('#login-btn')) {
        loginForm.classList.remove('active');
    }
    if (!event.target.matches('#menu-btn')) {
        navbar.classList.remove('active');
    }
});

// Prevent the search form, shopping cart, login form, and navbar from closing when clicked inside
searchForm.addEventListener('click', (event) => {
    event.stopPropagation();
});

shoppingCart.addEventListener('click', (event) => {
    event.stopPropagation();
});

loginForm.addEventListener('click', (event) => {
    event.stopPropagation();
});

navbar.addEventListener('click', (event) => {
    event.stopPropagation();
});




// slider javascript code
document.addEventListener("DOMContentLoaded", function() {
  const slideContainer = document.querySelector(".slider");
  const slides = document.querySelectorAll(".slide");
  const prevBtn = document.querySelector(".slider-prev-btn");
  const nextBtn = document.querySelector(".slider-next-btn");
  const dotsContainer = document.querySelector(".dots");
  let currentSlide = 0;
  
  function showSlide(slideIndex) {
    slideContainer.style.transform = `translateX(-${slideIndex * 100}%)`;
  }
  
  function changeSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
    updateDots();
  }
  
  setInterval(changeSlide, 6000);
  
  function createDots() {
    slides.forEach((_, index) => {
      const dot = document.createElement("span");
      dot.classList.add("dot");
      dot.addEventListener("click", () => {
        currentSlide = index;
        showSlide(currentSlide);
        updateDots();
      });
      dotsContainer.appendChild(dot);
    });
  }
  
  function updateDots() {
    const dots = document.querySelectorAll(".dot");
    dots.forEach((dot, index) => {
      dot.classList.toggle("active", index === currentSlide);
    });
  }
  
  prevBtn.addEventListener("click", () => {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
    updateDots();
  });
  
  nextBtn.addEventListener("click", () => {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
    updateDots();
  });
  
  createDots();
  showSlide(currentSlide);
  updateDots();
});



// navbar active code
document.addEventListener("DOMContentLoaded", function() {
  var navLinks = document.querySelectorAll(".navbar a");

  // Get the current page URL
  var currentPageUrl = window.location.href;

  // Loop through each navigation link and check if it matches the current page
  navLinks.forEach(function(link) {
    if (link.href === currentPageUrl) {
      link.classList.add("active");
    }
  });
});



//increment or decrement quantity
function incrementQuantity() {
var quantityInput = document.getElementById('quantity');
var currentValue = parseInt(quantityInput.value);
var maxValue = parseInt(quantityInput.max);

if (currentValue < maxValue) {
  quantityInput.value = currentValue + 1;
}
}

function decrementQuantity() {
var quantityInput = document.getElementById('quantity');
var currentValue = parseInt(quantityInput.value);
var minValue = parseInt(quantityInput.min);

if (currentValue > minValue) {
  quantityInput.value = currentValue - 1;
}
}

// review form display hide 
function hideReviewForm() {
  var reviewFormContainer = document.getElementById("reviewFormContainer");
  reviewFormContainer.style.display = "none";
}


// review scroll
function scrollToReviews(event) {
    event.preventDefault();
    var reviewsSection = document.getElementById('reviews-section');
    var yOffset = -100; // Adjust this value to fine-tune the scroll position
    var y = reviewsSection.getBoundingClientRect().top + window.pageYOffset + yOffset;
    window.scrollTo({ top: y, behavior: 'smooth' });
}


// Get the search input element
const searchInput = document.getElementById('search-box');

// Add event listener for input change
searchInput.addEventListener('input', function() {
  // Get the search query
  const query = this.value.toLowerCase();

  // Get the product names
  const productNames = document.getElementsByClassName('product');
  for (const productName of productNames) {
    // Check if the product name matches the search query
    if (productName.innerText.toLowerCase().includes(query)) {
      productName.style.display = 'block';
    } else {
      productName.style.display = 'none';
    }
  }

  // Get the category names
  const categoryNames = document.getElementsByClassName('category');
  for (const categoryName of categoryNames) {
    // Check if the category name matches the search query
    if (categoryName.innerText.toLowerCase().includes(query)) {
      categoryName.style.display = 'block';
    } else {
      categoryName.style.display = 'none';
    }
  }

  // Get the blog post titles
  const postTitles = document.getElementsByClassName('post-title');
  for (const postTitle of postTitles) {
    // Check if the blog post title matches the search query
    if (postTitle.innerText.toLowerCase().includes(query)) {
      postTitle.style.display = 'block';
    } else {
      postTitle.style.display = 'none';
    }
  }
});

//icon active
// Get the current page URL
var currentPageUrl = window.location.href;

// Add active class to the cart icon if the current page URL matches
var cartBtn = document.getElementById('cart-btn');
var cartBtnUrl = 'cart.php'; // Replace with the URL associated with the cart icon
if (currentPageUrl.includes(cartBtnUrl)) {
    cartBtn.classList.add('active');
}

var loginBtn = document.getElementById('login-btn');
var loginBtnUrls = ['profile.php', 'order.php'];

// Check if the current page URL matches any of the login icon URLs
var isActive = loginBtnUrls.some(function(url) {
  return currentPageUrl.includes(url);
});

if (isActive) {
  loginBtn.classList.add('active');
}


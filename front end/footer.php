
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenly - Happy plants</title>

    <!-- Code for font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Code for linking css file -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    
<!-- footer section close -->
<section class="footer">
    <div class="box-container">
        <div class="box">
        <h3><i class="fa fa-pagelines"></i> Greenly </h3>
        <p>Feel Free To Follow Us On Our Social Media Handlers All The Links Are Given Below.</p>  
        <div class="share">
            <a href="https://www.facebook.com/don3sani?mibextid=ZbWKwL" class="fa fa-facebook" target="_blank"></a>
            <a href="https://instagram.com/experience_bolte?igshid=NGExMmI2YTkyZg==" class="fa fa-twitter" target="_blank"></a>
            <a href="https://instagram.com/experience_bolte?igshid=NGExMmI2YTkyZg==" class="fa fa-instagram" target="_blank"></a>
            <a href="https://www.linkedin.com/in/anubhav-shah-2643941b4" class="fa fa-linkedin" target="_blank"></a>
        </div>
    </div>

    <div class="box">
        <h3>Contact info</h3>
            <a class="links"><i class="fa fa-phone"></i> 9356263667</a>
            <a class="links"><i class="fa fa-phone"></i> 9356263667</a>
            <a class="links"><i class="fa fa-envelope"></i> Info@example.com</a>
            <a class="links"><i class="fa fa-map-marker"></i> udaipur, Raj.</a>
        </div>

    <div class="box">
        <h3>Quick Links</h3>
            <a href="index.php" class="links"><i class="fa fa-circle"></i> Home</a>
            <a href="product.php" class="links"><i class="fa fa-circle"></i> Products</a>
            <a href="blog.php" class="links"><i class="fa fa-circle"></i> Blogs</a>
            <a href="about.php" class="links"><i class="fa fa-circle"></i> About</a>
            <a href="contact.php" class="links"><i class="fa fa-circle"></i> Contact us</a>
        </div>

        <div class="box">
            <h3>Newslater</h3>
            <p>For plant care tips, our featured plant of the week, exclusive offers and Gifts</p>
            <form id="newsletter-form">
              <input type="email" id="email" name="email" placeholder="Enter your email" class="email">
              <input type="submit" value="Subscribe" class="btn">
              <p id="error-message" style="color: red;"></p>
              <p id="success-message" style="color: green;"></p>
            </form>
            <div class="message"></div>
        </div>
    </div>
    <div class="credit">© 2023, Greenly. Created By <span>Anubhav Shah</span> | All Rights Reserved</div>
</section>
<!-- footer section close -->

<script>
  document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("newsletter-form");
  const emailInput = document.getElementById("email");
  const errorMessage = document.getElementById("error-message");
  const successMessage = document.getElementById("success-message");

  form.addEventListener("submit", function(event) {
    event.preventDefault();

    const emailValue = emailInput.value.trim();

    if (!isValidEmail(emailValue)) {
      errorMessage.textContent = "Please enter a valid email address.";
      successMessage.textContent = "";
    } else {
      errorMessage.textContent = "";

      // Send data to the server using AJAX
      $.ajax({
        url: "process-subscription.php", // your server-side script URL
        method: "POST",
        data: { email: emailValue },
        success: function(response) {
          if (response === "success") {
            alert("Thank you for subscribing!");
            form.reset();
          } else {
            alert("You are subscriber.");
          }
        },
        error: function() {
          alert("There is some error. Please try again later.");
        }
      });
    }
  });

  function isValidEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
  }
});
</script>

<script src="../js/script.js"></script>
</body>
</html>
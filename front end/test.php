<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Slider with Link Buttons</title>
  <style>
  	body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

.slider-container {
  width: 100%;
  height: 500px; /* Set the height of the slider container to your desired value */
  overflow: hidden;
  position: relative;
}

.slider {
  display: flex;
  width: 100%; /* Set the width to accommodate all slides */
}

.slide {
  flex: 0 0 100%;
  position: relative;
}

.slide img {
  width: 100%;
  height: 100%;
  object-fit: cover; /* Set the images to cover the entire slide */
}

.slide-content {
  position: absolute;
  top: 10%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: #fff;
}

.slide-content h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

.slide-content p {
  font-size: 16px;
  max-width: 300px;
  margin: 0 auto;
}

.link-button {
  display: inline-block;
  background-color: #007BFF;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  text-decoration: none;
  margin-top: 10px;
}

.slider-controls {
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  bottom: 20px; /* Adjust the distance from the bottom as needed */
  left: 50%;
  transform: translateX(-50%);
  width: 100%; /* Make sure the controls span the full width of the slider */
}


.prev-btn,
  .next-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: transparent;
    border: none;
    font-size: 24px;
    color: #fff;
    cursor: pointer;
    transition: color 0.3s ease-in-out;
  }

  .prev-btn:hover,
  .next-btn:hover {
    color: #007BFF;
  }


/* Position the previous button */
.prev-btn {
  left: 20px; /* Adjust the distance from the left as needed */
  transform: translateY(-50%);
}

/* Position the next button */
.next-btn {
  right: 20px; /* Adjust the distance from the right as needed */
  transform: translateY(-50%);
}

.dots {
  display: flex;
  justify-content: center;
  margin-top: 10px;
}

.dot {
  width: 10px;
  height: 10px;
  background-color: #bbb;
  border-radius: 50%;
  margin: 0 5px;
  cursor: pointer;
}

.dot.active {
  background-color: #007BFF;
}


  </style>
  
</head>
<body>
  <div class="slider-container">
    <div class="slider">
      <div class="slide">
      <img src="../image/flower2.jpg" alt="Slide 1">
        <div class="slide-content">
        <h2>Slide 1</h2>
      <p>Flat 15% cashback on orders above 1000. We provide free next day delivery on orders received by 7PM.</p>
          <a href="view-product.php?id=5" class="link-button">Link 1</a>
        </div>
      </div>
      <div class="slide">
      <img src="../image/flower3.jpg" alt="Slide 2">
        <div class="slide-content">
        <h2>Slide 2</h2>
      <p>Flat 15% cashback on orders above 1000. We provide free next day delivery on orders received by 7PM.</p>
          <a href="view-product.php?id=16" class="link-button">Link 2</a>
        </div>
      </div>
      <div class="slide">
      <img src="../image/flower4.jpg" alt="Slide 3">
        <div class="slide-content">
        <h2>Slide 3</h2>
      <p>Flat 15% cashback on orders above 1000. We provide free next day delivery on orders received by 7PM.</p>
          <a href="view-product.php?id=15" class="link-button">Link 3</a>
        </div>
      </div>
    </div>
    <button class="prev-btn">&#10094;</button>
      <button class="next-btn">&#10095;</button>
    <div class="slider-controls">
      <div class="dots"></div>
    </div>
  </div>
  <script>




  </script>
</body>
</html>

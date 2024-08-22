<?php include 'header.php'; ?>



<!-- slider -->
<div class="container-slider">
    <div class="slider">
      <div class="slide">
      <img src="../image/Money Plant N Joy.webp" alt="Slide 1">
        <div class="slide-content">
        <h2>Money Plant</h2>
        <p>The Money Plant N’Joy Hanging features variegated glossy <br>heart shaped leaves interspersed on a climbing stem.</p>
        <a href="view-product.php?id=15" class="shp-now">Shop now</a>
        </div>
      </div>
      <div class="slide">
      <img src="../image/Philodendron Oxycardium.webp" alt="Slide 2">
        <div class="slide-content">
        <h2>Philodendron Oxycardium</h2>
        <p>A member of one of the biggest and easiest to grow plant families, <br>the oxycardium golden and green are as apart in looks and as similar in care as two plants could ever be.</p>
        <a href="view-product.php?id=14" class="shp-now">Shop now</a>
        </div>
      </div>
      <div class="slide">
      <img src="../image/Fiddle Leaf Fig Plant.webp" alt="Slide 3">
        <div class="slide-content">
        <h2>Fiddle Leaf Fig Plant</h2>
        <p>The coolest kid on the block at the moment and an Instagram superstar,<br> the Ficus Lyrata or the Fiddle Leaf Fig is a tropical <br>plant that is also a great air purifier. </p>
        <a href="view-product.php?id=5" class="shp-now">Shop now</a>
        </div>
      </div>
      <div class="slide">
      <img src="../image/Elongated Cactus Plant.png" alt="Slide 4">
        <div class="slide-content">
        <h2>Elongated Cactus Plant</h2>
        <p>Good things come in small sizes has never been truer than in <br>the case of the Elongated Variegated  Cactus.</p>
        <a href="view-product.php?id=10" class="shp-now">Shop now</a>
        </div>
      </div>
      <div class="slide">
      <img src="../image/Broken Heart Plant.webp" alt="Slide 5">
        <div class="slide-content">
        <h2>Broken Heart Plant</h2>
        <p>One of the most popular houseplants, and our all-time bestseller, <br>this easy-growing plant with its   heart-shaped <br>leaves is loved for its beautiful fenestrations.</p>
        <a href="view-product.php?id=16" class="shp-now">Shop now</a>
        </div>
      </div>
    </div>
    <button class="slider-prev-btn">&#10094;</button>
      <button class="slider-next-btn">&#10095;</button>
    <div class="slider-controls">
      <div class="dots"></div>
    </div>
  </div>



<!-- Add more filter options here -->
<section class="features">
  <div class="filter-sidebar">
    <h2>Filters</h2>
    <label for="min-price">Price Range:</label>
    <input type="number" id="min-price" placeholder="Min Price" min="1" max="5000">
    <input type="number" id="max-price" placeholder="Max Price" min="1" max="5000">

    <h3>Category:</h3>
    <select id="category-filter"></select>

    <h3>Rating Range:</h3>
    <input type="number" id="rating" placeholder="Rating 1-5" min="1" max="5">

    <button id="filter-button">Apply Filter</button>
    <button id="clear-button">Clear</button>
  </div>

  <div class="product-list">


<?php
$connection = new mysqli('localhost', 'root', '', 'user002');
if ($connection->connect_errno) {
  die('Failed to connect to database: ' . $connection->connect_error);
}

// Fetch products from the database
$query = "SELECT p.*, AVG(r.rating_number) AS average_rating
          FROM products p
          LEFT JOIN ratings r ON p.id = r.product_id
          GROUP BY p.id";
$result = $connection->query($query);
if (!$result) {
  die('Failed to fetch products: ' . $connection->error);
}

// Loop through the fetched products and display them
while ($row = $result->fetch_assoc()) {
  $productId = $row['id'];
  $productName = $row['name'];
  $productImage = $row['image'];
  $productPrice = $row['price'];
  $averageRating = $row['average_rating'];

  echo '<div class="product">';
  echo '<img src="' . $productImage . '" alt="' . $productName . '">';
  echo '<h3>' . $productName . '</h3>';
  echo '<div class="rating">';

  // Fill stars based on the average rating
  echo '<div class="stars">';
  for ($i = 1; $i <= 5; $i++) {
    if ($i <= $averageRating) {
      echo '<span class="star filled">&#9733;</span>';
    } elseif ($i - $averageRating < 1) {
      echo '<span class="star half-filled">&#9733;</span>';
    } else {
      echo '<span class="star">&#9734;</span>';
    }
  }  
  echo '</div>'; // End of stars
  echo '<span class="average-rating-value">' . round($averageRating, 1) . '</span>';
  echo '</div>'; // End of rating
  echo '<span class="price">₹' . $productPrice . '</span>';
  echo '<a href="view-product.php?id=' . $productId . '" class="view-order-button">View Product</a>';
  echo '</div>'; // End of product
}

$connection->close();
?>

</div>
</section>
<div class="product-paragraph">
  <div class="p-border">
  <h2>➡Plants for Sale: Enhance Your Space with Lush Greenery</h2>
  <p>Looking to add a touch of nature to your home or office? Our online nursery offers an impressive selection of plants for sale online. Whether you're a seasoned plant enthusiast or just starting your green journey, we have something for everyone.</p>
  <h2>➡Buy Plants Online: Convenience at Your Fingertips</h2>
  <p>Gone are the days of visiting multiple physical nurseries in search of the perfect plants. With just a few clicks, you can explore our online collection and buy plants online. Our user-friendly website allows you to effortlessly browse through different plant categories, making it easy to find exactly what you're looking for.</p>
  <h2>➡Plant Online Shopping: A Delightful Experience</h2>
  <p>We understand the joy of shopping for plants online, and we aim to make it a delightful experience for you. Our website is designed to provide you with detailed information about each plant, including care instructions, growth habits, and size specifications. This ensures that you can make an informed decision before adding any plant to your cart.</p>
  <h2>➡Online Plants: Your Green Haven Awaits</h2>
  <p>Transform your living spaces into lush green havens with our online plants. Whether you're in search of indoor plants to freshen up your home or outdoor plants to create a vibrant garden, we have a wide range of options to suit your needs. From flowering plants to foliage plants, succulents to bonsai, you'll find a diverse selection to choose from.</p>
  <h2>➡Online Nursery: A Trusted Source for Quality Plants</h2>
  <p>At our online nursery, we prioritize quality and customer satisfaction. We work with trusted growers and suppliers to bring you healthy and thriving plants. Each plant is carefully inspected and packaged to ensure it arrives in perfect condition. Our commitment to excellence has made us a preferred choice for plant enthusiasts across India.</p>
  <h2>➡Buy Live Plants Online: Embrace the Beauty of Nature</h2>
  <p>There's something magical about having live plants in your space. They not only add beauty but also purify the air and promote a sense of tranquility. With our easy-to-use online platform, you can buy live plants online and experience the joy of nature at your fingertips. Choose from our assortment of vibrant and lively plants to create an environment that nourishes your soul.</p>
  <h2>➡Why Plants are important for home?</h2>
  <p>Plants play a vital role in creating a healthy and inviting atmosphere in our homes. Whether you're looking for live bonsai plants online or searching for plants for sale. An online plant nursery is your go-to destination for all your plant needs. Let's explore why plants are important for home use and how online plant shopping can elevate your indoor space.</p>
  <li>◼Improved Air Quality with Spider Plants and Peace Lilies:</li>
  <p>Spider plants (Chlorophytum comosum) and peace lilies (Spathiphyllum) are excellent choices for enhancing indoor air quality. They have the ability to remove harmful toxins like formaldehyde, benzene, and carbon monoxide from the air, promoting a healthier living environment.</p>
  <li>◼Increased Oxygen Levels with Areca Palms and Snake Plants:</li>
  <p>Areca palms (Dypsis lutescens) and snake plants (Sansevieria trifasciata) are known for their ability to release oxygen during the nighttime. Having these plants in your home can help improve the air quality, especially in bedrooms, and provide a fresh and oxygen-rich environment.</p>
  <li>◼Stress Reduction with Lavender and Aloe Vera:</li>
  <p>Lavender (Lavandula) and aloe vera (Aloe barbadensis) are popular plants known for their calming properties. The scent of lavender has a soothing effect, promoting relaxation and better sleep. Aloe vera, with its gel-filled leaves, can be used to alleviate stress and provide a natural remedy for skin conditions.</p>
  <li>◼Enhanced Focus and Productivity with Rosemary and Bamboo Palm:</li>
  <p>Rosemary (Rosmarinus officinalis) and bamboo palm (Chamaedorea seifrizii) are plants that can improve focus and productivity. Rosemary has been associated with improved memory and mental clarity, making it an excellent addition to study or work areas. Bamboo palm helps in reducing stress and increasing productivity by creating a calming atmosphere.</p>
  <li>◼Aesthetically Pleasing Spaces with Orchids and Fiddle Leaf Figs:</li>
  <p>Orchids (Orchidaceae) and fiddle leaf figs (Ficus lyrata) are popular choices for adding beauty to your home. Orchids come in a variety of colors and bloom for an extended period, bringing elegance and grace to any space. Fiddle leaf figs have large, glossy leaves that make a striking statement, adding a touch of drama and sophistication to your interior decor.</p>
  <li>◼Natural Humidifiers with Boston Ferns and English Ivy:</li>
  <p>Boston ferns (Nephrolepis exaltata) and English ivy (Hedera helix) are excellent choices for increasing humidity levels in your home. These plants release moisture into the air through their leaves, making them natural humidifiers. They can help alleviate dry skin, respiratory issues, and reduce the likelihood of allergies.</p>
  <li>◼Live Bonsai Plants Online: Captivating Beauty in Miniature Form</li>
  <p>Bonsai plants are miniature masterpieces that bring a sense of serenity and elegance to any space. They are known for their artistic growth patterns and meticulous care requirements. With the availability of live bonsai plants online, you can now own these captivating creations and enhance the aesthetic appeal of your home.</p>
  <li>◼Online Plant Nursery: Access Nature's Best from Anywhere</li>
  <p>Gone are the days of physically visiting nurseries to find the perfect plants for your home. With the advent of online plant nurseries, you can conveniently browse through an extensive collection of plants from the comfort of your own space. Online plant shopping offers a user-friendly experience, allowing you to explore different plant categories, read detailed descriptions, and choose the ideal plants for your home.<br>
Living in India, you have the advantage of accessing an online plant nursery that caters specifically to your needs. Ugaoo- An Online plant nursery India platforms offer a diverse range of plants suitable for Indian climates, ensuring that you find the perfect plants that thrive in your local environment. With just a few clicks, you can have high-quality plants delivered to your doorstep, regardless of your location.</p>
<h2>➡Where to Keep Plants in Your Home?</h2>
<p>When it comes to keeping plants in your home, it's important to find the right spot for them to thrive. If you've purchased natural plants online from an online plant nursery in India, consider their light requirements. Place them in areas with appropriate lighting, whether it's direct sunlight or indirect light. Evaluate temperature and humidity levels, avoiding extreme fluctuations. Take into account the available space and avoid overcrowding. Lastly, incorporate plants into your home's decor, using them as focal points to create an inviting and vibrant atmosphere. With these tips, your plants will flourish and enhance your living space.</p>
<h2>➡Indoor Plants Online: Bring Nature Inside</h2>
<p>Indoor plants have gained immense popularity due to their ability to thrive in indoor environments with limited sunlight. They not only add a refreshing aesthetic appeal but also purify the air by removing toxins and releasing oxygen. With the convenience of shopping for indoor plants online, you can explore a vast selection and choose the perfect ones for your home.</p>
<h2>➡Live Plants Online: A Convenient Green Solution</h2>
<p>Gone are the days of visiting physical nurseries to find live plants. With the availability of live plants online, you can conveniently browse through different types of plants from the comfort of your home. From low-maintenance succulents to elegant ferns, there's a wide range of live plants to choose from, catering to different preferences and skill levels.
If you're located in India, finding live plants online is even easier. Ugaoo offers a diverse selection of live plants specifically curated for Indian customers. Whether you're in Mumbai, Delhi, Bangalore, or any other city, you can easily access Ugaoo’s live plants online in India and have them delivered to your doorstep.</p>

</div>

<div class="container-p">

  <h2>FAQs</h2>

  <div class="accordion">
    <div class="accordion-item">
      <a>Why are my houseplants getting brown tips on their leaves?</a>
      <div class="content-p">
        <p>This is generally an indication of poor watering habits. The best way to water your online plant is to thoroughly flush it until water runs freely out the drainage holes. Shallow watering can cause browning of tips.</p>
      </div>
    </div>
    <div class="accordion-item">
      <a>How do I use the self-watering pot?</a>
      <div class="content-p">
        <p>Water as you usually water from the top. In the case of the Self Watering Planter from plant online shopping, excess water will get stored in the reservoir below, the soil then absorbs water via capillary action and the plants get water as and when required.</p>
      </div>
    </div>
    <div class="accordion-item">
      <a>Why is my plant not growing? / How do I boost my plant’s growth?</a>
      <div class="content-p">
        <p>You can use an organic fertilizer like seaweed extract (Plan-tonic) or cow manure every two weeks to boost the growth of the plant. Also, make sure you clean the leaves with a damp towel once in a while to clear the dust and examine closely for any pests.</p>
      </div>
    </div>
    <div class="accordion-item">
      <a>Why is my plant not flowering?</a>
      <div class="content-p">
        <p>Nutrient deficiency can be a major reason for the nonflowering of plants. Below are some basic tips you need to follow to encourage flowering while deciding to buy plant online: 1. Use rich soil. Soil that is light and rich in compost or manure provides plenty of nutrients constantly to the plants. 2. Remove the old faded or dried out flowers as they consume the energy requirement for new flowers 3. Fertilize the plants with a good organic fertilizer like cow manure every 14 days 4. Do mulching every month and provide proper watering</p>
      </div>
    </div>
    <div class="accordion-item">
      <a>How do I take care of succulents?</a>
      <div class="content-p">
        <p>Make sure your succulents from an online nursery get enough light. Water according to the season and most importantly avoid overwatering as succulents are hardy plants. Water the soil directly without letting water stagnate on succulents. Use a potting mix with good drainage meaning so that water is not retained in the soil for long.</p>
      </div>
    </div>
  </div>
  
</div>

</div>
  <script src="../js/script2.js"></script>
<?php include 'footer.php'; ?>
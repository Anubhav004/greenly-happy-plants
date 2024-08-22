-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2024 at 04:29 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user002`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `sno` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`sno`, `email`, `name`, `password`, `date`) VALUES
(1, 'abc@gmail.com', 'Anubhav shah', '1234', '2023-07-16 14:08:09'),
(2, 'a@gmail.com', 'pritam kumar', '1234', '2023-07-16 14:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `featured_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `content`, `author`, `date`, `featured_image`) VALUES
(1, 'Vertical Gardening in the Monsoon: Maximising Space and Greenery', '<p>The monsoon season in India brings with it a refreshing change after the scorching summer heat. The sound of raindrops, the earthy smell, and the lush green landscapes create a mesmerising ambiance. As gardening enthusiasts, this is the perfect time to embrace the beauty of monsoon and maximise the greenery even in limited space. In this blog, we will explore the fascinating world of vertical gardening, a creative and space-efficient way to grow plants vertically. Whether you have a small balcony, terrace, or even an indoor space, vertical gardening allows you to bring the joy of gardening into your life. Let us dive in and discover the wonders of vertical gardening in the monsoon.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>The Magic of Monsoon and Gardening</h2>\r\n\r\n<p>The monsoon season is a time of rejuvenation for nature. The rainfall replenishes the soil, making it fertile and perfect for planting. The lush greenery that surrounds us during this season is truly a sight to behold. The beauty of the monsoon can be captured in our own homes through vertical gardening. By utilising vertical space, we can create stunning green walls and hanging gardens that evoke a sense of love and appreciation for the monsoon season.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>◼Benefits of Vertical Gardening</strong></h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>Maximising Space with Vertical Gardening</strong></h3>\r\n\r\n<p>In densely populated areas like India, space is a luxury. Vertical gardening allows you to make the most of your limited space. By utilising walls, fences, or even creating vertical structures, you can grow a variety of plants without taking up valuable floor space. Whether you live in an apartment or a small house, vertical gardening offers a solution to cultivate your own green oasis.</p>\r\n\r\n<h3><strong>Enhancing Aesthetics with Vertical Gardens</strong></h3>\r\n\r\n<p>Vertical gardens are not just practical but also visually appealing. They add a touch of beauty and serenity to any space. The vibrant colours of flowers, the cascading leaves of vines, and the unique textures of succulents create a stunning visual display. You can customise your vertical garden to suit your personal style and preferences, turning a plain wall into a living work of art.</p>\r\n\r\n<h2><strong>◼Best Plants for Vertical Gardens in the Monsoon</strong></h2>\r\n\r\n<h3>Vertical Succulent Garden</h3>\r\n\r\n<p>Succulents are the perfect choice for vertical gardens, especially during the monsoon season. These low-maintenance plants can store water in their leaves, making them drought-tolerant and ideal for Indian weather conditions. Some popular succulents for vertical gardening include&nbsp;Aloe vera,&nbsp;Echeveria,&nbsp;Sedum, and&nbsp;Crassula. Their unique shapes and vibrant colours will add a touch of elegance to your vertical garden.</p>\r\n\r\n<h3>Vertical Growing Plants for Monsoon</h3>\r\n\r\n<p>When it comes to choosing plants for vertical gardening during the monsoon, it is important to select varieties that thrive in the Indian climate. Some excellent choices include ferns, mosses, and climbers such as&nbsp;Money Plant,&nbsp;English Ivy,&nbsp;Philodendron, and&nbsp;Spider Plant. These plants not only add greenery but also help in purifying the air, creating a healthier living environment.</p>\r\n\r\n<h2><strong>◼Tips for Successful Vertical Gardening</strong></h2>\r\n\r\n<h3>Light and Water Requirements</h3>\r\n\r\n<p>Proper lighting is essential for the success of any garden. When choosing a location for your vertical garden, ensure that it receives sufficient sunlight. However, excessive rainfall during the monsoon can lead to waterlogging, which can be detrimental to your plants. Make sure to provide adequate drainage to prevent water stagnation and use a well-draining soil mix. Regularly check the moisture levels and adjust watering accordingly.</p>\r\n\r\n<h3>Maintenance and Care</h3>\r\n\r\n<p>Vertical gardens require regular maintenance to keep them healthy and thriving. Prune the plants as needed to maintain their shape and prevent overgrowth. Monitor for pests and diseases and take appropriate measures to control them. Regularly fertilise your plants with organic fertilisers to provide them with the necessary nutrients. Stay connected with your vertical garden and enjoy the process of nurturing and watching it flourish.&nbsp;</p>\r\n\r\n<h2>Vertical Gardening Indoors</h2>\r\n\r\n<p>Vertical gardening is not limited to outdoor spaces. It can also be successfully implemented indoors. Whether you have a small apartment or limited floor space, vertical gardening indoors allows you to enjoy the benefits of greenery and maximise space efficiency. Choose&nbsp;<a href=\"http://localhost/major%20project/greeenly/front%20end/product.php\">plants</a>&nbsp;that thrive in low light conditions such as&nbsp;Pothos,&nbsp;Peace Lily, or&nbsp;Snake Plant. Install vertical structures or&nbsp;hanging pots&nbsp;to create a captivating indoor garden that brings the beauty of monsoon inside your home.</p>\r\n\r\n<p><img alt=\"\" src=\"http://localhost/major%20project/greeenly/uploads/1319791299.png\" style=\"height:250px; margin-left:200px; margin-right:200px; width:600px\" /></p>\r\n\r\n<p>As the raindrops fall and the earth comes alive during the monsoon season, vertical gardening presents a wonderful opportunity to connect with nature and maximise the greenery around us. By embracing the concept of vertical gardening, we can create stunning living walls, hanging gardens, and indoor spaces that evoke a sense of love and appreciation for the beauty of monsoon. Whether you are a gardening enthusiast or a novice, vertical gardening in the monsoon is a delightful journey of nurturing and watching your plants thrive. So, let us embrace the magic of the monsoon and create our own vertical oasis to cherish and enjoy for years to come.</p>\r\n', 'Anubhav Shah', '2023-07-16 00:00:00', '../image/Screenshot (142).png'),
(2, 'Hosta Plants: Varieties, Care & Tips for Stunning Gardens', '<p>Hosta plants, also known as plantain lilies, are versatile perennials that add beauty and elegance to any garden. With their wide range of varieties and captivating foliage, Hosta&#39;s are a favorite among gardeners. Whether you&#39;re a novice or an experienced gardener, this comprehensive guide will provide valuable insights into Hosta plants, including care tips and advice for successful growth. From exploring Hosta varieties to finding Hostas for sale, we&#39;ll cover everything you need to know about these stunning plants.</p>\r\n\r\n<h2><strong>◼Types of Hosta Plants</strong></h2>\r\n\r\n<p>Hosta plants come in a wide variety of sizes, leaf shapes, colors, and patterns. Let&#39;s explore some of the most popular types of hostas:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>Miniature Hostas:</strong></h3>\r\n\r\n<p>Miniature hostas are perfect for small gardens or containers. They typically grow up to 6 inches in height and form compact clumps.</p>\r\n\r\n<p><img alt=\"\" src=\"../uploads/1167103019.png\" style=\"height:296px; margin-left:150px; margin-right:150px; width:413px\" /></p>\r\n\r\n<h3><strong>►Small Hostas:</strong></h3>\r\n\r\n<p>Small hostas are slightly larger than miniatures, reaching heights of 6 to 12 inches. They are versatile and work well in borders or as edging plants. &#39;June&#39; is a well-known small hosta with blue-green leaves edged in yellow, while &#39;Stiletto&#39; features slender, lance-shaped green leaves.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>►Medium Hostas:</strong></h3>\r\n\r\n<p>Medium hostas are popular choices for garden beds and borders. They typically grow between 12 and 18 inches in height. &#39;Francee&#39; is a classic medium-sized hosta with dark green leaves and white margins. &#39;Sagae&#39; is another notable variety with large, heavily textured blue-green leaves and creamy yellow margins.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>►Large Hostas:</strong></h3>\r\n\r\n<p>Large hostas make a bold statement in any garden. They can reach heights of 18 to 30 inches or more. &#39;Sum and Substance&#39; is a standout large hosta with gigantic chartreuse leaves that can grow up to 2 feet long. &#39;Empress Wu&#39; is renowned for its huge, dark green foliage and impressive size.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>►Giant Hostas:</strong></h3>\r\n\r\n<p>Giant hostas are the kings of the hosta world, reaching heights of 30 inches or more. These majestic plants create a dramatic focal point in larger gardens. &#39;Blue Angel&#39; is a beloved giant hosta with large, blue-gray leaves that can span over 18 inches in width. &#39;Komodo Dragon&#39; is another impressive giant hosta with deeply veined, dark green leaves.</p>\r\n\r\n<p><img alt=\"\" src=\"../uploads/547766026.png\" style=\"height:267px; margin-left:150px; margin-right:150px; width:418px\" /></p>\r\n\r\n<h3><strong>►Variegated Hostas:</strong></h3>\r\n\r\n<p>Variegated hostas are prized for their stunning leaf patterns and colors. They can be found in various sizes, from miniatures to giants. Examples include &#39;Patriot&#39; with its bold, dark green leaves edged in creamy white and &#39;Golden Tiara&#39; with its green leaves splashed with bright yellow.</p>\r\n\r\n<p><img alt=\"\" src=\"../uploads/336028218.png\" style=\"height:274px; margin-left:150px; margin-right:150px; width:414px\" /></p>\r\n\r\n<h3><strong>►Fragrant Hostas:</strong></h3>\r\n\r\n<p>Fragrant hostas add an additional sensory delight to the garden. These hostas produce sweetly scented flowers that can perfume the air. &#39;Guacamole&#39; is a popular fragrant hosta with large chartreuse leaves and lavender flowers, while &#39;Royal Standard&#39; features medium-sized green leaves and white fragrant blooms.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>►Edger Hostas:</strong></h3>\r\n\r\n<p>Edger hostas are low-growing varieties perfect for lining pathways or garden borders. They form neat mounds and often have attractive foliage. &#39;Golden Scepter&#39; is a compact edger hosta with bright gold leaves, while &#39;Curly Fries&#39; displays narrow, tightly ruffled leaves in a unique twist.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>◼How to Plant &amp; Care for Plantain Lilies</strong></h2>\r\n\r\n<p>To plant plantain lilies, commonly known as hostas, and encourage healthy growth and beautiful hosta flowers, follow these steps:</p>\r\n\r\n<p><img alt=\"\" src=\"../uploads/1364600129.png\" style=\"height:272px; margin-left:150px; margin-right:150px; width:513px\" /></p>\r\n\r\n<h3><strong>✅Choose an Ideal Location:&nbsp;</strong></h3>\r\n\r\n<p>Select a planting site that offers partial to full shade, as hostas prefer these light conditions. Ensure the area has well-draining soil and is away from areas prone to strong winds.</p>\r\n\r\n<h3><strong>✅Prepare the Soil:&nbsp;</strong></h3>\r\n\r\n<p>Before planting, prepare the soil by removing any weeds, rocks, or debris. Loosen the soil using a garden fork or tiller to a depth of about 12 inches. Incorporate organic matter like compost or well-rotted manure to improve soil fertility and drainage.</p>\r\n\r\n<h3><strong>✅Dig the Planting Hole:</strong></h3>\r\n\r\n<p>&nbsp;Dig a hole that is wide and deep enough to comfortably accommodate the hosta&#39;s root ball. The hole should be slightly larger than the size of the container or the spread of the plant&#39;s roots.</p>\r\n\r\n<h3><strong>✅Plant the Hosta:&nbsp;</strong></h3>\r\n\r\n<p>Gently remove the hosta from its container or handle the root ball with care. Place the plant in the center of the hole, ensuring that the crown (where the leaves meet the roots) is level with or slightly above the soil surface.</p>\r\n\r\n<h3><strong>✅Backfill the Hole:&nbsp;</strong></h3>\r\n\r\n<p>Fill the hole around the hosta with the amended soil, gently firming it to eliminate air pockets. Avoid compacting the soil too tightly, as it can hinder root growth. Leave a slight depression around the plant to help retain water.</p>\r\n\r\n<h3><strong>✅Water Thoroughly:</strong></h3>\r\n\r\n<p>&nbsp;After planting, water the hosta thoroughly to settle the soil and ensure good root-to-soil contact. Keep the soil evenly moist during the first few weeks, as hostas prefer consistent moisture. Water deeply rather than shallowly to encourage deep root development.</p>\r\n\r\n<h3><strong>✅Mulch the Area:&nbsp;</strong></h3>\r\n\r\n<p>Apply a layer of organic mulch, such as shredded bark or compost, around the base of the plant. Mulching helps retain soil moisture, suppresses weed growth, and regulates soil temperature. Leave a small space around the plant&#39;s crown to prevent rot.</p>\r\n\r\n<h3><strong>✅Provide Adequate Care:&nbsp;</strong></h3>\r\n\r\n<p>Hostas are relatively&nbsp;<a href=\"http://localhost/major%20project/greeenly/front%20end/product.php\">low-maintenance plants</a>, but a few care practices can enhance their growth. Regularly water the plant, especially during dry spells, ensuring that the soil remains consistently moist but not waterlogged. Apply a balanced slow-release fertilizer in early spring to provide necessary nutrients. Remove any weeds that compete with the hosta for nutrients and water.</p>\r\n\r\n<h3><strong>✅Encourage Hosta Flowers:&nbsp;</strong></h3>\r\n\r\n<p>Most hosta varieties produce beautiful flowers in summer. To encourage blooming, ensure the plants receive adequate sunlight, as too much shade can limit flower production. Additionally, remove any spent flowers or seed pods to redirect the plant&#39;s energy towards foliage and future blooms.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>By following these planting and care instructions, you can enjoy the beauty of hosta flowers and foster healthy growth in your plantain lilies (hostas).</p>\r\n', 'Anubhav Shah', '2023-07-16 00:00:00', '../image/Screenshot (143).png'),
(3, 'A Guide to Creating a Vertical Garden in Mumbai Apartments', '<p>In the concrete jungle of Mumbai, where space is at a premium, creating a green oasis in your apartment may seem like a distant dream. However, with the rise of vertical gardening, you can transform your living space into a lush paradise. Vertical gardens, also known as wall gardens or greenwalls, are a smart solution for apartment dwellers who want to enjoy the beauty of nature within the constraints of limited space. In this blog post, we will provide you with a comprehensive guide to creating a vertical garden in your Mumbai apartment. We will explore different types of vertical planters, discuss the benefits of living walls, and even suggest small&nbsp;indoor plants&nbsp;that are perfect for vertical gardens.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>📌Understanding Vertical Gardens:</h2>\r\n\r\n<p>Before diving into the practical aspects of creating a vertical garden, it&#39;s essential to understand what it is and how it works. A vertical garden is a method of growing&nbsp;plants&nbsp;vertically, utilizing walls or other vertical surfaces. These gardens can be indoor or outdoor, depending on the available space and your preferences. The plants are typically grown in specialized vertical garden planters, which provide a framework for the plants to grow vertically.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>📌Selecting the Right Vertical Garden Planter :</h2>\r\n\r\n<p>Choosing the right vertical garden planter is crucial for the success of your project. There are various options available, ranging from pocket planters to modular systems. Pocket planters are perfect for small indoor plants and are easy to install, making them an ideal choice for apartment dwellers. On the other hand, modular systems allow for more flexibility and can accommodate a larger variety of&nbsp;plants. Consider the available space, sunlight exposure, and your desired plant selection when selecting a vertical garden planter.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>Buy&nbsp;Ceramic Planters Online</strong></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>📌</strong>Benefits of Vertical Garden In Mumbai Apartments :</h2>\r\n\r\n<p>Vertical gardens offer numerous benefits beyond their aesthetic appeal. Firstly, they maximize the use of space, allowing you to create a garden even in the smallest of apartments. Additionally, they act as natural insulation, reducing heat and noise levels within your living space. Vertical gardens also improve air quality by absorbing carbon dioxide and releasing oxygen, making your apartment healthier and more pleasant. Furthermore, these living walls can provide a sense of tranquility and well-being, promoting relaxation and reducing stress.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>►</strong>Space Optimization:</h3>\r\n\r\n<p>Vertical gardens are an excellent solution for maximizing limited space. In a city like Mumbai, where apartment sizes are often compact, vertical gardens allow you to make the most of your available space. By utilizing vertical surfaces such as walls, balconies, or terrace railings, you can create a lush green environment without sacrificing valuable floor space.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>►</strong>Improved Air Quality:</h3>\r\n\r\n<p>Mumbai&#39;s urban environment is notorious for pollution and limited green spaces. Vertical gardens act as natural air purifiers by absorbing carbon dioxide and releasing oxygen. They help mitigate the impact of air pollution and contribute to a healthier living environment. The plants in vertical gardens also filter and reduce airborne toxins, providing cleaner and fresher indoor air for you and your family.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>►</strong>Enhanced Aesthetics:</h3>\r\n\r\n<p>Vertical gardens add a touch of natural beauty and serenity to your apartment. The lush greenery and vibrant colors of plants create a visually appealing environment that can uplift your mood and provide a sense of tranquility. Whether you choose to have a small vertical garden on your balcony or a larger installation covering an entire wall, it will undoubtedly become a focal point and conversation starter among your guests.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>►</strong>Noise Reduction:</h3>\r\n\r\n<p>Living in a bustling city like Mumbai means dealing with constant noise pollution. Vertical gardens act as natural sound barriers, absorbing and reducing noise levels. The plants absorb and reflect sound waves, helping to create a quieter and more peaceful living space. This can be particularly beneficial for apartments located near busy streets or areas with high noise levels.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>►</strong>Temperature Regulation:</h3>\r\n\r\n<p>Mumbai&#39;s tropical climate often brings high temperatures and humidity. Vertical gardens help in regulating indoor temperatures by providing natural insulation. The plants create a cooling effect through the process of evapotranspiration, reducing the need for excessive air conditioning. This not only helps in lowering energy consumption but also contributes to a more comfortable and sustainable living environment.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>►</strong>Eco-Friendly Solution:</h3>\r\n\r\n<p>Vertical gardens are an eco-friendly choice for apartment dwellers. They promote biodiversity by attracting birds, butterflies, and beneficial insects, creating a mini-ecosystem within your living space. Additionally, vertical gardens help combat the urban heat island effect by reducing surface temperatures and absorbing greenhouse gases, thus contributing to a greener and more sustainable cityscape.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>📌Choosing Small Indoor Plants:</h2>\r\n\r\n<p>When it comes to selecting plants for your vertical garden, consider small indoor plants that thrive in Mumbai&#39;s climate. Some popular choices include&nbsp;snake plants, pothos,&nbsp;ferns, and&nbsp;succulents. These plants are known for their adaptability, low maintenance requirements, and ability to thrive in various light conditions. You can easily find a wide range of indoor plants at <a href=\"http://localhost/major%20project/greeenly/front%20end/product.php\">Greenly.com</a>.</p>\r\n\r\n<p><img alt=\"\" src=\"../uploads/1755386418.png\" style=\"height:272px; margin-left:150px; margin-right:150px; width:518px\" /></p>\r\n\r\n<p>Creating a vertical garden in your Mumbai apartment is an innovative way to bring nature into your living space. With the right vertical garden planter and carefully selected small indoor plants, you can transform a blank wall into a green sanctuary. Not only does a vertical garden enhance the aesthetic appeal of your apartment, but it also offers numerous benefits, such as space optimization, improved air quality, and a sense of tranquility. So, embrace the beauty of vertical gardening and enjoy the green oasis within the confines of your Mumbai apartment.</p>\r\n', 'Anubhav Shah', '2023-07-16 00:00:00', '../image/Screenshot (144).png'),
(4, 'Unveiling the Marvelous Insulin Plant: Care, Benefits, and Varieties', '<p>The insulin plant, scientifically known as Costus igneus, is a remarkable herb that has gained significant attention due to its potential health benefits. Its distinctively shaped leaves and unique properties have made it a subject of interest for herbal enthusiasts and researchers alike. In this article, we will explore the various aspects of the insulin plant, including its care requirements, remarkable health benefits, and different varieties.</p>\r\n\r\n<h2><br />\r\n◼Insulin Plant Care :</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>🔹Selecting the right location:</h3>\r\n\r\n<p>The insulin plant thrives in warm and humid climates, making it ideal for regions with temperatures ranging between 70 to 100&deg;F (21 to 38&deg;C). It requires a partially shaded area to protect it from direct sunlight.</p>\r\n\r\n<h3>🔹Soil requirements:</h3>\r\n\r\n<p>Well-draining soil enriched with organic matter is essential for the insulin plant&#39;s growth. A pH level of 6 to 7 is ideal for optimal growth.</p>\r\n\r\n<h3>🔹Watering:</h3>\r\n\r\n<p>Consistent moisture is crucial for the insulin plant. Water it regularly, ensuring the soil is evenly moist but not waterlogged. However, avoid overwatering, as it can lead to root rot.</p>\r\n\r\n<h3>🔹Fertilization:</h3>\r\n\r\n<p>Apply a balanced organic fertilizer once every two months during the growing season to promote healthy growth.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>Buy&nbsp;Fertilizers&nbsp;</strong></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>🔹Propagation:</h3>\r\n\r\n<p>Insulin plants can be propagated through stem cuttings. Select healthy stems with at least two nodes and place them in a well-draining potting mix.</p>\r\n\r\n<h2><br />\r\n◼Insulin Plant Benefits:</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Let&#39;s delve into&nbsp;insulin plant health benefits.</p>\r\n\r\n<h3>✅Blood sugar regulation:</h3>\r\n\r\n<p>The insulin plant has been traditionally used for its potential in regulating blood sugar levels. It is believed to stimulate insulin production and improve insulin sensitivity, making it beneficial for individuals with diabetes.</p>\r\n\r\n<h3><br />\r\n✅Antioxidant properties:</h3>\r\n\r\n<p>The leaves of the insulin plant are rich in antioxidants, such as flavonoids and phenolic compounds. These antioxidants help combat oxidative stress, reduce inflammation, and protect the body against various diseases.</p>\r\n\r\n<h3><br />\r\n✅Digestive health:</h3>\r\n\r\n<p>Consuming insulin plant leaves may aid in digestion, relieve stomach discomfort, and improve bowel movements. It is often used to alleviate digestive disorders such as constipation and indigestion.</p>\r\n\r\n<h3>✅Anti-inflammatory effects:</h3>\r\n\r\n<p>The insulin plant possesses anti-inflammatory properties, which can help reduce inflammation in the body. This property makes it potentially useful in managing conditions like arthritis and inflammatory bowel disease.</p>\r\n\r\n<h3>✅Immune system support:</h3>\r\n\r\n<p>Regular consumption of insulin plant leaves may strengthen the immune system, thanks to its high vitamin C content. It helps boost the body&#39;s defenses against infections and illnesses.</p>\r\n\r\n<h2><br />\r\n<img alt=\"insulin\" src=\"https://cdn.shopify.com/s/files/1/0579/7924/0580/files/insulin.._480x480.jpg?v=1688115075\" style=\"margin-left:150px; margin-right:150px\" /></h2>\r\n\r\n<h2>◼Varieties of Insulin Plant</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>➡Costus igneus var. spiralis:</h3>\r\n\r\n<p>This variety is known for its spiraling leaves, which add an intriguing visual appeal to the plant. It shares similar health benefits with the common insulin plant variety.</p>\r\n\r\n<h3>➡Costus igneus var. compactus:</h3>\r\n\r\n<p>This compact variety of insulin plant features smaller leaves and a more compact growth habit. It is a suitable option for those with limited space.</p>\r\n\r\n<h3>➡Costus igneus var. Albus:</h3>\r\n\r\n<p>Unlike the traditional green leaves of insulin plants, this variety has white leaves. It possesses the same medicinal properties and can be a captivating addition to any garden.</p>\r\n\r\n<h3><strong>Buy&nbsp;Medicinal Plants</strong></h3>\r\n\r\n<p>&nbsp;<br />\r\nThe insulin plant, with its care requirements, impressive health benefits, and various intriguing varieties, offers a unique addition to both indoor and outdoor gardens. From its potential in blood sugar regulation to its antioxidant and anti-inflammatory properties, this herb has captured the attention of many seeking natural remedies. Whether you are a gardening enthusiast or someone interested in herbal remedies, the insulin plant is undoubtedly a fascinating choice to explore.</p>\r\n', 'Anubhav Shah', '2023-07-16 00:00:00', '../image/Screenshot (145).png'),
(6, 'The Benefits of Using Basket Planters in Your Gardening Routine', '<p>When it comes to gardening, incorporating basket planters into your routine can be a game-changer. These versatile and convenient planters provide numerous benefits, from maximizing space to adding visual appeal. In this article, we will explore the advantages of using basket planters in your gardening endeavors. Whether you&#39;re a seasoned gardener or a novice, incorporating hanging basket plants into your outdoor space is a smart choice. Let&#39;s delve into the benefits and learn how to make the most of these fantastic planters.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>1. Maximizing Space with&nbsp;Hanging Basket Plants</h2>\r\n\r\n<p>One of the primary advantages of using basket planters is their ability to maximize space in your garden. If you have limited space, hanging baskets are a practical solution. By suspending your plants from hooks or brackets, you can utilize vertical space, allowing you to grow a wide variety of plants without cluttering the ground. This is especially beneficial for small gardens, balconies, or even indoor spaces.</p>\r\n\r\n<h2>2. Enhancing Visual Appeal with&nbsp;Hanging Planters</h2>\r\n\r\n<p>Hanging planters add an aesthetic touch to any garden. They introduce a sense of height and dimension, creating visual interest in both indoor and outdoor spaces. By utilizing different hanging basket plants, you can incorporate a variety of colors, textures, and shapes into your garden design. Whether you prefer vibrant flowers, cascading vines, or lush green foliage, there&#39;s a hanging planter option to suit your taste and enhance the overall beauty of your garden.</p>\r\n\r\n<h2>3. Versatility and Flexibility</h2>\r\n\r\n<p>Hanging basket plants offer unparalleled versatility and flexibility in gardening. With a vast array of plant options available, you can easily experiment and diversify your garden. Mix and match different plants in a single basket or create captivating combinations by hanging multiple planters at various heights. This versatility allows you to customize your garden to your specific preferences and create unique displays throughout the seasons.</p>\r\n\r\n<h2>4. Easy Maintenance and Watering</h2>\r\n\r\n<p>Maintaining hanging basket plants is relatively straightforward. The elevated position of the planters makes them easily accessible, reducing strain on your back and knees while tending to your plants. Additionally, watering hanging plants is convenient, as you can easily reach them with a watering can or hose. Some hanging basket planters even come with built-in reservoirs, providing a self-watering feature that ensures consistent hydration for your plants.</p>\r\n\r\n<h2>5. Pest and Disease Control</h2>\r\n\r\n<p>Another advantage of using basket planters is the improved control over pests and diseases. By elevating your plants, you reduce the risk of ground-dwelling pests, such as snails and slugs, damaging your precious foliage. Additionally, hanging basket plants receive better air circulation, minimizing the risk of fungal diseases caused by excessive moisture. This control over pests and diseases helps maintain the health and vitality of your plants.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>How to Use&nbsp;Basket Planters: Tips and Ideas</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>➡Choosing the Right Hanging Planters:</h3>\r\n\r\n<p>Select sturdy, well-constructed baskets made from materials such as wire, plastic, or natural fibers like coir or moss. Consider the weight of the plants you intend to use and ensure the chosen planter can support them.</p>\r\n\r\n<h3>➡Selecting Suitable Plants:</h3>\r\n\r\n<p>Opt for plants that thrive in container gardening and are well-suited for hanging conditions. Some popular choices include petunias, fuchsias, trailing ivy, and&nbsp;herbs&nbsp;like thyme or trailing rosemary.</p>\r\n\r\n<h3>➡Placement and Hanging:</h3>\r\n\r\n<p>Choose appropriate locations for your hanging basket plants, considering factors such as sunlight requirements and wind exposure. Install sturdy hooks or brackets to hang your planters securely.</p>\r\n\r\n<h3>➡Watering and Feeding:</h3>\r\n\r\n<p>Regularly monitor the moisture levels of your hanging plants and water them accordingly. Incorporate a balanced liquid fertilizer into your routine to provide essential nutrients for healthy growth.<br />\r\n<br />\r\n<br />\r\n<br />\r\n<img alt=\"basket planter\" src=\"https://cdn.shopify.com/s/files/1/0579/7924/0580/files/hanging_basket_planter_480x480.jpg?v=1688644568\" style=\"margin-left:150px; margin-right:150px\" /><br />\r\n<br />\r\n<br />\r\nIncorporating basket planters into your gardening routine offers a multitude of benefits. From maximizing space to enhancing visual appeal, these versatile planters provide an excellent solution for any garden, regardless of size or location. With the ability to grow a diverse range of plants and the ease of maintenance they offer, hanging basket plants are an ideal choice for both experienced and novice gardeners. So, why not elevate your gardening game and enjoy the beauty and advantages of using basket planters in your outdoor space? Get creative, explore different plant options, and transform your garden into a stunning display of hanging planters.</p>\r\n', 'Anubhav Shah', '2023-07-16 07:05:02', '../image/Screenshot (153).png'),
(7, '6 Best Low-Maintenance Plants For Your Retail Space', '<p>Creating an inviting and aesthetically pleasing environment in your retail space is crucial for attracting customers and enhancing their overall shopping experience. Incorporating greenery into your store not only adds a touch of natural beauty but also offers numerous benefits, such as improved air quality and a calming atmosphere. However, maintaining plants in a bustling retail environment can be challenging. Thankfully, there are several&nbsp;low-maintenance indoor plants&nbsp;that can thrive in retail spaces with minimal care and attention. In this blog, we&#39;ll explore six of the best low-maintenance plants for your retail space and discuss how decorative&nbsp;plant pots, plants&nbsp;fertilizer, and&nbsp;hanging plants&nbsp;can elevate the ambiance.</p>\r\n\r\n<h2>▶Why you should keep&nbsp;plants&nbsp;at your retail space?</h2>\r\n\r\n<p>Incorporating plants into your retail space can offer a multitude of benefits that positively impact both your business and your customers. Here are several compelling reasons why you should consider keeping plants in your store.</p>\r\n\r\n<ul>\r\n	<li>Plants enhance the ambiance and aesthetics of your retail space, creating a welcoming and visually appealing environment.</li>\r\n	<li>They have a calming effect, reducing stress and anxiety for both customers and employees.</li>\r\n	<li>Plants act as natural air purifiers, improving the air quality by removing toxins and releasing oxygen.</li>\r\n	<li>The improved air quality creates a healthier atmosphere, contributing to the overall well-being of individuals.</li>\r\n	<li>Incorporating plants into your store helps differentiate your brand and leaves a lasting impression on customers.</li>\r\n	<li>It shows that you prioritize customer well-being and care about providing an exceptional shopping experience.</li>\r\n	<li>Having plants in your retail space can increase dwell time and encourage customers to spend more time in your store.</li>\r\n	<li>The calming effect of greenery entices customers to explore and linger, leading to higher sales and improved customer engagement.</li>\r\n	<li>The presence of plants creates a positive atmosphere, enhancing customer satisfaction and increasing the likelihood of repeat visits.</li>\r\n	<li>Overall, incorporating plants into your retail space offers multiple benefits, including improved ambiance, reduced stress, better air quality, brand differentiation, and increased customer satisfaction and sales.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"https://cdn.shopify.com/s/files/1/0579/7924/0580/files/shot-panoramic-composition-library_480x480.jpg?v=1686658213\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>▶&nbsp;Best Low-Maintenance Plants Indoor Plants For Your Retail Space</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>⏺Snake Plant (Sansevieria)</h3>\r\n\r\n<p>The snake plant, also known as Sansevieria or mother-in-law&#39;s tongue, is a popular choice for retail spaces due to its hardiness and unique, sword-like leaves. It can tolerate a wide range of light conditions, from bright to low, making it adaptable to different areas of your store. Snake plants are also known for their air-purifying qualities, removing toxins and pollutants from the surrounding environment. With minimal watering requirements, these plants are perfect for busy store owners looking for low-maintenance options.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"\" src=\"https://cdn.shopify.com/s/files/1/0579/7924/0580/files/AtlantisPlanter-PastelBlue_603a113c-6a3c-4fa7-a224-a9115a98b4fe_1_480x480.jpg?v=1686658545\" style=\"height:269px; width:269px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>⏺ZZ Plant (Zamioculcas zamiifolia)</h3>\r\n\r\n<ol>\r\n</ol>\r\n\r\n<p>The ZZ plant is another excellent choice for retail spaces. Its glossy, dark green leaves add a touch of elegance to any setting. The ZZ plant thrives in low-light conditions and can tolerate irregular watering, making it ideal for busy retail environments. With its upright growth habit and minimal care needs, the ZZ plant can be a stylish addition to your store&#39;s decor.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"https://cdn.shopify.com/s/files/1/0579/7924/0580/files/dwarf-zz-plant-31799981703300_480x480.jpg?v=1686658581\" style=\"height:278px; width:253px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>⏺Pothos (Epipremnum aureum)</h3>\r\n\r\n<ol>\r\n</ol>\r\n\r\n<p>Pothos, also known as Devil&#39;s Ivy, is a versatile and forgiving plant that is often seen cascading from shelves or&nbsp;hanging planters. It can thrive in a variety of light conditions, from low to bright indirect light. Pothos is known for its heart-shaped leaves with variegated patterns, adding a touch of vibrancy to your retail space. With occasional watering and minimal fertilization requirements, Pothos is an excellent low-maintenance option for both hanging and potted displays.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"https://cdn.shopify.com/s/files/1/0579/7924/0580/files/SpiroCeramicPot-TurquoiseBlue_41c2daf3-334f-4259-9fd3-0f78b806cfcb_2_480x480.jpg?v=1686658632\" style=\"height:298px; width:298px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>⏺Peace Lily (Spathiphyllum)</h3>\r\n\r\n<ol>\r\n</ol>\r\n\r\n<p>The Peace Lily is a classic choice for indoor plants, known for its elegant white flowers and lush green foliage. It thrives in low to medium light conditions and is relatively forgiving when it comes to watering. The Peace Lily can even signal when it needs water, as its leaves tend to droop slightly. A well-cared-for Peace Lily can create a serene atmosphere in your retail space, helping customers relax and enjoy their shopping experience.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"https://cdn.shopify.com/s/files/1/0579/7924/0580/files/AtlantisPlanter-MidnightBlue_3_480x480.jpg?v=1686658676\" style=\"height:300px; width:300px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>⏺Spider Plant (Chlorophytum comosum)</h3>\r\n\r\n<ol>\r\n</ol>\r\n\r\n<p>Spider plants are known for their long, arching leaves with white stripes, adding a touch of visual interest to any area. They thrive in bright, indirect light and are adaptable to a range of temperatures, making them suitable for various retail settings. Spider plants are also excellent air purifiers, improving the air quality in your store. With occasional watering and minimal fertilization, these low-maintenance plants can thrive in your retail space.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"\" src=\"https://cdn.shopify.com/s/files/1/0579/7924/0580/files/AtlantisPlanter-PastelPink_1eedd56d-8529-4201-bfcd-24d132f4ee4d_1_480x480.jpg?v=1686658723\" style=\"height:294px; width:294px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>⏺Rubber Plant (Ficus elastica)</h3>\r\n\r\n<ol>\r\n</ol>\r\n\r\n<p>If you&#39;re looking to add a statement plant to your retail space, the Rubber Plant is an excellent choice. Its large, glossy leaves and robust appearance can create a striking focal point. Rubber plants prefer bright, indirect light but can adapt to lower light conditions as well. With its minimal watering requirements and slow growth rate, the Rubber Plant is a low-maintenance option that can add a touch of sophistication to your store.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"\" src=\"https://cdn.shopify.com/s/files/1/0579/7924/0580/files/rubber-plant-31800175624324_480x480.jpg?v=1686658767\" style=\"height:301px; width:273px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>⏺Enhancing Ambience with Decorative Plant Pots</h3>\r\n\r\n<p>In addition to selecting the right low-maintenance plants, choosing decorative plant pots can further elevate the ambiance of your retail space. Opt for pots that complement your store&#39;s interior design and branding. Consider different materials, colors, and textures to create a cohesive and visually appealing display. Hanging plants can be placed in decorative hanging baskets, adding depth and visual interest to your retail space while making the most of vertical space.</p>\r\n\r\n<h3>⏺The Importance of Plants Fertilizer</h3>\r\n\r\n<p>To ensure the healthy growth of your low-maintenance plants, occasional fertilization is necessary. Choose a slow-release fertilizer specifically formulated for indoor plants and follow the recommended dosage instructions. Fertilizing your plants at regular intervals will help maintain their vitality and lush appearance, contributing to a vibrant and inviting atmosphere in your retail space.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Conclusion</strong></p>\r\n\r\n<p>Incorporating low-maintenance indoor plants into your retail space can enhance the overall ambiance, create a welcoming atmosphere, and improve air quality. By selecting plants such as Snake Plant, ZZ Plant, Pothos, Peace Lily, Spider Plant, and Rubber Plant, you can enjoy the benefits of greenery with minimal care and attention. Pairing these plants with decorative plant pots and incorporating hanging plants can elevate the visual appeal of your store. Remember to fertilize your plants periodically to ensure their health and vitality. With these tips in mind, you can transform your retail space into a vibrant and inviting environment that leaves a lasting impression on your customers.</p>\r\n', 'Anubhav Shah', '2023-07-16 07:12:09', '../image/Screenshot (154).png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `quantity`, `user_id`, `created_at`) VALUES
(21, 12, 1, 24, '2023-08-01 03:40:55'),
(22, 2, 1, 24, '2023-08-12 15:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `cdt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `cdt`) VALUES
(1, 'Outdore', '2023-06-17 13:41:25'),
(2, 'Indore', '2023-06-17 13:41:31'),
(3, 'Creeper', '2023-06-17 13:42:16'),
(4, 'Thorny', '2023-06-17 13:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(3, 'Anubhav shah', 'arjun@gmail.com', '9174945301', 'test', '2023-07-28 06:12:02'),
(4, 'Anubhav shah', 'abc@gmail.com', '9856757849', 'dfgcfchgjj', '2024-01-16 13:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `name`, `email`, `phone`, `address`, `pincode`, `total_price`, `order_date`, `status`) VALUES
(15, 1, 'Anubhav shah', 'abc@gmail.com', '9178344692', 'sisarma, udaipur, (Raj.)', '313031', '1091.00', '2023-07-28 06:15:23', 'Cancelled'),
(16, 24, 'ankush singh', 'ankush410singh@gmail.com', '9856375460', 'bhopal, m.p', '410021', '1998.00', '2023-07-31 04:57:39', 'Delivered'),
(17, 26, 'Anubhav shah', 'anu1234@gmail.com', '9178344692', 'dfsdfsdffd', '342453', '211.00', '2023-08-17 14:59:09', 'Delivered'),
(18, 1, 'Anubhav shah', 'anu1234@gmail.com', '9856757849', 'sisarma', '313031', '636.00', '2023-08-18 05:25:30', 'Delivered'),
(19, 1, 'Prem kumar', 'prem@gmail.com', '9856375460', 'sisarma', '313031', '999.00', '2023-09-03 06:06:31', 'Delivered'),
(20, 1, 'fsdfsdf', 'ab@gmail.com', '9178344692', 'xfxvxcvvx', '342487', '570.00', '2023-09-09 06:02:54', 'Delivered'),
(21, 27, 'Anubhav shah', 'abc@gmail.com', '9856375460', 'ffsfadasda', '313031', '570.00', '2023-11-10 12:53:29', 'Delivered'),
(22, 27, 'Elongated Cactus Plant - Variegated', 'arjun@gmail.com', '9856757849', 'dgzdgfgxg', '313031', '9867.00', '2023-11-16 04:51:34', 'Delivered'),
(23, 27, 'Anubhav shah', 'prem@gmail.com', '9178344692', 'sfsfaf', '410021', '99999999.99', '2023-11-16 04:56:08', 'Delivered'),
(24, 1, 'arjun', 'abc@gmail.com', '9856375460', 'mbn nb', '123456', '570.00', '2023-12-04 07:08:08', 'Delivered'),
(25, 5, 'Air Jordan 1 Mid SE', 'abc@gmail.com', '5643874627', 'gghghg', '585645', '2496.00', '2024-04-03 06:37:59', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_name`, `quantity`, `price`, `total_price`) VALUES
(1, 15, 'Fiddle Leaf Fig Plant', 1, '1091.00', '1091.00'),
(2, 16, 'Money Plant N Joy', 2, '999.00', '1998.00'),
(3, 17, 'Christmas Cactus', 1, '211.00', '211.00'),
(4, 18, 'Philodendron Birkin Plant', 1, '636.00', '636.00'),
(5, 19, 'Money Plant N Joy', 1, '999.00', '999.00'),
(6, 20, 'Peacock Plant - Medium', 1, '570.00', '570.00'),
(7, 21, 'Peacock Plant - Medium', 1, '570.00', '570.00'),
(8, 22, 'Kesar Mango Plant', 13, '759.00', '9867.00'),
(9, 23, 'ZZ Plant - XL', 1490999900, '1909.00', '99999999.99'),
(10, 24, 'Peacock Plant - Medium', 1, '570.00', '570.00'),
(11, 25, 'Rubber Plant Variegated', 3, '559.00', '1677.00'),
(12, 25, 'Broken Heart Plant', 1, '249.00', '249.00'),
(13, 25, 'Peacock Plant - Medium', 1, '570.00', '570.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status`) VALUES
(1, 'Pending'),
(2, 'Shipped'),
(3, 'Delivered'),
(4, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(10) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `category_id` varchar(40) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `category_id`, `image`) VALUES
(1, 'Peacock Plant - Medium', 'The Calathea Makoyana is native to the Brazilian rainforest and a proud winner of Royal Horticultural Society\'s Award of Garden Merit. A darling of home gardeners for decades now, its popularity still tops the chart owing to its air purifying and pet friendly nature. The leaves are almost translucent with the top variegations reflected on the underside in purple, earning it the name Cathedral Windows .', '570', '3', '2', '../image/peacock.webp'),
(2, 'Rubber Plant Variegated', 'Bring life into dull, empty corners with one of the prettiest houseplants, the Rubber Plant Variegated. Its leaves display stunning variegations in shades of cream, pink and green with red midribs. An air purifier that is as stunning as it gets and thrives with little care is an excellent addition to your space.', '559', '0', '2', '../image/Rubber Plant Variegated.webp'),
(3, 'Calathea Orbifolia - Medium', 'Calathea Orbifolia is the plant that will make you turn and look at it for the second time - although it almost always is love at first sight. With its oversized circular leaves striped with silver it’s not just an exquisite beauty but an excellent air purifier that is perfect for most spaces. It thrives in indirect light and is also pet friendly.', '649', '12', '2', '../image/Calathea Orbifolia.webp'),
(4, 'Cactus Plant - Elongated', 'Cacti are the favourite of new plant parents, owing to the minimal maintenance that they require. Cacti can adapt to their natural habitat and change their shape to one that is most suited to conserve and store water. It looks equally beautiful in both traditional and modern minimalistic setup and provide an excellent contrast to foliage plants.', '319', '20', '4', '../image/Cactus Plant.webp'),
(5, 'Fiddle Leaf Fig Plant', 'The coolest kid on the block at the moment and an Instagram superstar, the Ficus Lyrata or the Fiddle Leaf Fig is a tropical plant that is also a great air purifier. Give it a spot with enough light and proper watering and it will gift you with beautiful broad leaves that will make your space worthy of a magazine feature. Get it home.', '1091', '6', '2', '../image/Fiddle Leaf Fig Plant.webp'),
(6, 'Kesar Mango Plant', 'Mango is a tropical fruit that is native to India and has been grown in the region for thousands of years. It is one of the most popular and beloved fruits in the country, and the mango plant is also an important part of Indian cuisine and culture.', '759', '1000000000', '1', '../image/Kesar Mango Plant.webp'),
(7, 'Song of India', 'A non-vining and big-leafed member of the philodendron family, the Philodendron melinonii green is a fuss-free plant. This dark green philodendron variety is an excellent choice if you are looking to add a tropical vibe to your indoor garden and looks equally stunning in shaded outdoor gardens. The leaves are large and a glossy dark green with clearly defined veins supported by a thick leaf stalk that can range in colour from light green to coppery red. In its natural habitat, the Philodendron melinonii can grow as an epiphyte on the top of trees forming a crown. A rare and new plant for Indian gardens, it is extremely easy to care for and loves the indian tropical growing conditions.', '1159', '5', '1', '../image/Screenshot (165).png'),
(8, 'Thuja Plant - XL', 'This sun-loving plant will add an evergreen patch to balconies and windows with the harshest sunlight. Excellent choice to provide that much-needed shielding from your intrusive neighbours, this conifer with its flat leaves requires very little care and can be pruned into almost any shape. Resilient in the face of pollution they will also trap most of the dust that your windows or balconies get.', '1599', '13', '1', '../image/Screenshot (166).png'),
(9, 'Christmas Cactus', 'True to their name, these flat-leafed succulents bloom right in time for the holiday season and that too profusely. Also known as the Schlumbergera buckleyi, it\'s pretty pink blooms last well into the new year, and when not blooming they make for a pretty foliage plant. The Christmas cactus plant requires very little care other than bright light and occasional watering, they are excellent for those sunny windows of yours.', '211', '10', '4', '../image/Christmas Cactus.webp'),
(10, 'Elongated Cactus Plant', 'Good things come in small sizes has never been truer than in the case of the Elongated Variegated Cactus. This beautiful cactus has spindly limbs that grow together at the base and grow individually at the top. This plant loves good bright light through the day and does not love being watered too much, water your cactus plant only when the potting mix is completely dry. The cactus is a great fit for smaller spaces and they are a great fit as plants for shelves or plant for offices.', '424', '5', '4', '../image/Elongated Cactus Plant.png'),
(11, 'Philodendron Birkin Plant', 'Philodendrons are one of the most loved and widely grown indoor plant species in the world, but what is better than a regular philodendron is a variegated one. The Philodendron Birkin has a stunning dark green colour with elegant white variegations resembling fish bone. Birkin plant\'s leaves are glossy, heart shaped, ovate and bring an interesting charm to any space.', '636', '11', '2', '../image/Philodendron Birkin Plant.webp'),
(12, 'ZZ Plant - XL', 'Topping the list of indestructible houseplants is the Zamioculcas Zamiifolia more popularly known as the ZZ plant. This plant is loved for his easy going and non-demanding nature. The wide, dark, glossy leaves instantly add life to any interior and he will be a happy trooper in the darkest corners of your home.', '1909', '0', '2', '../image/ZZ Plant.png'),
(13, 'Peperomia Green Plant', 'A rising favourite in the indoor plant world, the peperomia green creeper plants boasts of glossy green heart shaped leaves on thick trailing stems. Excellent for both table tops and hanging baskets, they look especially striking when grown on a trellis. These tropical beauties are a perfect addition to indoor spaces.', '249', '12', '3', '../image/Peperomia Green.webp'),
(14, 'Philodendron Oxycardium Green ', 'A member of one of the biggest and easiest to grow plant families, the oxycardium golden and green are as apart in looks and as similar in care as two plants could ever be. The bright leaves of the golden does wonders to elevate the emerald green leaves of the oxy green.', '699', '10', '3', '../image/Philodendron Oxycardium.webp'),
(15, 'Money Plant N Joy', 'The Money Plant N’Joy Hanging features variegated glossy heart shaped leaves interspersed on a climbing stem. Like all its other family members, the N’Joy variety is a low maintenance and easy to grow plant that doubles up as an excellent air purifier and it is also believed to bring luck and prosperity into your life!', '999', '16', '3', '../image/Money Plant N Joy.webp'),
(16, 'Broken Heart Plant', 'One of the most popular houseplants, and our all-time bestseller, this easy-growing plant with its heart-shaped leaves is loved for its beautiful fenestrations. Quick to grow with delicate trailing vines that can be styled for every space, the Philodendron broken heart is the monstera charm you want to add to your home if you don\'t have the space for the huge monstera.', '249', '10', '2', '../image/Broken Heart Plant.webp');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating_number` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `comment` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `product_id`, `user_id`, `rating_number`, `title`, `comment`, `created`) VALUES
(1, 13, 1, 5, 'Beautiful plant', 'Its a cute little beautiful plant and delivered in good packaging.', '2023-07-29 05:06:17'),
(2, 15, 24, 5, 'Worth of money', 'Received very good nd healthy plant . excellent packing. arrived on time 😁', '2023-07-29 05:15:50'),
(3, 2, 24, 5, 'best', 'nice plants', '2023-07-31 05:15:27'),
(4, 1, 24, 4, 'Best plants', 'mind blowing Peacock Plant also there leaf is amazing and i love this plants ', '2023-08-08 04:07:51'),
(5, 16, 5, 4, 'happy plant', 'amazing plants', '2023-08-17 14:35:02'),
(6, 1, 4, 5, 'Great Choice for our living space!!', 'Plant leaves straightens up in night and in day leaves comes back to original - one of its kind- unique plant', '2023-08-17 18:29:11'),
(7, 1, 8, 5, 'Huge, lush and breathtakingly beautiful.', 'I have never seen a healthier Calathea specimen, and to believe that it had reached me in that pristine condition after being trapped in a box for 3-4 days, was almost impossible. It’s a showstopper plant in my home, and every guest who walks in is compelled to stop and appreciate its beauty. It has been about 5-6 months and the plant is still doing exceptionally well, despite the changes in weather and humidity in my city. Thanks to Greenly for helping me make my house look prettier!', '2023-08-17 18:31:40'),
(8, 1, 10, 5, 'Unique plant', 'It’s one of the eye catching plant in your home. Rare to find. Easily elevate your decor.', '2023-08-17 18:33:07'),
(9, 1, 13, 4, 'Beautiful Peacock plant ..', 'Dear team Greenly,\r\nThis time you have left no room for any complaint.. Well packed .not a single damaged leaf .. but I couldn\'t find the plant tonic..\r\nGreat Job , kindly open ur branch here too.', '2023-08-17 18:41:32'),
(10, 1, 17, 5, 'My First Order With Greenly - A Set Of 2', 'I\'ve shopped online online for plants from various sites like Ferns And Petals, Nursery Live and Amazon and was very disappointed. Thought plants cannot be bought online. But then while looking for Peacock Plant, I came across Greenly and yes, I am happy how they have managed to deliver healthy plants in Bangalore just in 2 days. The plants are beautiful, breathing happily and smiling :)', '2023-08-17 18:44:22'),
(11, 3, 1, 5, 'best plant', 'best plant ever', '2023-09-03 06:05:30'),
(12, 9, 1, 4, 'yoooo', 'rigt plants', '2023-12-08 13:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `subscribed_at`) VALUES
(1, 'a2@gmail.com', '2023-08-16 05:21:00'),
(2, 'b6@gmail.com', '2023-08-16 05:26:03'),
(6, 'a9@gmail.com', '2023-08-16 05:26:40'),
(10, 'a8@gmail.com', '2023-08-16 05:35:15'),
(11, 'csk@g.c', '2023-08-16 05:38:02'),
(13, 'ab@gmail.com', '2023-08-16 05:45:47'),
(14, 'prem@gmail.com', '2023-08-16 06:27:27'),
(17, 'abc@gmail.com', '2023-08-16 06:28:40'),
(19, 'arjun@gmail.com', '2023-08-16 06:44:36'),
(25, 'czc@asda.com', '2023-08-17 14:22:25'),
(29, 'arjua@gmail.com', '2023-11-10 13:13:23'),
(30, 'prema@gmail.com', '2023-11-10 13:18:42'),
(32, 'premaa@gmail.com', '2023-11-10 13:19:01'),
(39, 'sanisah4444@gmail.com', '2024-03-05 09:57:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sno` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pasword` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birth` date NOT NULL,
  `profile_image` varchar(400) NOT NULL,
  `hobby` varchar(100) NOT NULL,
  `cdt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `name`, `email`, `pasword`, `gender`, `birth`, `profile_image`, `hobby`, `cdt`) VALUES
(1, 'Prem kumar', 'prem@gmail.com', '123456', 'male', '2013-11-22', '../uploads/64db0e9c8c214_WIN_20230814_11_03_06_Pro.jpg', '123456', '2023-06-15 16:23:07'),
(2, 'kabir singh', 'news@gmail.com', '123456', 'male', '1998-02-14', '', '12345', '2023-06-15 17:25:29'),
(3, 'Anubhav shah', 'a@gmail.com', '123456', 'male', '2000-09-22', '', '12345', '2023-06-16 14:38:35'),
(4, 'Ram thakur', 'ab@gmail.com', '123456', 'male', '1997-11-13', '', '1234', '2023-06-16 14:44:50'),
(5, 'Aman Prajapat', 'abc@gmail.com', '123456', 'male', '2000-07-14', '', '1234', '2023-06-16 14:49:16'),
(6, 'Shyam Prajapat', 'a1@gmail.com', '123456', 'female', '1993-10-08', '', '1234', '2023-06-16 15:05:30'),
(7, 'csk', 'csk@g.c', '1234567', 'female', '1993-06-18', '', '1234', '2023-06-16 15:08:54'),
(8, 'Rahul singh', 'a2@gmail.com', '1234567', 'male', '2000-03-19', '', '12345', '2023-06-16 15:10:47'),
(9, 'kritesh mali', 'a3@gmail.com', '123456', 'female', '2002-02-07', '', '12345', '2023-06-16 15:27:54'),
(10, 'Raju pandit', 'a4@gmail.com', '123456', 'male', '2000-01-09', '', '12345', '2023-06-16 15:29:45'),
(11, 'Shibu nagda', 'a5@gmail.com', '123456', 'male', '2000-03-31', '', '1234', '2023-06-16 15:31:12'),
(12, 'nilesh chaudhary', 'a6@gmail.com', '123456', 'male', '1999-07-10', '', '1234', '2023-06-16 15:32:19'),
(13, 'Simaran singh', 'a7@gmail.com', '123456', 'female', '1999-04-14', '', '12345', '2023-06-16 15:41:14'),
(14, 'Kailash kher', 'b0@gmail.com', '123456', 'male', '2020-02-17', '../uploads/648d3d739ac93_Cristiano Ronaldo.png', '1234', '2023-06-16 15:42:43'),
(15, 'Ritik thakur', 'b1@gmail.com', '123456', 'male', '1997-10-10', '', '1234', '2023-06-16 15:49:41'),
(16, 'Manish singh', 'a8@gmail.com', '123456', 'male', '1996-11-16', '', '12345', '2023-06-16 15:59:11'),
(17, 'Prince Singh Baghel', 'a9@gmail.com', '123456', 'male', '2003-11-13', '', '12345', '2023-06-16 16:07:23'),
(18, 'Sachin Pandey', 'b2@gmail.com', '123456', 'male', '1994-11-10', '', '1234', '2023-06-16 16:09:17'),
(19, 'Bishu lohar', 'b3@gmail.com', '123456', 'male', '1999-07-15', '', '1234', '2023-06-16 16:37:38'),
(20, 'Varun Gameti', 'b4@gmail.com', '123456', 'male', '1991-07-26', '', '1234', '2023-06-16 16:42:26'),
(21, 'Laksh Raj ', 'b6@gmail.com', 'abcd', 'male', '2003-03-12', '', '12345', '2023-06-16 16:44:26'),
(22, 'Harish Gameti', 'b7@gmail.com', '1234', 'male', '1999-07-18', '', '1234', '2023-06-16 18:06:09'),
(23, 'Tilak Verma', 'b8@gmail.com', '123456', 'male', '1994-06-17', '', '1234', '2023-06-16 18:34:33'),
(24, 'Rajneesh tiwari', 'c1@gmail.com', '123456', 'male', '2000-09-22', '../uploads/648d5549984eb_image2.png', '1234', '2023-06-17 11:28:30'),
(25, 'Ravendra Singh', 'abcd@gmail.com', '123456', 'male', '2000-12-20', '', '1234', '2023-07-10 18:25:48'),
(26, 'Sani Sah', 'sanisah4444@gmail.com', '123456', 'male', '2000-09-22', '../uploads/64de352c58f1a_WIN_20221214_12_50_01_Pro.jpg', 'sani', '2023-07-16 20:12:38'),
(27, 'Gaurav Pratap', 'gaurav@gmail.com', 'gaurav', 'male', '2000-06-23', '../uploads/64def1f751f28_image2.png', 'python', '2023-08-18 09:51:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`sno`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

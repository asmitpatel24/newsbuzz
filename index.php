<?php
include('include/db.php');

// Newsletter subscription
if(isset($_POST['email'])){
    $email = $_POST['email'];
    $stmt = $conn->prepare("INSERT INTO enquiry (email) VALUES (?)");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    echo "<script>alert('Subscribed Successfully!');</script>";
}

// Fetch news (optional)
$all_news = $conn->query("SELECT id, title, author, category, description, image, date FROM news ORDER BY date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>News Portal - NewsBuzz</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">

<script>
tailwind.config = {
  theme: {
    extend: {
      colors: { primary: '#083b5e', accent: '#facc15' },
      fontFamily: { sans: ['Roboto', 'sans-serif'] }
    }
  }
}
</script>

<style>
.tns-item img { border-radius: 0.5rem; }
</style>
</head>
<body class="bg-gray-100 font-sans">

<!-- Navbar -->
<nav class="bg-black text-white shadow-md sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 py-4 flex flex-wrap justify-between items-center">
    <a href="index.php" class="text-2xl font-bold tracking-wide">NewsBuzz</a>
    <div class="hidden md:flex gap-6 text-sm">
      <a href="index.php" class="hover:text-accent transition">Home</a>
      <a href="news-category.php" class="hover:text-accent transition">Categories</a>
      <a href="news-list.php" class="hover:text-accent transition">News List</a>
      <a href="#" class="hover:text-accent transition">Sport</a>
      <a href="#" class="hover:text-accent transition">Tech</a>
      <a href="#" class="hover:text-accent transition">Politics</a>
      <a href="about.php" class="hover:text-accent transition">About</a>
      <a href="contact.php" class="hover:text-accent transition">Contact</a>
    </div>
    <form class="hidden lg:flex gap-2 text-white mt-2 md:mt-0" method="get" action="search.php">
      <input type="search" name="query" placeholder="Search..." class="px-3 py-1.5 rounded text-white w-48">
      <button class="px-3 py-1 text-sm rounded-full bg-primary text-white hover:bg-gray-800">search</button>
    </form>
  </div>
</nav>

<!-- Slider Section -->
<section class="px-6 py-6">
  <div class="slider-container">
    <div class="my-slider">
      <?php
      $slider_news = $conn->query("SELECT * FROM news ORDER BY date DESC LIMIT 5");
      while($slide = $slider_news->fetch_assoc()){
          $imgPath = !empty($slide['image']) ? 'images/'.$slide['image'] : 'images/default.jpg';
          echo '
          <div class="relative rounded-lg overflow-hidden">
            <img src="'.$imgPath.'" class="w-full h-64 object-cover">
            <div class="absolute bottom-0 left-0 bg-black bg-opacity-50 w-full p-4 text-white">
              <p class="font-semibold">'.$slide['title'].'</p>
            </div>
          </div>';
      }
      ?>
    </div>
  </div>
</section>

<!-- Trending News -->
<section class="px-6 py-10">
  <h2 class="text-3xl font-semibold mb-6 text-primary">Trending News</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
    <?php
    $trending = $conn->query("SELECT * FROM news ORDER BY date DESC LIMIT 4");
    while($row = $trending->fetch_assoc()){
        $imgPath = 'uploads/default.jpg';
        echo '
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 transition-transform duration-300">
          <img src="'.$imgPath.'" class="w-full h-48 object-cover">
          <div class="p-4">
            <p class="text-gray-800 font-medium">'.$row['title'].'</p>
          </div>
        </div>';
    }
    ?>
  </div>
</section>

<!-- Recent News -->
<section class="px-6 pb-12">
  <h2 class="text-3xl font-semibold mb-6 text-primary">Recent News</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
    <?php
    $recent = $conn->query("SELECT * FROM news ORDER BY date DESC LIMIT 4,4");
    while($row = $recent->fetch_assoc()){
        $imgPath = !empty($row['uploads']) ? 'uploads/'.$row['image'] : 'uploads/default.jpg';
        echo '
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 transition-transform duration-300">
          <img src="'.$imgPath.'" class="w-full h-48 object-cover">
          <div class="p-4">
            <p class="text-gray-800 font-medium">'.$row['title'].'</p>
          </div>
        </div>';
    }
    ?>
  </div>
</section>

<!-- Newsletter -->
<div class="bg-white p-6 my-12 rounded-lg shadow-lg max-w-4xl mx-auto">
  <p class="mb-4 text-center text-lg font-semibold">📩 Subscribe to get the latest news delivered to your inbox.</p>
  <form method="post" class="flex flex-col sm:flex-row gap-4 justify-center">
    <input type="email" name="email" placeholder="Enter your email" required class="p-3 border rounded w-full">
    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-red-600">Subscribe</button>
  </form>
</div>

<!-- Footer -->
<footer class="bg-black text-white px-6 py-12">
  <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-8">
    <div>
      <h3 class="font-bold mb-2">About NewsBuzz</h3>
      <p>Your trusted source for the latest national and global news.</p>
    </div>
    <div>
      <h3 class="font-bold mb-2">Contact Us</h3>
      <p>Email: asmitverma1212@gmail.com</p>
      <p>Phone: +91-63902 59430</p>
    </div>
    <div>
      <h3 class="font-bold mb-2">Follow Us</h3>
      <div class="flex gap-4 text-xl">
        <a href="#" class="hover:text-accent"><i class="fab fa-google"></i></a>
        <a href="#" class="hover:text-accent"><i class="fab fa-linkedin"></i></a>
        <a href="#" class="hover:text-accent"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </div>
  <div class="text-center text-sm mt-8 border-t border-gray-400 pt-4">
    &copy; 2025 NewsBuzz Media Pvt Ltd. All rights reserved.
  </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
<script>
var slider = tns({
  container: '.my-slider',
  items: 1,
  slideBy: 'page',
  autoplay: true,
  autoplayButtonOutput: false,
  controls: true,
  nav: true,
  speed: 400,
  loop: true,
  gutter: 10,
});
</script>
</body>
</html>

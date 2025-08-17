<?php
// Include database connection
include('include/db.php');

// Fetch all categories
$categories = $conn->query("SELECT * FROM category ORDER BY title ASC");

// Fetch main news (example: latest 6 news)
$main_news = $conn->query("SELECT * FROM news ORDER BY date DESC LIMIT 6");

// Fetch recent news for sidebar (latest 4 news)
$recent_news = $conn->query("SELECT * FROM news ORDER BY date DESC LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>News Category - NewsBuzz</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#083b5e',
            accent: '#facc15'
          },
          fontFamily: {
            sans: ['Roboto', 'sans-serif']
          }
        }
      }
    }
  </script>
</head>
<body class="bg-gray-100 font-sans">
  <!-- ✅ Navbar -->
  <nav class="bg-black text-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-wrap justify-between items-center">
      <a href="/index.html" class="text-2xl font-bold tracking-wide">NewsBuzz</a>
      <div class="hidden md:flex gap-6 text-sm">
        <a href="/index.html" class="hover:text-accent transition">Home</a>
        <a href="/news-category.html" class="hover:text-accent transition">Categories</a>
        <a href="/news-list.html" class="hover:text-accent transition">News List</a>
        <a href="#" class="hover:text-accent transition">Sport</a>
        <a href="#" class="hover:text-accent transition">Tech</a>
        <a href="#" class="hover:text-accent transition">Politics</a>
        <a href="/about.html" class="hover:text-accent transition">About</a>
        <a href="/contact.html" class="hover:text-accent transition">Contact</a>
      </div>
      <form class="hidden lg:flex gap-2 text-white mt-2 md:mt-0">
        <input type="search" placeholder="Search..." class="px-3 py-1.5 rounded text-white w-48">
        <button class="px-3 py-1 text-sm rounded-full bg-primary text-white hover:bg-gray-800">
 search
</button>

      </form>
    </div>
  </nav>

 

  <!-- ✅ Grid + Sidebar -->
  <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
    <!-- Main News Grid -->
    <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="relative h-52 bg-cover bg-center rounded-lg shadow-lg text-white overflow-hidden" style="background-image: url('./images/space.webp')">
        <a href="/"><div class="absolute inset-0 bg-gradient-to-t from-black/60"></div>
        <div class="absolute bottom-4 left-4 z-10 text-sm font-semibold">India unveils space policy 2025</div></a>
      </div>
      <div class="relative h-52 bg-cover bg-center rounded-lg shadow-lg text-white overflow-hidden" style="background-image: url('./images/globalmarket.webp')">
        <a href=""><div class="absolute inset-0 bg-gradient-to-t from-black/60"></div>
        <div class="absolute bottom-4 left-4 z-10 text-sm font-semibold">Global markets recover strongly</div></a>
      </div>
      <div class="relative h-52 bg-cover bg-center rounded-lg shadow-lg text-white overflow-hidden" style="background-image: url('./images/climatesumit.webp')">
        <a href=""><div class="absolute inset-0 bg-gradient-to-t from-black/60"></div>
        <div class="absolute bottom-4 left-4 z-10 text-sm font-semibold">Climate summit sets new goals</div></a>
      </div>
    </div>

    <!-- Sidebar: Recent News -->
    <div>
      <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-lg font-semibold mb-4">📰 Recent News</h3>
        <div class="flex gap-3 mb-4 border-b pb-3">
          <img src="./images/startup.webp" class="w-20 h-16 object-cover rounded">
          <div class="text-sm">
            <h4 class="font-semibold">Startup raises ₹500 Cr</h4>
            <div class="text-xs text-gray-500">Jul 7, 2025 - 9:00 AM</div>
            <a href="#" class="text-blue-600 text-xs mt-1 inline-block">Read More</a>
          </div>
        </div>
        <div class="flex gap-3 mb-4">
          <img src="./images/heavyrain.webp" class="w-20 h-16 object-cover rounded">
          <div class="text-sm">
            <h4 class="font-semibold">Heavy rain disrupts traffic</h4>
            <div class="text-xs text-gray-500">Jul 6, 2025 - 4:30 PM</div>
            <a href="#" class="text-blue-600 text-xs mt-1 inline-block">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ✅ Newsletter -->
  <div class="bg-white p-6 my-12 rounded-lg shadow-lg max-w-4xl mx-auto">
    <p class="mb-4 text-center text-lg font-semibold">📩 Subscribe to get the latest news delivered to your inbox.</p>
    <form class="flex flex-col sm:flex-row gap-4 justify-center">
      <input type="email" placeholder="Enter your email" required class="p-3 border rounded w-full">
      <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-red-600">Subscribe</button>
    </form>
  </div>

  <!-- ✅ Footer -->
  <footer class="bg-black text-white px-6 py-12">
    <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-8">
      <div>
        <h3 class="font-bold mb-2">About NewsBuzz</h3>
        <p>Your trusted source for the latest national and global news.</p>
      </div>
      <div>
        <h3 class="font-bold mb-2">Contact Us</h3>
        <p>Email: asmitverma1212@gmail.com</p>
        <p>Phone: +91 6390259430</p>
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

</body>
</html>

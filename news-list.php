<?php
// Include database connection
include('include/db.php');

// Fetch all news from the database
$news_result = $conn->query("SELECT * FROM news ORDER BY date DESC");

// Fetch categories for category bar
$categories_result = $conn->query("SELECT * FROM category ORDER BY name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>News List | NewsBuzz</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#003b63',
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

<!-- ✅ Category Bar -->
<div class="max-w-7xl mx-auto px-4 my-6">
  <div class="flex flex-wrap justify-center gap-3">
    <a href=""><button class="px-3 py-1 bg-gray-200 rounded-full text-sm">Home</button></a>
    <a href=""><button class="px-3 py-1 bg-gray-200 rounded-full text-sm">News Category</button></a>
    <a href=""><button class="px-3 py-1 bg-gray-200 rounded-full text-sm">News List</button></a>
    <a href=""><button class="px-3 py-1 bg-gray-200 rounded-full text-sm">About</button></a>
    <a href=""><button class="px-3 py-1 bg-gray-200 rounded-full text-sm">Entertainment</button></a>
    <a href=""><button class="px-3 py-1 bg-gray-200 rounded-full text-sm">Health</button></a>
    <a href=""><button class="px-3 py-1 bg-gray-200 rounded-full text-sm">Environment</button></a>
  </div>
</div>

<!-- ✅ News List -->
<div class="max-w-7xl mx-auto px-4">
  <h2 class="text-2xl font-semibold mb-6">📰 News List</h2>
  <a><div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <img src="./images/space.webp" alt="News" class="w-full h-48 object-cover">
      <div class="p-4">
        <h3 class="text-lg font-semibold mb-2">India unveils space policy 2025</h3>
        <p class="text-sm text-gray-600">India's new space policy aims to increase private participation...</p>
      </div>
    </div></a>

    <a><div class="bg-white rounded-lg shadow overflow-hidden">
      <img src="./images/globalmarket.webp" alt="News" class="w-full h-48 object-cover">
      <div class="p-4">
        <h3 class="text-lg font-semibold mb-2">Global markets recover strongly</h3>
        <p class="text-sm text-gray-600">Sensex and Nifty witness all-time highs after investor confidence...</p>
      </div>
    </div></a>

    <a><div class="bg-white rounded-lg shadow overflow-hidden">
      <img src="./images/climatesumit.webp" alt="News" class="w-full h-48 object-cover">
      <div class="p-4">
        <h3 class="text-lg font-semibold mb-2">Climate summit sets new goals</h3>
        <p class="text-sm text-gray-600">World leaders agree on carbon reduction targets by 2030...</p>
      </div>
    </div>
  </div></a>
</div>

<!-- ✅ Footer -->
<footer class="bg-black text-white mt-16 px-6 py-12">
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
      <h3 class="font-bold mb-2">Follow Us</h3>button   <div class="flex gap-4 text-xl">
        <a href="#" class="hover:text-accent">G</a>
        <a href="#" class="hover:text-accent">In</a>
        <a href="#" class="hover:text-accent">IG</a>
      </div>
    </div>
  </div>
  <div class="text-center text-sm mt-8 border-t border-gray-400 pt-4">
    &copy; 2025 NewsBuzz Media Pvt Ltd. All rights reserved.
  </div>
</footer>

</body>
</html>
<?php
// Include database connection
include('include/db.php');

// Get news ID from URL
$news_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the selected news
$stmt = $conn->prepare("SELECT n.*, c.title AS category 
                        FROM news n 
                        LEFT JOIN category c ON category = c.id 
                        WHERE n.id = ?");
$stmt->bind_param("i", $news_id);
$stmt->execute();
$result = $stmt->get_result();
$news = $result->fetch_assoc();

// If news not found, redirect to homepage
if (!$news) {
    header("Location: index.php");
    exit();
}

// Fetch recent news for sidebar
$recent_news = $conn->query("SELECT * FROM news ORDER BY date DESC LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>News Detail | NewsBuzz</title>
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

  <!-- ✅ News Detail Content -->
  <main class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 lg:grid-cols-3 gap-10">
    <!-- Main News -->
    <div class="lg:col-span-2">
      <img src="./images/space.webp" alt="News Image" class="w-full h-96 object-cover rounded-xl shadow mb-6">
      <h1 class="text-3xl font-bold mb-2">India Launches New Space Program 2025</h1>
      <p class="text-sm text-gray-500 mb-6">Published on July 7, 2025 | Category: Science & Technology</p>
      <div class="prose prose-lg max-w-none">
        <p>The Indian Space Research Organisation (ISRO) has unveiled its ambitious 2025 space program, which includes the launch of advanced communication satellites, interplanetary missions, and the much-anticipated Gaganyaan manned mission.</p>
        <p>This strategic initiative boosts India's role in global space exploration and promises economic and scientific breakthroughs in the years to come.</p>
        <p>The government has allocated ₹15,000 crores towards this mission, making it one of the largest space budgets in Asia. With global collaboration and private sector involvement, this project is expected to set new standards in satellite technology and deep space research.</p>
      </div>
    </div>

    <!-- Sidebar: Recent News -->
    <aside>
      <h3 class="text-xl font-semibold mb-4">📰 Recent News</h3>

      <div class="bg-white rounded-lg shadow p-4 space-y-4">
        <div class="flex gap-3 border-b pb-3">
          <img src="./images/globalmarket.webp" class="w-28 h-20 object-cover rounded">
          <div class="text-sm">
            <h4 class="font-semibold">Startup raises ₹500 Cr</h4>
            <div class="text-xs text-gray-500">July 7, 2025 - 9:00 AM</div>
            <a href="#" class="text-blue-600 text-xs mt-1 inline-block">Read more</a>
          </div>
        </div>

        <div class="flex gap-3 border-b pb-3">
          <img src="./images/heavyrain.webp" class="w-28 h-20 object-cover rounded">
          <div class="text-sm">
            <h4 class="font-semibold">Heavy rain disrupts traffic</h4>
            <div class="text-xs text-gray-500">July 6, 2025 - 4:30 PM</div>
            <a href="#" class="text-blue-600 text-xs mt-1 inline-block">Read more</a>
          </div>
        </div>

        <div class="flex gap-3">
          <img src="./images/bb.webp" class="w-28 h-20 object-cover rounded">
          <div class="text-sm">
            <h4 class="font-semibold">Bollywood film smashes records</h4>
            <div class="text-xs text-gray-500">July 5, 2025 - 3:00 PM</div>
            <a href="#" class="text-blue-600 text-xs mt-1 inline-block">Read more</a>
          </div>
        </div>
      </div>
    </aside>
  </main>

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

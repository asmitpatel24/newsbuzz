<?php
// Session start
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location:login.php");
    exit();
}

// Database connection
include('../include/db.php');

// Fetch logged-in user info
$userId = $_SESSION['user_id'];
$userResult = $conn->query("SELECT name, email FROM users WHERE id = $userId LIMIT 1");
$user = $userResult->fetch_assoc();

// Extract initials from name or email
$initials = '';
if (!empty($user['name'])) {
    $names = explode(' ', trim($user['name']));
    foreach ($names as $n) {
        if (!empty($n)) $initials .= strtoupper($n[0]);
    }
    $initials = substr($initials, 0, 2); // Only first two letters
} else {
    $initials = strtoupper(substr($user['email'], 0, 2)); // Fallback
}

// Category count
$categoryResult = $conn->query("SELECT COUNT(*) AS total FROM category");
$categoryCount = $categoryResult->fetch_assoc()['total'] ?? 0;

// News count
$newsResult = $conn->query("SELECT COUNT(*) AS total FROM news");
$newsCount = $newsResult->fetch_assoc()['total'] ?? 0;

// Enquiry count
$enquiryResult = $conn->query("SELECT COUNT(*) AS total FROM enquiry");
$enquiryCount = $enquiryResult->fetch_assoc()['total'] ?? 0;

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background: #f4f6f8;
    }
    header {
      background-color: #003366;
      color: white;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header .logo {
      font-weight: bold;
      font-size: 22px;
    }
    .logout-section {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .user-initials {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #fff;
      color: #003366;
      font-weight: bold;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 16px;
      text-transform: uppercase;
    }
    .logout {
      background: #fff;
      color: #003366;
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .container {
      display: flex;
    }
    aside {
      width: 220px;
      background-color: #002244;
      color: white;
      height: 100vh;
      padding-top: 20px;
    }
    aside h3, .menu-section {
      padding: 10px 20px;
      cursor: pointer;
    }
    .submenu {
      display: none;
      padding-left: 40px;
    }
    .submenu a {
      display: block;
      padding: 5px 0;
      color: #ccc;
      text-decoration: none;
      font-size: 14px;
    }
    main {
      flex: 1;
      padding: 30px;
    }
    .cards {
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
    }
    .card-button {
      flex: 1;
      background-color: #003366;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 30px 20px;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      text-align: center;
      box-shadow: 0 4px 10px rgba(248, 224, 224, 0.1);
      transition: 0.3s;
    }
    .card-button:hover {
      background-color: #c22820;
    }
    .card-button span {
      display: block;
      font-size: 32px;
      margin-top: 10px;
      font-weight: bold;
    }
  </style>
  <script>
    function toggleMenu(id) {
      var menu = document.getElementById(id);
      menu.style.display = menu.style.display === "block" ? "none" : "block";
    }
  </script>
</head>
<body>

<header>
  <div class="logo">NewsBuzz</div>
  <div class="logout-section">
    <div class="user-initials"><?php echo $initials; ?></div>
    <button class="logout" onclick="window.location.href='?logout=1'">Logout</button>
  </div>
</header>

<div class="container">
  <aside>
    <h3><a href="./dashboard.php" style="color:white; text-decoration:none;">Dashboard</a></h3>
    
    <div class="menu-section" onclick="toggleMenu('categoryMenu')">Category ▼</div>
    <div class="submenu" id="categoryMenu">
      <a href="./add-category.php">Add</a>
      <a href="./show-category.php">Show</a>
    </div>

    <div class="menu-section" onclick="toggleMenu('newsMenu')">News ▼</div>
    <div class="submenu" id="newsMenu">
      <a href="./add-news.php">Add</a>
      <a href="./show-news-list.php">Show</a>
    </div>

    <div class="menu-section">
      <a href="./enquiry-detail.php" style="color:white; text-decoration:none;">Enquiry</a>
    </div>
  </aside>

  <main>
    <div class="cards">
      <button class="card-button" onclick="window.location.href='show-category.php'">
        Number of Category
        <span><?php echo $categoryCount; ?></span>
      </button>
      <button class="card-button" onclick="window.location.href='show-news-list.php'">
        Number of News
        <span><?php echo $newsCount; ?></span>
      </button>
      <button class="card-button" onclick="window.location.href='enquiry-detail.php'">
        Number of Enquiry
        <span><?php echo $enquiryCount; ?></span>
      </button>
    </div>
  </main>
</div>

</body>
</html>

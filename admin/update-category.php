<?php
session_start();
include('../include/db.php'); // Make sure this file contains your DB connection

// Initialize variables
$categoryId = $_GET['id'] ?? null;
$categoryName = "";
$msg = "";

// Fetch category data if ID is provided
if ($categoryId) {
    $stmt = $conn->prepare("SELECT title FROM category WHERE id = ?");
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $stmt->bind_result($categoryName);
    $stmt->fetch();
    $stmt->close();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryName = trim($_POST['categoryName']);
    
    if (!empty($categoryName) && $categoryId) {
        $stmt = $conn->prepare("UPDATE category SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $categoryName, $categoryId);
        if ($stmt->execute()) {
            $msg = "Category updated successfully!";
        } else {
            $msg = "Error updating category.";
        }
        $stmt->close();
    } else {
        $msg = "Category name cannot be empty.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update News Category</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Roboto', sans-serif; background-color: #f5f6fa; }

    header {
      background-color: #003366;
      color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo { font-size: 20px; font-weight: bold; }
    .logout {
      background-color: white;
      color: #003366;
      padding: 7px 15px;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }

    .container {
      display: flex;
      min-height: calc(100vh - 60px);
    }

    aside {
      width: 220px;
      background-color: #002244;
      color: white;
      padding: 20px 10px;
    }

    .menu-title {
      font-weight: bold;
      font-size: 16px;
      margin: 10px 0;
      cursor: pointer;
      position: relative;
    }

    .menu-title::after {
      content: "▼";
      position: absolute;
      right: 10px;
      font-size: 12px;
    }

    .submenu {
      display: none;
      padding-left: 20px;
    }

    .submenu a {
      display: block;
      color: #ccc;
      text-decoration: none;
      padding: 6px 0;
      font-size: 14px;
    }

    .submenu a:hover {
      color: #fff;
    }

    .menu-title.active + .submenu {
      display: block;
    }

    .menu-fixed {
      font-weight: bold;
      font-size: 16px;
      margin: 20px 0 10px;
    }

    main {
      flex: 1;
      padding: 40px 60px;
    }

    .main-heading {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .form-box {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 500px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
    }

    input[type="text"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    button.submit-btn {
      background-color: #003366;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
    }

    button.submit-btn:hover {
      background-color: #0059b3;
    }
  </style>
</head>
<body>

  <header>
    <div class="logo">Logo</div>
    <div>
      <span style="margin-right: 15px;">Username</span>
      <button class="logout">Logout</button>
    </div>
  </header>

  <div class="container">
    <aside>
      <h3><a href="./dashboard.php" style="color:white; text-decoration:none;">Dashboard</a></h3>

      <div class="menu-title" onclick="toggleMenu(this)">Category</div>
      <div class="submenu">
        <a href="./add-category.php">Add</a>
        <a href="./show-category.php">Show</a>
      </div>

      <div class="menu-title" onclick="toggleMenu(this)">News</div>
      <div class="submenu">
        <a href="./add-news.php">Add</a>
        <a href="./show-news-list.php">Show</a>
      </div>

      <div class="menu-section">
      <a href="./enquiry-detail.php" style="color:white; text-decoration:none;">Enquiry</a>
    </div>
    </aside>

    <main>
      <div class="main-heading">Update News Category</div>

      <div class="form-box">
        <div class="form-group">
          <label for="categoryName">Category Name</label>
          <input type="text" id="categoryName" name="categoryName" value="Environment">
        </div>
        <button class="submit-btn">Submit</button>
      </div>
    </main>
  </div>

  <script>
    function toggleMenu(el) {
      el.classList.toggle('active');
      let submenu = el.nextElementSibling;
      submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    }
  </script>

</body>
</html>

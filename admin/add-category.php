<?php
// Include database connection
include('../include/db.php'); // adjust path if needed

$msg = "";

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Use consistent variable name
    $title = trim($_POST["title"] ?? '');

    if (!empty($title)) {
        // Prepare & insert into database
        $stmt = $conn->prepare("INSERT INTO category (title) VALUES (?)");
        $stmt->bind_param("s", $title);

        if ($stmt->execute()) {
            $msg = "<p style='color:green;'>Category added successfully!</p>";
        } else {
            $msg = "<p style='color:red;'>Error adding category.</p>";
        }
        $stmt->close();
    } else {
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add News Category</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #f4f6f8;
    }
    header {
      background-color: #003366;
      color: white;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .logo {
      font-weight: bold;
      font-size: 20px;
    }
    .logout {
      background: white;
      color: #003366;
      border: none;
      padding: 6px 12px;
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
    .menu-section a {
      color: white;
      text-decoration: none;
      display: block;
    }
    main {
      flex: 1;
      padding: 40px;
    }
    h2 {
      margin-bottom: 30px;
      font-size: 24px;
    }
    form {
      background: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 500px;
    }
    label {
      font-weight: bold;
      display: block;
      margin-bottom: 10px;
      font-size: 16px;
    }
    input[type="text"] {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 20px;
    }
    input[type="submit"] {
      background-color: #003366;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 4px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #aa0000b8;
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
  <div>
    <span>Username</span>
    <button class="logout">Logout</button>
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

    <!-- ✅ Direct Enquiry Link -->
    <div class="menu-section">
      <a href="./enquiry-detail.php" style="color:white; text-decoration:none;">Enquiry</a>
    </div>
  </aside>

  <main>
    <h2>Add News Category</h2>
    <?php echo $msg; ?>
    <form action="add-category.php" method="POST">
      <label for="title">Category Name</label>
      <input type="text" id="title" name="title" required>
      <input type="submit" value="Submit">
    </form>
  </main>
</div>

</body>
</html>

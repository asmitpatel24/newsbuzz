<?php
// Include database connection
include('../include/db.php'); // Adjust the path based on your folder structure

// Message variable
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $title = trim($_POST["title"]);
    $author = trim($_POST["author"]);
    $category = trim($_POST["category"]);
    $description = trim($_POST["description"]);

    // Handle image upload
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetPath = "../uploads/" . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            // ✅ Prepared Statement for safety
            $stmt = $conn->prepare("INSERT INTO news (title, author, category, description, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $title, $author, $category, $description, $imageName);

            if ($stmt->execute()) {
                $msg = "✅ News published successfully!";
            } else {
                $msg = "❌ Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $msg = "❌ Failed to upload image.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add News - NewsBuzz</title>
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
    .form-container {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      width: 500px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .form-container h2 {
      margin-bottom: 20px;
      color: #003366;
    }
    .form-container input,
    .form-container textarea,
    .form-container button {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }
    .form-container button {
      background-color: #003366;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }
    .form-container button:hover {
      background-color: #c22820;
    }
    .message {
      margin-bottom: 15px;
      font-weight: bold;
      color: green;
    }
    .error {
      color: red;
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

    <div class="menu-section">
      <a href="./enquiry-detail.php" style="color:white; text-decoration:none;">Enquiry</a>
    </div>
  </aside>

  <main>
    <div class="form-container">
      <h2>Add News</h2>
      <?php if ($msg != ""): ?>
        <p class="message <?php echo (strpos($msg,'Error')!==false || strpos($msg,'❌')!==false)?'error':''; ?>">
          <?php echo $msg; ?>
        </p>
      <?php endif; ?>

      <!-- ✅ enctype added -->
      <form action="#" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="News Title" required>
        <input type="text" name="author" placeholder="News Author" required>
        <input type="text" name="category" placeholder="Subject/Category" required>
        <textarea name="description" placeholder="News Description" rows="4" required></textarea>
        <input type="file" name="image" required>
        <button type="submit">Publish News</button>
      </form>
    </div>
  </main>
</div>

</body>
</html>

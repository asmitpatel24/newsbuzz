<?php
session_start();
include('../include/db.php'); // DB connection

$newsId = $_GET['id'] ?? null;
$msg = "";

// Variables
$title = $author = $category = $description = $image = "";

// Fetch current news data
if ($newsId) {
    $stmt = $conn->prepare("SELECT title, author, category, description, image FROM news WHERE id = ?");
    $stmt->bind_param("i", $newsId);
    $stmt->execute();
    $stmt->bind_result($title, $author, $category, $description, $image);
    $stmt->fetch();
    $stmt->close();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);

    // Handle image upload
    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "../uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $image = basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    }

    // Update query
    if ($newsId) {
        $stmt = $conn->prepare("UPDATE news SET title=?, author=?, category=?, description=?, image=? WHERE id=?");
        $stmt->bind_param("sssssi", $title, $author, $category, $description, $image, $newsId);
        if ($stmt->execute()) {
            $msg = "News updated successfully!";
        } else {
            $msg = "Error updating news.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update News - NewsBuzz</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      background-color: #f4f6f8;
    }
    header {
      background-color: #003366;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
    }
    .logo {
      font-weight: bold;
      font-size: 22px;
    }
    .logout {
      background: white;
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
    h2 {
      margin-bottom: 20px;
      color: #003366;
    }
    form {
      background-color: white;
      padding: 30px;
      border-radius: 8px;
      max-width: 600px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    form label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #333;
    }
    form input[type="text"], form textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    form textarea {
      height: 100px;
      resize: vertical;
    }
    form input[type="file"] {
      margin-bottom: 20px;
    }
    form button {
      background-color: #003366;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
    }
    form button:hover {
      background-color: #c22820;
    }
    .msg {
      margin-top: 15px;
      font-weight: bold;
      color: green;
    }
  img.preview {
  max-width: 150px;
  margin-top: 10px;
  margin-bottom: 20px; /* Added space below image */
  display: block;
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
    <h2>Update News</h2>

    <form method="POST" enctype="multipart/form-data">
      <label for="title">Title</label>
      <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>

      <label for="author">Author</label>
      <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($author); ?>" required>

      <label for="category">Category</label>
      <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($category); ?>" required>

      <label for="description">Description</label>
      <textarea id="description" name="description" required><?php echo htmlspecialchars($description); ?></textarea>

      <label for="image">Image</label>
      <input type="file" id="image" name="image">
      <?php if (!empty($image)) { ?>
        <img src="../uploads/<?php echo htmlspecialchars($image); ?>" class="preview">
      <?php } ?>

      <button type="submit">Update News</button>
      <?php if (!empty($msg)) { echo "<div class='msg'>$msg</div>"; } ?>
    </form>
  </main>
</div>

</body>
</html>

<?php
include('../include/db.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM news WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $news = mysqli_fetch_assoc($result);
    } else {
        die("News not found!");
    }
} else {
    die("Invalid request!");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $news['title']; ?> - News</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f8;
      margin: 0;
      padding: 0;
    }
    header {
      background: #003366;
      color: white;
      padding: 8px; /* pehle 15px tha, ab patla kar diya */
      text-align: center;
    }
    .container {
      width: 80%;
      margin: 20px auto;
      background: white;
      padding: 20px;
      box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
      border-radius: 5px;
    }
    h2 { color: #003366; }
    .meta {
      color: gray;
      font-size: 14px;
      margin-bottom: 15px;
    }
    .back {
      display: inline-block;
      margin-top: 20px;
      padding: 8px 12px;
      background: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 4px;
    }
  </style>
</head>
<body>
<header>
  <h1>News</h1>
</header>

<div class="container">
  <h2><?php echo $news['title']; ?></h2>
  <div class="meta">
    Category: <?php echo $news['category']; ?> | Date: <?php echo $news['date']; ?>
  </div>
  <p><?php echo nl2br($news['description']); ?></p>

  <!-- Back button ko yahan last me shift kar diya -->
  <a href="show-news-list.php" class="back">← Back to News List</a>
</div>

</body>
</html>

<?php
include('../include/db.php'); // DB connection file include

// Fetch categories
$sql = "SELECT * FROM category ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Show News Category</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
    main {
      flex: 1;
      padding: 40px;
    }
    h2 {
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    table th, table td {
      padding: 15px;
      text-align: center;
      border: 1px solid #ccc;
    }
    table th {
      background-color: #003366;
      color: white;
    }
    .btn-action {
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
    }
    .btn-edit {
      background-color: #007bff;
      color: white;
    }
    .btn-delete {
      background-color: #dc3545;
      color: white;
      margin-left: 5px;
    }
  </style>
  <script>
    function toggleMenu(id) {
      var menu = document.getElementById(id);
      menu.style.display = menu.style.display === "block" ? "none" : "block";
    }

    function confirmDelete(id) {
      if(confirm("Are you sure you want to delete this category?")) {
        window.location.href = 'delete-category.php?id=' + id;
      }
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
    <h2>Category List</h2>
    <table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Category Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if(mysqli_num_rows($result) > 0){
          $sr = 1;
          while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$sr."</td>";
            echo "<td>".$row['title']."</td>";
            echo "<td>
                    <a href='update-category.php?id=".$row['id']."'>
                      <button class='btn-action btn-edit'><i class='fas fa-edit'></i> Update</button>
                    </a>
                    <button class='btn-action btn-delete' onclick='confirmDelete(".$row['id'].")'><i class='fas fa-trash-alt'></i> Delete</button>
                  </td>";
            echo "</tr>";
            $sr++;
          }
        } else {
          echo "<tr><td colspan='3'>No categories found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </main>
</div>

</body>
</html>

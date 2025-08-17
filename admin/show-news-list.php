<?php 
include('../include/db.php'); // Database connection file

// ===== Delete Logic =====
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $del_query = "DELETE FROM news WHERE id = $delete_id";
    if (mysqli_query($conn, $del_query)) {
        echo "<script>alert('News deleted successfully!'); window.location.href='show-news-list.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error deleting news!');</script>";
    }
}

// ===== Fetch News =====
$query = "SELECT * FROM news ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Show News List - NewsBuzz</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Roboto', sans-serif; margin: 0; background-color: #f4f6f8; }
    header { background-color: #003366; color: white; display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; }
    .logo { font-weight: bold; font-size: 22px; }
    .logout { background: white; color: #003366; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; }
    .container { display: flex; }
    aside { width: 220px; background-color: #002244; color: white; height: 100vh; padding-top: 20px; }
    aside h3, .menu-section { padding: 10px 20px; cursor: pointer; }
    .submenu { display: none; padding-left: 40px; }
    .submenu a { display: block; padding: 5px 0; color: #ccc; text-decoration: none; font-size: 14px; }
    main { flex: 1; padding: 30px; }
    h2 { margin-bottom: 20px; color: #003366; }
    table { width: 100%; border-collapse: collapse; background: white; }
    table th, table td { border: 1px solid #ddd; padding: 10px; text-align: center; }
    table th { background-color: #003366; color: white; }
    .action-buttons a { display: inline-block; padding: 5px 10px; border-radius: 4px; text-decoration: none; font-size: 12px; margin: 0 3px; }
    .action-buttons a.view { background-color: #003366; color: white; }
    .action-buttons a.update { background-color: #007bff; color: white; }
    .action-buttons a.delete { background-color: #dc3545; color: white; }
    .action-buttons a.delete:hover { background-color: #a71d2a; }
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
    <h2>Show News List</h2>
    <table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Category</th>
          <th>Title</th>
          <th>Post Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        if(mysqli_num_rows($result) > 0){
          $sr = 1;
          while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
              <td><?php echo $sr++; ?></td>
              <td><?php echo htmlspecialchars($row['category']); ?></td>
              <td><?php echo htmlspecialchars($row['title']); ?></td>
              <td><?php echo date("d-M-Y", strtotime($row['date'])); ?></td>
              <td class="action-buttons">
                <a href="view news.php?id=<?php echo $row['id']; ?>" class="view">View</a>
                <a href="update news.php?id=<?php echo $row['id']; ?>" class="update">Update</a>
                <a href="show-news-list.php?delete_id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure to delete this news?')">Delete</a>
              </td>
            </tr>
        <?php } 
        } else { ?>
          <tr>
            <td colspan="5">No news found.</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </main>
</div>

</body>
</html>

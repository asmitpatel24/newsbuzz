<?php
// DB connection
$host = "localhost";
$user = "root";  
$pass = "";      
$dbname = "newsbuzz";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch enquiries
$sql = "SELECT id, name, email, message, date FROM enquiry ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Enquiry Details - NewsBuzz</title>
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
    table { width: 100%; border-collapse: collapse; background-color: white; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    th, td { padding: 12px; text-align: center; border-bottom: 1px solid #ddd; }
    th { background-color: #003366; color: white; }
    td button { padding: 6px 12px; margin: 0 3px; border: none; border-radius: 4px; cursor: pointer; color: white; }
    .view-btn { background-color: #007BFF; }
    .update-btn { background-color: #FFC107; color: #333; }
    .delete-btn { background-color: #DC3545; }
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
    <h2>Enquiry List</h2>

    <table>
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Name</th>
          <th>Email</th>
          <th>Message</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
            $srNo = 1;
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = htmlspecialchars($row['name']);
                $email = htmlspecialchars($row['email']);
                $message = htmlspecialchars($row['message']);
                $date = date("d-m-Y", strtotime($row['date']));
                echo "<tr>
                        <td>{$srNo}</td>
                        <td>{$name}</td>
                        <td>{$email}</td>
                        <td>{$message}</td>
                        <td>{$date}</td>
                        <td>
                          <button class='view-btn' onclick=\"window.location.href='view-enquiry.php?id={$id}'\">View</button>
                          <button class='update-btn' onclick=\"window.location.href='update-enquiry.php?id={$id}'\">Update</button>
                          <button class='delete-btn' onclick=\"if(confirm('Are you sure?')) window.location.href='delete-enquiry.php?id={$id}'\">Delete</button>
                        </td>
                      </tr>";
                $srNo++;
            }
        } else {
            echo "<tr><td colspan='6'>No enquiries found.</td></tr>";
        }
        ?>
      </tbody>
    </table>

  </main>
</div>

</body>
</html>

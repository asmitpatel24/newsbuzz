<?php
session_start();
include('../include/db.php');

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
      $user = $result->fetch_assoc();


        // Plain text password check (no hashing)
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['name'];
            header("Location: index.php");
            exit;
        } else {
            $msg = "Invalid password.";
        }
    } else {
        $msg = "No account found with this email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | NewsBuzz</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif; 
      background: linear-gradient(135deg, #003B5B, #007B8A);
      display: flex; 
      justify-content: center; 
      align-items: center; 
      height: 100vh; 
      margin: 0;
    }
    .login-box {
      background: white; 
      padding: 40px; 
      border-radius: 12px; 
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 100%; 
      max-width: 400px;
    }
    .login-box h2 {
      text-align: center; 
      margin-bottom: 30px; 
      color: #003B5B;
    }
    .login-box input {
      width: 100%; 
      padding: 12px; 
      margin: 10px 0; 
      border: 1px solid #ccc; 
      border-radius: 6px; 
      font-size: 16px;
    }
    .login-box button {
      width: 100%; 
      padding: 12px; 
      background-color: #003B5B; 
      color: white; 
      font-size: 16px; 
      border: none;
      border-radius: 6px; 
      cursor: pointer; 
      transition: background-color 0.3s ease;
    }
    .login-box button:hover {
      background-color: #005f7a;
    }
    .footer {
      text-align: center; 
      margin-top: 20px; 
      font-size: 14px;
    }
    .error {
      color: red; 
      text-align: center; 
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h2>Login to NewsBuzz</h2>
    <?php if ($msg): ?>
      <div class="error"><?php echo $msg; ?></div>
    <?php endif; ?>
    <form href="/index.php" method="post">
      <input type="email" name="email" placeholder="Enter your Gmail" required>
      <input type="password" name="password" placeholder="Enter your Password" required>
      <button type="submit">Login</button>
    </form>
    <div class="footer">
      <p>Don't have an account? <a href="#">Register</a></p>
    </div>
  </div>

</body>
</html>

<?php
// Include database connection
include('include/db.php');

// Handle Contact Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("INSERT INTO contact_form (name, subject, email, contact, address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $subject, $email, $contact, $address);
    $stmt->execute();
    echo "<script>alert('Message Sent Successfully!');</script>";
}

// Handle Newsletter Subscription
if (isset($_POST['newsletter_email'])) {
    $newsletter_email = $_POST['newsletter_email'];
    $stmt = $conn->prepare("INSERT INTO enquiry (email) VALUES (?)");
    $stmt->bind_param("s", $newsletter_email);
    $stmt->execute();
    echo "<script>alert('Subscribed Successfully!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact - NewsBuzz</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }

    header {
      background-color: #003B5B;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      margin: 0 10px;
      font-weight: bold;
    }

    .contact-section {
      display: flex;
      justify-content: space-between;
      padding: 40px;
      background: #f9f9f9;
      flex-wrap: wrap;
    }

    .contact-info, .contact-details, .contact-form {
      flex: 1 1 45%;
      margin-bottom: 30px;
    }

    .contact-info h3, .contact-details h3 {
      margin-bottom: 10px;
      color: #003B5B;
    }

    .contact-details i {
      margin-right: 10px;
      color: #003B5B;
    }

    .social-icons a {
      margin-right: 15px;
      font-size: 20px;
      color: #003B5B;
      text-decoration: none;
    }

    .contact-form h3 {
      color: #003B5B;
      margin-bottom: 10px;
    }

    .contact-form form input,
    .contact-form form textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .contact-form button {
      padding: 10px 20px;
      background-color: #003B5B;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .map-container {
      width: 100%;
      height: 300px;
      margin-bottom: 20px;
    }

    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    .newsletter {
      background: #ffffff;
      padding: 30px;
      text-align: center;
    }

    .newsletter input[type="email"] {
      padding: 10px;
      width: 250px;
      margin-right: 10px;
    }

    .newsletter button {
      padding: 10px 20px;
      background-color: #003B5B;
      color: white;
      border: none;
      cursor: pointer;
    }

    footer {
      background-color: #003B5B;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 14px;
    }

    .footer-content {
      max-width: 1100px;
      margin: 0 auto;
      padding: 20px 0;
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
    }

    .footer-content div {
      margin: 10px;
    }

    .footer-content h3 {
      margin-bottom: 10px;
      color: #fff;
    }

    .footer-content a {
      color: white;
      margin-right: 10px;
    }

    @media (max-width: 768px) {
      .contact-section {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <header>
    <div class="logo">NewsBuzz</div>
    <div class="nav-links">
      <a href="index.html">Home</a>
      <a href="category.html">News Category</a>
      <a href="politics.html">Politics</a>
      <a href="about.html">About</a>
      <a href="sports.html">Sports</a>
      <a href="tech.html">Tech</a>
      <a href="news-list.html">News List</a>
      <a href="contact.html">Contact</a>
    </div>
    <div class="profile"><button>Hi, User</button></div>
  </header>

  <!-- Contact Section -->
  <div class="contact-section">
    <div class="contact-info">
      <h3>Address</h3>
      <p>NewsBuzz Media Pvt Ltd</p>
      <p>Ayodhya</p>
      <p>Uttar Pradesh - 224001</p>
      <p>India</p>
    </div>

    <div class="contact-details">
      <h3>Contact</h3>
      <p><i class="fas fa-phone"></i> +91 6390259430</p>
      <p><i class="fas fa-envelope"></i> asmitverma1212@gmail.com</p>

      <h3>Follow Us</h3>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
      </div>
    </div>

    <!-- Contact Form -->
    <div class="contact-form">
      <h3>Contact</h3>
      <form action="#" method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="text" name="subject" placeholder="Subject" required>
        <input type="email" name="email" placeholder="Gmail Address" required>
        <input type="text" name="contact" placeholder="Contact Number" required>
        <textarea name="address" placeholder="Your Address" rows="3" required></textarea>
        <button type="submit">Send Now</button>
      </form>
    </div>
  </div>

  <!-- Google Map -->
  <div class="map-container">
    <iframe src="https://maps.google.com/maps?q=Ayodhya%20Uttar%20Pradesh&t=&z=13&ie=UTF8&iwloc=&output=embed" allowfullscreen></iframe>
  </div>

  <!-- Newsletter -->
  <div class="newsletter">
    <h3>📬 Subscribe to our Newsletter</h3>
    <input type="email" placeholder="Enter your email">
    <button>Subscribe</button>
  </div>

  <!-- Footer -->
  <footer>
    <div class="footer-content">
      <div>
        <h3>Contact Us</h3>
        <p>Email: asmitverma1212@gmail.com</p>
        <p>Phone: +91-63902 59430</p>
      </div>
      <div>
        <h3>Follow Us</h3>
        <div>
          <a href="#"><i class="fab fa-google"></i></a>
          <a href="#"><i class="fab fa-linkedin"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
    <p>&copy; 2025 NewsBuzz Media Pvt Ltd. All rights reserved.</p>
  </footer>

</body>
</html>

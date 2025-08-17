<?php
// Optional: include database connection if needed
// include('include/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About Us | NewsBuzz</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }
    .about-header-img {
      width: 100%;
      height: 350px;
      object-fit: cover;
      border-radius: 10px;
    }
    .section-title {
      font-size: 2rem;
      font-weight: 600;
    }
    .mission-vision img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-radius: 8px;
    }
    .team-member {
      text-align: center;
    }
    .team-member img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
    }
    footer {
      background-color: #003b63;
      color: white;
      padding: 40px 0 20px;
      margin-top: 50px;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">NewsBuzz</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">News Category</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Politics</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Tech</a></li>
        <li class="nav-item"><a class="nav-link" href="#">News List</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
      </ul>
      <span class="btn btn-light btn-sm ms-3">Hi, User</span>
    </div>
  </div>
</nav>

<!-- HEADER IMAGE + TITLE -->
<div class="container mt-4">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h1 class="section-title">About NewsBuzz</h1>
      <p>NewsBuzz is your go-to digital destination for timely, trustworthy, and impactful news. We provide stories that matter most to the people of India and the world, across politics, business, technology, health, entertainment, and more.</p>
    </div>
    <div class="col-md-6">
      <img src="https://via.placeholder.com/600x350" class="about-header-img" alt="About NewsBuzz">
    </div>
  </div>
</div>

<!-- MISSION & VISION -->
<div class="container mt-5">
  <div class="row mission-vision">
    <div class="col-md-6">
      <h2 class="section-title">Our Mission</h2>
      <p>To empower citizens by delivering accurate, unbiased, and fast news coverage. We aim to inform and educate while promoting democratic values and journalistic ethics.</p>
    </div>
    <div class="col-md-6">
      <img src="https://via.placeholder.com/500x250" alt="Mission">
    </div>
  </div>
  <div class="row mission-vision mt-4">
    <div class="col-md-6">
      <img src="https://via.placeholder.com/500x250" alt="Vision">
    </div>
    <div class="col-md-6">
      <h2 class="section-title">Our Vision</h2>
      <p>To become the most respected and reliable news portal by leveraging technology and community voices for the greater good of society.</p>
    </div>
  </div>
</div>

<!-- OUR TEAM -->
<div class="container mt-5">
  <h2 class="section-title text-center mb-4">Meet Our Team</h2>
  <div class="row text-center">
    <div class="col-sm-4 team-member">
      <img src="https://via.placeholder.com/120" alt="Team Member 1">
      <p class="mt-2">Asmit Patel</p>
    </div>
    <div class="col-sm-4 team-member">
      <img src="https://via.placeholder.com/120" alt="Team Member 2">
      <p class="mt-2">_________</p>
    </div>
    <div class="col-sm-4 team-member">
      <img src="https://via.placeholder.com/120" alt="Team Member 3">
      <p class="mt-2">_________</p>
    </div>
  </div>
</div>

<!-- FOOTER -->
<footer class="mt-5">
  <div class="container d-flex justify-content-between flex-wrap">
    <div>
      <h5>About NewsBuzz</h5>
      <p>Your trusted source for the latest national and global news.</p>
    </div>
    <div>
      <h5>Contact Us</h5>
      <p>Email: asmitverma1212@gmail.com</p>
      <p>Phone: +91 6390259430</p>
    </div>
    <div>
      <h5>Follow Us</h5>
      <a href="#" class="text-white me-2">G</a>
      <a href="#" class="text-white me-2">In</a>
      <a href="#" class="text-white">IG</a>
    </div>
  </div>
  <div class="text-center mt-3">
    &copy; 2025 NewsBuzz Media Pvt Ltd. All rights reserved.
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
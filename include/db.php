<?php
$host = "localhost"; // XAMPP default host
$user = "root";      // MySQL default username
$pass = "";          // MySQL default password
$dbname = "newsbuzz"; // aapka database naam

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

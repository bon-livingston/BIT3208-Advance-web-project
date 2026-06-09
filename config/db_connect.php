<?php
$host = "localhost";
$user = "root";
$password = "";   // empty by default in XAMPP
$database = "ecommerce_db";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Optional: set charset
mysqli_set_charset($conn, "utf8");
?>
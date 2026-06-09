<?php
$conn = mysqli_connect("localhost", "root", "", "ecommerce_db");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully to ecommerce_db!";
?>
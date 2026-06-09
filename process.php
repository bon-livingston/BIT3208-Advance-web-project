<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["username"]);
    echo "<h3>Welcome, $name!</h3>";
    echo '<br><a href="index.php">Go back</a>';
} else {
    echo "Invalid request.";
}
?>
<?php
require_once "config/db_connect.php";
echo "Connected to " . mysqli_get_host_info($conn);
?>
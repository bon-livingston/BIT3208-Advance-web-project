<?php session_start(); ?>
<?php require_once 'config/db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Smart E-Commerce</title>
<style>
    .product-grid { display: flex; gap: 20px; flex-wrap: wrap; }
    .product-card { border: 1px solid #ddd; padding: 15px; width: 200px; }
</style>
</head>
<body>
    <h1>Our Products</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Hello <?php echo $_SESSION['username']; ?> | <a href="user/logout.php">Logout</a></p>
        <?php if ($_SESSION['role'] == 'admin'): ?>
            <p><a href="admin/dashboard.php">Admin Panel</a></p>
        <?php endif; ?>
    <?php else: ?>
        <p><a href="user/login.php">Login</a> | <a href="user/register.php">Register</a></p>
    <?php endif; ?>

    <div class="product-grid">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM products");
        while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="product-card">
                <h3><?php echo $row['name']; ?></h3>
                <p>$<?php echo $row['price']; ?></p>
                <a href="products/product_details.php?id=<?php echo $row['id']; ?>">View Details</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../user/login.php");
    exit();
}
require_once '../config/db_connect.php';

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
    header("Location: dashboard.php");
    exit();
}

// Handle add product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    mysqli_query($conn, "INSERT INTO products (name, description, price, category) VALUES ('$name', '$desc', '$price', '$category')");
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title></head>
<body>
    <h1>Admin Panel</h1>
    <p>Welcome, <?php echo $_SESSION['username']; ?> | <a href="../user/logout.php">Logout</a></p>
    
    <h2>Add New Product</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Product Name" required><br>
        <textarea name="description" placeholder="Description"></textarea><br>
        <input type="number" step="0.01" name="price" placeholder="Price" required><br>
        <input type="text" name="category" placeholder="Category"><br>
        <button type="submit" name="add_product">Add Product</button>
    </form>

    <h2>Existing Products</h2>
    <table border="1">
        <tr><th>ID</th><th>Name</th><th>Price</th><th>Actions</th></tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM products");
        while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['price']; ?></td>
            <td>
                <a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="dashboard.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
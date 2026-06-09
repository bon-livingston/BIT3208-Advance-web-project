<?php session_start(); ?>
<?php require_once '../config/db_connect.php'; ?>
<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head><title><?php echo $product['name']; ?></title></head>
<body>
    <h1><?php echo $product['name']; ?></h1>
    <p>Price: $<?php echo $product['price']; ?></p>
    <p><?php echo $product['description']; ?></p>
    <form method="post" action="../cart/cart.php">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <label>Quantity:</label>
        <input type="number" name="quantity" value="1" min="1">
        <button type="submit" name="add_to_cart">Add to Cart</button>
    </form>
    <p><a href="../index.php">Back to Home</a></p>
</body>
</html>
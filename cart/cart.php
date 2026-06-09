<?php session_start(); ?>
<?php require_once '../config/db_connect.php'; ?>

<?php
// Initialize cart session if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add item to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
    header("Location: cart.php");
    exit();
}

// Remove item
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head><title>Your Cart</title></head>
<body>
    <h1>Shopping Cart</h1>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table border="1" cellpadding="10">
            <tr>
                <th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th></th>
            </tr>
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $id => $qty):
                $res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
                $product = mysqli_fetch_assoc($res);
                $subtotal = $product['price'] * $qty;
                $total += $subtotal;
            ?>
            <tr>
                <td><?php echo $product['name']; ?></td>
                <td>$<?php echo $product['price']; ?></td>
                <td><?php echo $qty; ?></td>
                <td>$<?php echo $subtotal; ?></td>
                <td><a href="cart.php?remove=<?php echo $id; ?>">Remove</a></td>
            </tr>
            <?php endforeach; ?>
            <tr><td colspan="3"><strong>Total</strong></td><td><strong>$<?php echo $total; ?></strong></td><td></td></tr>
        </table>
        <p><a href="../index.php">Continue Shopping</a></p>
    <?php endif; ?>
</body>
</html>
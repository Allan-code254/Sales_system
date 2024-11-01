<?php
session_start();
include 'db.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch available products
$products = $conn->query("SELECT * FROM products");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Fetch product price
    $productResult = $conn->query("SELECT price, stock FROM products WHERE id = $productId");
    $product = $productResult->fetch_assoc();
    $total = $product['price'] * $quantity;

    // Check stock availability
    if ($quantity <= $product['stock']) {
        // Insert transaction record
        $stmt = $conn->prepare("INSERT INTO transactions (user_id, product_id, quantity, total) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $userId, $productId, $quantity, $total);
        $stmt->execute();

        // Update product stock
        $newStock = $product['stock'] - $quantity;
        $conn->query("UPDATE products SET stock = $newStock WHERE id = $productId");

        echo "Transaction successful!";
    } else {
        echo "Not enough stock.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .container { width: 300px; padding: 20px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #333; }
        form, select, input, button { width: 100%; margin: 8px 0; }
        button { background-color: #4CAF50; color: white; padding: 10px; border: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Make a Transaction</h2>
        <form action="transaction.php" method="POST">
            <label for="product">Product:</label>
            <select name="product_id" required>
                <?php while ($product = $products->fetch_assoc()) { ?>
                    <option value="<?= $product['id'] ?>">
                        <?= $product['name'] ?> - $<?= $product['price'] ?>
                    </option>
                <?php } ?>
            </select>
            <input type="number" name="quantity" placeholder="Quantity" min="1" required>
            <button type="submit">Purchase</button>
        </form>
    </div>
</body>
</html>

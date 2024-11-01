<?php
session_start();
include 'db.php';

// Ensure only logged-in users can access this page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Add new product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("INSERT INTO products (name, description, price, stock) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $name, $description, $price, $stock);
    $stmt->execute();
    $stmt->close();
    echo "<p>Product added successfully!</p>";
}

// Edit product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_product'])) {
    $id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, stock=? WHERE id=?");
    $stmt->bind_param("ssdii", $name, $description, $price, $stock, $id);
    $stmt->execute();
    $stmt->close();
    echo "<p>Product updated successfully!</p>";
}

// Fetch all products
$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Management</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; display: flex; flex-direction: column; align-items: center; }
        .container { width: 600px; padding: 20px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #333; }
        form { display: flex; flex-direction: column; margin-bottom: 20px; }
        input, textarea, button { margin: 8px 0; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        button { background-color: #4CAF50; color: white; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #f2f2f2; }
        .edit-btn { background-color: #008CBA; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Product</h2>
        <form action="products.php" method="POST">
            <input type="text" name="name" placeholder="Product Name" required>
            <textarea name="description" placeholder="Product Description" rows="3" required></textarea>
            <input type="number" step="0.01" name="price" placeholder="Price" required>
            <input type="number" name="stock" placeholder="Stock Quantity" required>
            <button type="submit" name="add_product">Add Product</button>
        </form>

        <h2>Manage Products</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
            <?php while ($product = $products->fetch_assoc()) { ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['description']) ?></td>
                    <td>$<?= $product['price'] ?></td>
                    <td><?= $product['stock'] ?></td>
                    <td>
                        <form action="products.php" method="POST" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
                            <input type="text" name="description" value="<?= htmlspecialchars($product['description']) ?>" required>
                            <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>
                            <input type="number" name="stock" value="<?= $product['stock'] ?>" required>
                            <button type="submit" name="edit_product" class="edit-btn">Update</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>

<?php
session_start();
include 'db.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user transactions
$userId = $_SESSION['user_id'];
$transactions = $conn->query("SELECT t.id, p.name AS product_name, t.quantity, t.total, t.transaction_date 
                              FROM transactions t 
                              JOIN products p ON t.product_id = p.id 
                              WHERE t.user_id = $userId 
                              ORDER BY t.transaction_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Tracking</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; }
        .container { width: 500px; padding: 20px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Sales</h2>
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
            <?php while ($transaction = $transactions->fetch_assoc()) { ?>
                <tr>
                    <td><?= $transaction['product_name'] ?></td>
                    <td><?= $transaction['quantity'] ?></td>
                    <td>$<?= $transaction['total'] ?></td>
                    <td><?= $transaction['transaction_date'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>

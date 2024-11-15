<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

// Include the database connection
require 'db.php';

// Fetch user-specific data (example: recent transactions)
$userId = $_SESSION['user_id'];
$query = $conn->prepare("SELECT * FROM transactions WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
$query->bind_param("i", $userId);
$query->execute();
$result = $query->get_result();

$transactions = [];
while ($row = $result->fetch_assoc()) {
    $transactions[] = $row;
}

// Example data for pie chart (replace with actual logic)
$profits = 1200;
$losses = 300;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ReJo Sales</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-header {
            background-color: #007bff;
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
        }
        .card {
            border: none;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-quick-action {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="dashboard-header text-center">
            <h1>Welcome to ReJo Sales Dashboard</h1>
            <p>Manage your sales efficiently and track your progress</p>
        </div>

        <div class="row mt-5">
            <!-- Pie Chart -->
            <div class="col-md-6">
                <div class="card p-4">
                    <h4>Profit and Loss Overview</h4>
                    <canvas id="profitLossChart"></canvas>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="col-md-6">
                <div class="card p-4">
                    <h4>Recent Transactions</h4>
                    <ul class="list-group">
                        <?php if (count($transactions) > 0): ?>
                            <?php foreach ($transactions as $transaction): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><?= htmlspecialchars($transaction['description']) ?></span>
                                    <span class="<?= $transaction['amount'] >= 0 ? 'text-success' : 'text-danger' ?>">
                                        <?= $transaction['amount'] >= 0 ? '+' : '' ?><?= $transaction['amount'] ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item">No recent transactions</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Quick Actions -->
            <div class="col-md-4">
                <div class="card p-3 text-center">
                    <h5>Add New Product</h5>
                    <a href="add_product.php" class="btn btn-quick-action">Go</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 text-center">
                    <h5>View Transactions</h5>
                    <a href="transactions.php" class="btn btn-quick-action">Go</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 text-center">
                    <h5>Logout</h5>
                    <a href="logout.php" class="btn btn-quick-action">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Generate Pie Chart
        const ctx = document.getElementById('profitLossChart').getContext('2d');
        const profitLossChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Profits', 'Losses'],
                datasets: [{
                    data: [<?= $profits ?>, <?= $losses ?>],
                    backgroundColor: ['#28a745', '#dc3545']
                }]
            }
        });
    </script>
</body>
</html>

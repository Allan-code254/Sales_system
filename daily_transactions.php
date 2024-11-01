<?php
session_start();
include 'db.php';

// Ensure only logged-in users can access this page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch daily transactions
$date = date('Y-m-d'); // Today's date
$stmt = $conn->prepare("SELECT * FROM transactions WHERE DATE(transaction_date) = ?");
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();
$transactions = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Calculate total profit and loss
$profit = 0;
$loss = 0;
foreach ($transactions as $transaction) {
    $total = $transaction['total'];
    if ($total >= 0) {
        $profit += $total;
    } else {
        $loss += abs($total);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Transactions</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; display: flex; flex-direction: column; align-items: center; }
        .container { width: 80%; max-width: 800px; }
        h2 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #f2f2f2; }
        .chart-container { width: 100%; margin-top: 30px; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h2>Daily Transactions - <?php echo date("Y-m-d"); ?></h2>
        <table>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?php echo $transaction['id']; ?></td>
                    <td><?php echo $transaction['user_id']; ?></td>
                    <td><?php echo $transaction['product_id']; ?></td>
                    <td><?php echo $transaction['quantity']; ?></td>
                    <td>$<?php echo $transaction['total']; ?></td>
                    <td><?php echo $transaction['transaction_date']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="chart-container">
            <canvas id="profitLossChart"></canvas>
        </div>
    </div>

    <script>
        // Data for the chart
        const profit = <?php echo $profit; ?>;
        const loss = <?php echo $loss; ?>;

        // Create the pie chart using Chart.js
        const ctx = document.getElementById('profitLossChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Profit', 'Loss'],
                datasets: [{
                    label: 'Profit vs Loss',
                    data: [profit, loss],
                    backgroundColor: ['#4CAF50', '#FF5733'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += `$${context.raw.toFixed(2)}`;
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>

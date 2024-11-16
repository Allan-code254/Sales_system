<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Transactions Overview</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="transactions.php">Transactions</a></li>
            <li><a href="products.php">Products</a></li>
        </ul>
    </nav>
    <main>
        <h2>Sales and Profit/Loss Chart</h2>
        <div id="piechart" style="width: 100%; height: 400px;"></div>

        <h2>Transaction Data</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Sales ($)</th>
                    <th>Profit ($)</th>
                    <th>Loss ($)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Example transaction data
                $transactions = [
                    ['2024-11-01', 'Product A', 1500, 500, 0],
                    ['2024-11-02', 'Product B', 1000, 300, 50],
                    ['2024-11-03', 'Product C', 500, 100, 20],
                    ['2024-11-04', 'Product D', 800, 200, 100],
                ];

                foreach ($transactions as $transaction) {
                    echo "<tr>
                            <td>{$transaction[0]}</td>
                            <td>{$transaction[1]}</td>
                            <td>\${$transaction[2]}</td>
                            <td>\${$transaction[3]}</td>
                            <td>\${$transaction[4]}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Our Online Store. All Rights Reserved.</p>
    </footer>

    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Category', 'Amount'],
                ['Profit', 1100],
                ['Loss', 170]
            ]);

            var options = {
                title: 'Profit and Loss Overview',
                pieHole: 0.4,
                colors: ['#4CAF50', '#FF5722']
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
</body>
</html>

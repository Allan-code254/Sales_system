<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ReJo Sales</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, #007bff, #6c757d);
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .header-bar {
            background-color: #343a40;
            padding: 10px 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #f8f9fa;
        }
        .login-card {
            max-width: 400px;
            margin: 80px auto;
            padding: 20px;
            background-color: #ffffff;
            color: #343a40;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .accept-cookies {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #343a40;
            color: #f8f9fa;
            padding: 10px 20px;
            text-align: center;
            font-size: 14px;
        }
        .accept-cookies button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .accept-cookies button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- ReJo Sales Header -->
    <div class="header-bar">ReJo Sales</div>

    <!-- Login Card -->
    <div class="login-card">
        <h2 class="text-center">Login</h2>
        <p class="text-center">Welcome back to ReJo Sales! Manage your sales with ease.</p>
        <form action="login_process.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Login</button>
        </form>
        <div class="text-center mt-3">
            <a href="forgot_password.php" class="text-decoration-none">Forgot Password?</a>
        </div>
        <div class="text-center mt-2">
            <p>New to ReJo Sales? <a href="signup.php" class="text-decoration-none">Sign Up</a></p>
        </div>
    </div>

    <!-- Accept Cookies Bar -->
    <div class="accept-cookies">
        <p>We use cookies to improve your experience. By continuing to browse, you accept our cookie policy.</p>
        <button onclick="acceptCookies()">Accept</button>
    </div>

    <script>
        function acceptCookies() {
            document.querySelector('.accept-cookies').style.display = 'none';
        }
    </script>
</body>
</html>

<?php
require 'db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert the user into the database
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - ReJo Sales</title>
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
        .signup-card {
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

    <!-- Sign Up Card -->
    <div class="signup-card">
        <h2 class="text-center">Sign Up</h2>
        <p class="text-center">Create an account to manage your sales effortlessly.</p>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Sign Up</button>
        </form>
        <div class="text-center mt-3">
            <p>Already have an account? <a href="login.php" class="text-decoration-none">Login</a></p>
        </div>
    </div>

    <!-- Accept Cookies Bar -->
    <div class="accept-cookies">
        <p>We use cookies to enhance your experience. By signing up, you accept our cookie policy.</p>
        <button onclick="acceptCookies()">Accept</button>
    </div>

    <script>
        function acceptCookies() {
            document.querySelector('.accept-cookies').style.display = 'none';
        }
    </script>
</body>
</html>

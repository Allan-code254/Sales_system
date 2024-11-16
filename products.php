<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
            padding: 20px;
        }
        .product {
            width: 200px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.3s ease;
        }
        .product:hover {
            transform: scale(1.05);
        }
        .product img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .product h3 {
            font-size: 1.2em;
            color: #333;
        }
        .product p {
            font-size: 1em;
            color: #555;
        }
        .product .price {
            font-size: 1.1em;
            color: #4CAF50;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <h1>Our Products</h1>
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
        <h2>Featured Products</h2>
        <div class="product-container">
            <!-- Product 1 -->
            <div class="product">
                <img src="img/products/f1.jpg" alt="Product 1">
                <h3>Product 1</h3>
                <p>Meets your needs.</p>
                <div class="price">Ksh 450.00</div>
            </div>
            <!-- Product 2 -->
            <div class="product">
                <img src="img/products/f2.jpg" alt="Product 2">
                <h3>Product 2</h3>
                <p>Durable and reliable for everyday use.</p>
                <div class="price">Ksh 120.00</div>
            </div>
            <!-- Product 3 -->
            <div class="product">
                <img src="img/products/f3.jpg" alt="Product 3">
                <h3>Product 3</h3>
                <p>Elegant design with amazing features.</p>
                <div class="price">Ksh 1500.00</div>
            </div>
            <!-- Product 4 -->
            <div class="product">
                <img src="img/products/f4.jpg" alt="Product 4">
                <h3>Product 4</h3>
                <p>Perfect for outdoor adventures.</p>
                <div class="price">Ksh 1250.00</div>
            </div>
            <!-- Product 5 -->
            <div class="product">
                <img src="img/products/f5.jpg" alt="Product 5">
                <h3>Product 5</h3>
                <p>Stylish, great for travel.</p>
                <div class="price">Ksh 450.00</div>
            </div>
            <!-- Product 6 -->
            <div class="product">
                <img src="img/products/f6.jpg" alt="Product 6">
                <h3>Product 6</h3>
                <p>Premium quality with unmatched durability.</p>
                <div class="price">Ksh 300.00</div>
            </div>
            <!-- Product 7 -->
            <div class="product">
                <img src="img/products/f7.jpg" alt="Product 7">
                <h3>Product 7</h3>
                <p>State-of-the-art technology inside.</p>
                <div class="price">Ksh 250.00</div>
            </div>
            <!-- Product 8 -->
            <div class="product">
                <img src="img/products/f8.jpg" alt="Product 8">
                <h3>Product 8</h3>
                <p>Designed for comfort.</p>
                <div class="price">Ksh 1300.00</div>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Our Online Store. All Rights Reserved.</p>
    </footer>
</body>
</html>

<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
$messageSent = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Normally, you’d send an email or store the message in the database
    // For demonstration, we will just show a confirmation message.
    $messageSent = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f8f9fa; }
        .contact-container { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 90%; max-width: 500px; text-align: center; }
        h2 { color: #333; margin-bottom: 10px; }
        p { color: #666; font-size: 14px; }
        input, textarea { width: 100%; padding: 10px; margin-top: 8px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
        textarea { resize: vertical; }
        button { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-top: 12px; font-size: 16px; }
        button:hover { background-color: #45a049; }
        .message { color: #4CAF50; font-weight: bold; margin-top: 10px; }
    </style>
</head>
<body>

<div class="contact-container">
    <h2>Contact Us</h2>
    <p>We’d love to hear from you. Fill out the form below to reach out.</p>
    
    <?php if ($messageSent): ?>
        <p class="message">Thank you for your message! We will get back to you soon.</p>
    <?php else: ?>
        <form method="post" action="">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" rows="4" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>

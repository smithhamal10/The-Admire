<?php 
session_start();
include 'db_connect.php';

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$thankYou = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $size = trim($_POST['size']);

    // Basic validation
    if (empty($name) || empty($phone) || empty($address) || empty($size)) {
        $error = "All fields are required!";
    } else {
        // Prepare data for DB insertion
        $cart = $_SESSION['cart']; // Assume this is an array of cart items
        $cart_json = json_encode($cart); // Save cart as JSON string

        // Example: Insert into orders table (make sure your table exists and columns match)
        $stmt = $conn->prepare("INSERT INTO orders (name, phone, address, size, cart_items, order_date) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $name, $phone, $address, $size, $cart_json);

        if ($stmt->execute()) {
            $thankYou = true;
            // Clear cart after order is placed
            unset($_SESSION['cart']);
        } else {
            $error = "Failed to place order. Please try again.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - The Admire</title>
    <link rel="stylesheet" href="proceed_to_checkout.css">
</head>
<body>
<!-- Navbar -->
  <nav class="navbar" id="navbar">
    <div class="logo-container">
      <img src="images/logo.jpg" alt="Logo" />
      <span class="brand-name">The Admire</span>
    </div>

    <ul class="nav-links">
      <li><a href="index.html">Home</a></li>
      <li><a href="shop.php">Shop</a></li>
      <li><a href="Contact.html">Contact</a></li>
    </ul>

    <div class="actions">
      <div class="search-container">
        <input type="text" placeholder="Search products..." />
        <button type="submit" aria-label="Search">
          <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M15.5 14h-.79l-.28-.27a6.471 6.471 0 001.48-5.34C15.13 5.59 12.53 3 9.5 3S3.87 5.59 3.87 8.39s2.6 5.39 5.63 5.39c1.61 0 3.07-.59 4.2-1.56l.27.28v.79l5 5.01L20.49 19l-5-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
          </svg>
        </button>
      </div>

      <button class="cart-btn" aria-label="View Cart">
        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
          <path d="M7 18c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm10 0c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm-12.83-3.17l.94-2.83h11.76l1.2 3.6H6.17zM6 4h14l-1.5 4h-11z"/>
        </svg>
        <span class="cart-badge" id="cart-count">3</span>
      </button>

      <button class="login-btn">Login</button>
    </div>
  </nav>
<div class="checkout-container">
    <?php if ($thankYou): ?>
        <h2>Thank you for your order!</h2>
        <p>Your order has been successfully placed. We will contact you shortly.</p>
        <a href="index.html" class="btn">Back to Home</a>
    <?php else: ?>
        <h2>Enter Your Shipping Details</h2>
        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST" class="checkout-form">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">
            
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required value="<?= isset($phone) ? htmlspecialchars($phone) : '' ?>">
            
            <label for="address">Shipping Address:</label>
            <textarea id="address" name="address" required><?= isset($address) ? htmlspecialchars($address) : '' ?></textarea>
            
            <label for="size">Preferred Size:</label>
            <input type="text" id="size" name="size" placeholder="Enter Size (Height, Weight, Waist)" required value="<?= isset($size) ? htmlspecialchars($size) : '' ?>">

            <button type="submit" class="proceed-btn">Order Now</button>
        </form>
    <?php endif; ?>
</div>
  <footer class="footer">
    <div class="footer-content">
      <div class="footer-links">
        <h3>Quick Links</h3>
        <a href="index.html">Home</a>
        <a href="shop.php">shop</a>
        <a href="contact.html">Contact</a>
      </div>
      <div class="footer-contact">
        <h3>Contact Us</h3>
        <p>Email: support@theadmire.com</p>
        <p>Phone: (123) 456-7890</p>
      </div>
      <div class="footer-social">
        <h3>Follow Us</h3>
        <a href="https://www.instagram.com/theadmire.np/"><img src="images/intagram.png" alt="intagram-icon" /></a>
        <a href="#"><img src="images/tiktok-icon.png" alt="tiktok-icon" /></a>
      </div>
    </div>
    <p>© 2025 The Admire. All rights reserved.</p>
  </footer>
</body>
</html>

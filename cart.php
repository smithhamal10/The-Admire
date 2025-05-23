<?php
session_start();
include 'db_connect.php';

// Update quantity if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $id => $qty) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] = max(1, intval($qty));
        }
    }
    header("Location: cart.php");
    exit();
}

// Remove item
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit();
}

function calculate_total($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart - The Admire</title>
    <link rel="stylesheet" href="cart.css">
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
<div class="cart-container">
    <h2>Your Shopping Cart</h2>
    <?php if (!empty($_SESSION['cart'])): ?>
        <form method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price (Rs)</th>
                        <th>Quantity</th>
                        <th>Subtotal (Rs)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                    <tr>
                        <td data-label="Image"><img src="<?= htmlspecialchars($item['image_url']) ?>" alt="" width="60"></td>
                            <td data-label="Name"><?= htmlspecialchars($item['name']) ?></td>
                            <td data-label="Price (Rs)"><?= htmlspecialchars($item['price']) ?></td>
                            <td data-label="Quantity">
                                <input type="number" name="quantities[<?= $id ?>]" value="<?= $item['quantity'] ?>" min="1">
                            </td>
                            <td data-label="Subtotal (Rs)"><?= $item['price'] * $item['quantity'] ?></td>
                            <td data-label="Action"><a href="cart.php?remove=<?= $id ?>" class="remove-btn">Remove</a></td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="cart-summary">
                <p><strong>Total: Rs <?= calculate_total($_SESSION['cart']) ?></strong></p>
                <button type="submit" name="update_cart" class="update-btn">Update Cart</button>
                <a href="proceed_to_checkout.php" class="checkout-btn">Proceed to Checkout</a>
            </div>
        </form>
    <?php else: ?>
        <p>Your cart is empty.</p>
        <a href="shop.php" class="shop-link">Continue Shopping</a>
    <?php endif; ?>
</div>
<!-- Footer -->
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

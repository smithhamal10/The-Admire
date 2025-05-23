<?php
// Start session and include DB connection
session_start();
include 'db_connect.php';

// Initialize cart if not already
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Shop - The Admire</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="shop.css">
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
<a href="cart.php" class="cart-btn" aria-label="View Cart">
  <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
    <path d="M7 18c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm10 0c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm-12.83-3.17l.94-2.83h11.76l1.2 3.6H6.17zM6 4h14l-1.5 4h-11z"/>
  </svg>
  <span class="cart-badge" id="cart-count"><?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0; ?></span>
</a>

  </button>

  <?php if (isset($_SESSION['user'])): ?>
    <button class="login-btn" id="logout-btn">Logout</button>
  <?php else: ?>
    <button class="login-btn" onclick="window.location.href='login.php'">Login</button>
  <?php endif; ?>
</div>

  </nav>

<section class="product-list">
<h2>Men's Latest Collection</h2>
  <div class="collection-grid">
    <?php
    // Fetch products from database
    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="clothing-card">';
        echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '">';
        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
        echo '<p>Rs' . htmlspecialchars($row['price']) . '</p>';
        echo '<a href="add_to_cart.php?id=' . $row['id'] . '" class="btn-primary">Add to Cart</a>';
        echo '</div>';
      }
    } else {
      echo '<p>No products available.</p>';
    }
    ?>
  </div>
</section>

<!-- Footer -->
  <footer class="footer">
    <div class="footer-content">
      <div class="footer-links">
        <h3>Quick Links</h3>
        <a href="index.php">Home</a>
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
  <script>
// Search Functionality
const searchInput = document.querySelector('.search-container input[type="text"]');
const clothingCards = document.querySelectorAll('.clothing-card');

searchInput.addEventListener('input', () => {
  const query = searchInput.value.toLowerCase();

  clothingCards.forEach(card => {
    const title = card.querySelector('h3').textContent.toLowerCase();
    if (title.includes(query)) {
      card.style.display = '';
    } else {
      card.style.display = 'none';
    }
  });
});

// Add to Cart Buttons
const addToCartButtons = document.querySelectorAll('.clothing-card .btn-primary');

addToCartButtons.forEach(button => {
  button.addEventListener('click', e => {
    e.preventDefault();
    if (!isLoggedIn) {
      alert('Please login to add items to your cart.');
      return;
    }
    // Here you can add your logic to add item to cart (e.g., API call or update cart UI)
    // For demo, increment the cart count:
    let count = parseInt(cartCount.textContent) || 0;
    cartCount.textContent = count + 1;
  });
});
const cartCount = document.getElementById("cart-count");
const isLoggedIn = <?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>;

const addToCartButtons = document.querySelectorAll(".add-to-cart");
addToCartButtons.forEach(button => {
  button.addEventListener('click', function(e) {
    e.preventDefault();
    if (!isLoggedIn) {
      alert('Please login to add items to your cart.');
      return;
    }
    let count = parseInt(cartCount.textContent) || 0;
    count++;
    cartCount.textContent = count;

    // TODO: Add AJAX call here to update server
  });
});

<?php if (isset($_SESSION['user'])): ?>
document.getElementById('logout-btn').addEventListener('click', function() {
  fetch('logout.php', { method: 'POST' })
    .then(res => res.json())
    .then(data => {
      if(data.status === 'success'){
        location.reload();
      }
    });
});
<?php endif; ?>

</script>
</body>
</html>

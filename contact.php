<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_destroy();
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us - The Admire</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
  <link href="contact.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar" id="navbar">
    <div class="logo-container">
      <img src="images/logo.jpg" alt="Logo" />
      <span class="brand-name">The Admire</span>
    </div>

    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="shop.php">Shop</a></li>
      <li><a href="contact.php">Contact</a></li>
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
        <span class="cart-badge" id="cart-count">
          <?php 
            echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
          ?>
        </span>
      </button>

     <?php if (isset($_SESSION['user'])): ?>
  <button class="login-btn" id="logout-btn">Logout</button>
<?php else: ?>
  <button class="login-btn" onclick="window.location.href='login.php'">Login</button>
<?php endif; ?>

    </div>
  </nav>

  <section class="contact-section">
    <h2>Contact Us</h2>
    <form action="#" method="post" class="contact-form">
      <input type="text" name="name" placeholder="Your Name" required />
      <input type="email" name="email" placeholder="Your Email" required />
      <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
      <button type="submit" class="btn-primary">Send Message</button>
    </form>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-content">
      <div class="footer-links">
        <h3>Quick Links</h3>
        <a href="index.php">Home</a>
        <a href="shop.php">Shop</a>
        <a href="contact.php">Contact</a>
      </div>
      <div class="footer-contact">
        <h3>Contact Us</h3>
        <p>Email: support@theadmire.com</p>
        <p>Phone: (123) 456-7890</p>
      </div>
      <div class="footer-social">
        <h3>Follow Us</h3>
        <a href="https://www.instagram.com/theadmire.np/"><img src="images/intagram.png" alt="instagram-icon" /></a>
        <a href="#"><img src="images/tiktok-icon.png" alt="tiktok-icon" /></a>
      </div>
    </div>
    <p>© 2025 The Admire. All rights reserved.</p>
  </footer>

  <script>
  // Search Functionality (optional)
  const searchInput = document.querySelector('.search-container input[type="text"]');
  const clothingCards = document.querySelectorAll('.clothing-card');

  if(searchInput){
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
  }
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

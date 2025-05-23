<?php 
session_start();

// Calculate cart count based on actual cart array in session
$cart_count = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    $cart_count = count($_SESSION['cart']);
    $_SESSION['cart_count'] = $cart_count; // keep session count consistent
} else {
    $_SESSION['cart_count'] = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>The Admire</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet" />
  <link href="index.css" rel="stylesheet">
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

  <a href="cart.php" class="cart-btn" aria-label="View Cart">
    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
      <path d="M7 18c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm10 0c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm-12.83-3.17l.94-2.83h11.76l1.2 3.6H6.17zM6 4h14l-1.5 4h-11z"/>
    </svg>
   <span class="cart-badge" id="cart-count"><?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0; ?></span>

  </a>

  <?php if (isset($_SESSION['user'])): ?>
    <button class="login-btn" id="logout-btn">Logout</button>
  <?php else: ?>
    <button class="login-btn" onclick="window.location.href='login.php'">Login</button>
  <?php endif; ?>
</div>

  </nav>

  <!-- Hero Slider -->
  <section class="hero-slider">
    <div class="slide active" style="background-image: url('images/banner1.jpg')">
      <div class="hero-content">
        <h1>Step Into Style with The Admire</h1>
        <p>Discover exclusive collections that elevate your look.</p>
        <a href="#" class="btn-primary">Shop Now</a>
      </div>
    </div>
    <div class="slide" style="background-image: url('images/banner2.jpg')">
      <div class="hero-content">
        <h1>New Arrivals Are Here</h1>
        <p>Fresh styles, fresh vibes—check them out now.</p>
        <a href="#" class="btn-primary">Shop Now</a>
      </div>
    </div>
    <div class="slide" style="background-image: url('images/banner3.jpg')">
      <div class="hero-content">
        <h1>Exclusive Deals For You</h1>
        <p>Save big on your favorite picks.</p>
        <a href="#" class="btn-primary">Shop Now</a>
      </div>
    </div>
    <button class="prev" aria-label="Previous Slide">❮</button>
    <button class="next" aria-label="Next Slide">❯</button>
  </section>

  <!-- Promotions Banner -->
  <section class="promo-banner">
    <div class="promo-content">
      <h2>Save 20% on Your First Order!</h2>
    </div>
  </section>

   <!-- Men's Clothing Section -->
  <section class="mens-collection">
  <h2>Men's Collection</h2>
  <div class="collection-grid">
    <div class="clothing-card">
      <img src="images/shirts.jpg" alt="Shirts" />
      <h3>Shirts</h3>
      <p>Stylish shirts for every occasion.</p>
      <a href="shirts.html" class="btn-primary">View</a>
    </div>
    <div class="clothing-card">
      <img src="images/jackets.jpg" alt="Jackets" />
      <h3>Jackets</h3>
      <p>Warm and trendy jackets.</p>
      <a href="jackets.html" class="btn-primary">View</a>
    </div>
    <div class="clothing-card">
      <img src="images/hoodies.jpg" alt="Hoodies" />
      <h3>Hoodies</h3>
      <p>Comfortable hoodies for everyday wear.</p>
      <a href="hoodies.html" class="btn-primary">View</a>
    </div>
    <div class="clothing-card">
      <img src="images/pants.jpg" alt="Pants" />
      <h3>Pants</h3>
      <p>Fit and style combined.</p>
      <a href="pants.html" class="btn-primary">View</a>
    </div>
    <div class="clothing-card">
      <img src="images/shoes.jpg" alt="Shoes" />
      <h3>Shoes</h3>
      <p>Step up your game with our shoes.</p>
      <a href="shoes.html" class="btn-primary">View</a>
    </div>
    <div class="clothing-card">
      <img src="images/underwear.jpg" alt="Shoes" />
      <h3>Undergarments</h3>
      <p>Stay calm and cool</p>
      <a href="underwear.html" class="btn-primary">View</a>
    </div>
    <div class="clothing-card">
      <img src="images/socks.jpg" alt="Socks" />
      <h3>Socks</h3>
      <p>Step up your game with our socks.</p>
      <a href="socks.html" class="btn-primary">View</a>
    </div>
  </div>
</section>

  <!-- Featured Products Section -->
  <section class="featured-products">
    <h2>Featured Products</h2>
    <div class="collection-grid">
      <div class="clothing-card" data-category="shirts">
        <img src="https://www.johnstonmurphy.com/on/demandware.static/-/Sites-genesco-master/default/dwa782aff9/large/749493_master.jpg?strip=false" alt="Premium Shirt" />
        <h3>Premium Cotton Shirt</h3>
        <a href="#" class="btn-primary add-to-cart">Add to Cart</a>
      </div>
      <div class="clothing-card" data-category="jackets">
        <img src="https://www.sukumart.com/images/2024/01/80064-DSC_1759-.jpg" alt="Leather Jacket" />
        <h3>Classic Leather Jacket</h3>
        <a href="#" class="btn-primary add-to-cart">Add to Cart</a>
      </div>
      <div class="clothing-card" data-category="hoodies">
        <img src="https://blackthoughtsstore.com/cdn/shop/files/cozy_feelings_front.jpg?v=1691967852&width=990" alt="Cozy Hoodie" />
        <h3>Cozy Fleece Hoodie</h3>
        <a href="#" class="btn-primary add-to-cart">Add to Cart</a>
      </div>
    </div>
  </section>

 <!-- Newsletter Section -->
<section class="newsletter">
  <div class="newsletter-wrapper">

    <!-- Left GIF -->
    <div class="newsletter-media">
      <img src="https://i.gifer.com/SnJt.gif" alt="Exciting Offer" />
    </div>

    <!-- Newsletter Form Content -->
    <div class="newsletter-content">
      <h2>Join Our Newsletter</h2>
      <p>Get the latest updates and exclusive offers.</p>
      <form>
        <input type="email" placeholder="Enter your email" required />
        <button type="submit">Subscribe</button>
      </form>
    </div>
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
// Hero slider JS same as before
const slides = document.querySelectorAll(".hero-slider .slide");
const prevBtn = document.querySelector(".prev");
const nextBtn = document.querySelector(".next");
let currentSlide = 0;

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.toggle("active", i === index);
  });
}

prevBtn.addEventListener("click", () => {
  currentSlide = (currentSlide - 1 + slides.length) % slides.length;
  showSlide(currentSlide);
});

nextBtn.addEventListener("click", () => {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide(currentSlide);
});

showSlide(currentSlide);

// Add to Cart logic with PHP session check
const cartCount = document.getElementById("cart-count");
const addToCartButtons = document.querySelectorAll(".add-to-cart");

// Since PHP session controls login, pass PHP login status to JS
const isLoggedIn = <?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>;

addToCartButtons.forEach(button => {
  button.addEventListener('click', function(e) {
    e.preventDefault();
    if (!isLoggedIn) {
      alert('Please login to add items to your cart.');
      return;
    }

    // Increase cart count visually
    let count = parseInt(cartCount.textContent) || 0;
    count++;
    cartCount.textContent = count;

    // TODO: Add AJAX call here to update cart in server session or database
  });
});

<?php if (isset($_SESSION['user'])): ?>
  // Logout button logic
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

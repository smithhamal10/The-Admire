<?php
session_start();
include 'db_connect.php';

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Fetch product from database
    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);

        // Initialize cart if not already
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add or update cart item
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$product_id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image_url' => $product['image_url'],
                'quantity' => 1
            ];
        }

        // Redirect back to shop page
        header("Location: shop.php");
        exit();
    } else {
        echo "Product not found.";
    }
} else {
    echo "No product ID provided.";
}
?>

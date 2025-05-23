// add_to_cart.php
<?php
session_start();
include 'db_connect.php';

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

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

        $_SESSION['cart_count'] = array_sum(array_column($_SESSION['cart'], 'quantity'));

        header("Location: shop.php");
        exit();
    } else {
        echo "Product not found.";
    }
} else {
    echo "No product ID provided.";
}
?>

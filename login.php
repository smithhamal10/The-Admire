<?php
session_start();
include 'db_connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user'] = $username;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['cart_count'] = 0;
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - The Admire</title>
    <link rel="stylesheet" href="auth.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
   <div class="form-container">
    <h2>Login to Your Account</h2>
    <?php if (!empty($error)): ?>
        <div class="error-msg" style="color:red; margin-bottom: 15px;"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="POST" action="login.php" autocomplete="off">
      <input type="email" name="email" placeholder="Email Address" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <div class="form-footer">
      Don't have an account? <a href="register.php">Register here</a>
    </div>
   </div>
</body>
</html>

<?php
session_start();
include 'db_connect.php';

$error = '';
$username = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "An account with this email already exists.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['user'] = $email;
                $_SESSION['cart_count'] = 0;
                header("Location: login.php");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - The Admire</title>
    <link rel="stylesheet" href="auth.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
   <div class="form-container">
    <h2>Create Account</h2>
    <?php if (!empty($error)): ?>
        <div class="error-msg" style="color:red; margin-bottom: 15px;"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="POST" action="register.php" autocomplete="off">
        <input type="text" name="username" placeholder="Username" required value="<?php echo htmlspecialchars($username); ?>" />
        <input type="email" name="email" placeholder="Email Address" required value="<?php echo htmlspecialchars($email); ?>" />
        <input type="password" name="password" placeholder="Password" required />
        <input type="password" name="confirm_password" placeholder="Confirm Password" required />
        <button type="submit">Register</button>
    </form>
    <div class="form-footer">
        Already have an account? <a href="login.php">Login here</a>
    </div>
   </div>
</body>
</html>

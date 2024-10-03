<?php
session_start();
require 'db.php'; 

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/login.css">
    <title>Login | Blogs</title>
</head>

<body>
    <div class="wrapper">
        <form method="post" action="login.php">
            <h2>Login</h2>
            <div class="input box">
                <input type="text" name="username" placeholder="Username" required><br>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input box">
                <input type="password" name="password" placeholder="Password" required><br>
                <i class="fa-solid fa-lock"></i>
            </div>
            <p class="error"> <?php echo $error ?></p>
            <button type="submit">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="signup.php">Signup</a> </p>
            </div>

        </form>
    </div>
</body>

</html>
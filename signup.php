<?php
require 'db.php'; 

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Password encryption

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param('ss', $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
       $error = "Username or Email already exists.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $username, $email, $password);
        if ($stmt->execute()) {
            header("Location: login.php");
        } else {
            echo "Error: " . $conn->error;
        }
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
    <title>Sign-Up | Blogs</title>
</head>

<body>
    <div class="wrapper">
        <h2>Sign-Up</h2>
        <form method="post" action="signup.php">
            <div class="input box">
                <input type="text" name="username" placeholder="Username" required><br><i class="fa-solid fa-user"></i>
            </div>
            <div class="input box">
                <input type="email" name="email" placeholder="Email" required><br><i class="fa-solid fa-envelope"></i>
            </div>
            <div class="input box">
                <input type="password" name="password" placeholder="Password" required><br> <i class="fa-solid fa-lock"></i>
            </div>
            <p class="error"> <?php echo $error ?></p>
            <button type="submit">Sign Up</button>
            <div class="register-link">
                <p>Have an account? <a href="login.php">Login</a> </p>
            </div>
        </form>
    </div>
</body>

</html>
<?php
require 'db.php';

if (!isset($_GET['id'])) {
    header("Location: public_blog.php");
    exit();
}

$post_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ? AND status = 'published'");
$stmt->bind_param('i', $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    header("Location: public_blog.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
   
</head>
<body>
<header>
        <h1>Blog Posts</h1>
        <a href="login.php" class="btn">Publish Your Blog</a>
    </header>
    <div class="container">
        <div class="post">
            <h1 class="title-txt"><?php echo htmlspecialchars($post['title']); ?></h1>
            <p><?php echo $post['content']; ?></p>
            <div class="post-tags">
                Tags: <?php echo htmlspecialchars($post['tags']); ?>
            </div>
        </div>
    </div>
</body>
</html>

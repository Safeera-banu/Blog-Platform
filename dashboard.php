<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$posts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Dashboard</title>
</head>

<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <a href="logout.php" class="btn">Logout</a>
    </header>

    <div class="container">
        <a href="create_post.php" class="btn">Create New Post</a>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th> 
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($posts) > 0): ?>
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($post['title']); ?></td>
                            <td><?php echo ($post['status'] == 'published') ? 'Published' : 'Draft'; ?></td> <!-- Status displayed here -->
                            <td>
                                <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn">Edit</a>
                                <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">You haven't created any posts yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$post_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ? LIMIT 1");
$stmt->bind_param('ii', $post_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Post not found.";
    exit();
}

$post = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $tags = $_POST['tags'];
    $status = $_POST['status'];

    if (empty($title) || empty($content)) {
        $error = "Both title and content are required.";
    } else {
        $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, tags = ?, status = ? WHERE id = ?");
        $stmt->bind_param('ssssi', $title, $content, $tags, $status, $post_id);

        if ($stmt->execute()) {
            header("Location: dashboard.php");
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
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tiny.cloud/1/ugy5090pfhfug06i1ddju3llmn4urffvyw3yehx0dwb56u93/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#content',
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste help wordcount',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            height: 400,
            menubar: false
        });
    </script>
    <title>Edit Post</title>
</head>

<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <a href="logout.php" class="btn">Logout</a>
    </header>
    <div class="container">
        <h2>Edit Post</h2>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post" action="edit_post.php?id=<?php echo $post_id; ?>">
            <input class="input-post" type="text" name="title" placeholder="Title"
                value="<?php echo htmlspecialchars($post['title']); ?>" required><br>
                
            <textarea id="content" class="input-post"
                name="content"><?php echo htmlspecialchars($post['content']); ?></textarea><br>

            <input type="text" class="input-post" name="tags" placeholder="Tags (optional, comma-separated)"
                value="<?php echo htmlspecialchars($post['tags']); ?>"><br>
            <select name="status" id="status">
                <option value="draft" <?php echo $post['status'] == 'draft' ? 'selected' : ''; ?>>Save as Draft</option>
                <option value="published" <?php echo $post['status'] == 'published' ? 'selected' : ''; ?>>Publish</option>
            </select><br><br>
            <button type="submit" class="btn">Update Post</button>
        </form>
    </div>
    <script>
        // Auto-save interval (in milliseconds) – every 30 seconds
        let autoSaveInterval = 30000; // 30 seconds
        let autoSaveTimer;

        // Auto-save the post as draft via AJAX
        function autoSaveDraft() {
            const title = document.querySelector('input[name="title"]').value;
            const content = tinymce.get('content').getContent(); // Get content from TinyMCE editor
            const tags = document.querySelector('input[name="tags"]').value;
            const status = 'draft'; // Always save as draft in auto-save

            // Check if title or content is empty before attempting to save
            if (!title || !content) {
                return;
            }

            // Perform AJAX request to auto-save the draft
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "auto_save_edit.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Handle server response
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log('Draft auto-saved successfully');
                }
            };

            // Send the draft data to the server
            xhr.send(`id=${encodeURIComponent(<?php echo $post_id; ?>)}&title=${encodeURIComponent(title)}&content=${encodeURIComponent(content)}&tags=${encodeURIComponent(tags)}&status=${encodeURIComponent(status)}`);
        }

        // Set auto-save timer on page load
        window.onload = function () {
            autoSaveTimer = setInterval(autoSaveDraft, autoSaveInterval);
        };

        // Auto-save when user is inactive for 1 minute
        let activityTimeout;
        function resetActivityTimer() {
            clearTimeout(activityTimeout);
            activityTimeout = setTimeout(autoSaveDraft, 60000); // 1 minute inactivity
        }

        // Reset the timer on user activity
        document.onmousemove = resetActivityTimer;
        document.onkeypress = resetActivityTimer;
    </script>
</body>

</html>
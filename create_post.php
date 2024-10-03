<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = null;

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id']; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $tags = $_POST['tags'];
    $status = $_POST['status'];

    if (empty($title) || empty($content)) {
        $error = "Both title and content are required.";
    } else {
        if ($post_id) {
            $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, tags = ?, status = ? WHERE id = ? AND user_id = ?");
            $stmt->bind_param('ssssii', $title, $content, $tags, $status, $post_id, $user_id);
        } else {
            $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content, tags, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('issss', $user_id, $title, $content, $tags, $status);
        }

        if ($stmt->execute()) {
            if (!$post_id) {
                $post_id = $conn->insert_id; 
            }
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
    <title>Create Post</title>
</head>

<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <a href="logout.php" class="btn">Logout</a>
    </header>
    <div class="container">
        <h2>Create New Post</h2>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post" action="create_post.php">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>"> 
            <input class="input-post" type="text" name="title" placeholder="Title" value="<?php echo isset($title) ? $title : ''; ?>"
                required><br>
            <textarea id="content" class="input-post" name="content"><?php echo isset($content) ? $content : ''; ?></textarea><br>
            <input type="text" class="input-post" name="tags" placeholder="Tags (optional, comma-separated)"
                value="<?php echo isset($tags) ? $tags : ''; ?>"><br>
            <select name="status" id="status">
                <option value="draft" <?php echo (isset($status) && $status == 'draft') ? 'selected' : ''; ?>>Save as
                    Draft
                </option>
                <option value="published" <?php echo (isset($status) && $status == 'published') ? 'selected' : ''; ?>>
                    Publish
                </option>
            </select><br><br>
            <button type="submit" class="btn">Save Post</button>
        </form>
    </div>

    <script>
        const autoSaveInterval = 30000; 
        let autoSaveTimer;

        function autoSaveDraft() {
            const title = document.querySelector('input[name="title"]').value;
            const content = tinymce.get('content').getContent(); 
            const tags = document.querySelector('input[name="tags"]').value;
            const status = 'draft'; 
            let post_id = document.querySelector('input[name="post_id"]').value; 

            if (!title || !content) {
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "auto_save_draft.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        console.log(response.message);
                        if (response.post_id) {
                            // If a new post_id is returned, save it in the form for future auto-saves
                            document.querySelector('input[name="post_id"]').value = response.post_id;
                        }
                    } else {
                        console.error(response.message);
                    }
                }
            };

            // Send the draft data to the server, including the post_id 
            xhr.send(`post_id=${post_id}&title=${encodeURIComponent(title)}&content=${encodeURIComponent(content)}&tags=${encodeURIComponent(tags)}&status=${encodeURIComponent(status)}`);
        }

        window.onload = function () {
            autoSaveTimer = setInterval(autoSaveDraft, 30000); 
        };

        document.onmousemove = resetActivityTimer;
        document.onkeypress = resetActivityTimer;
    </script>
</body>

</html>
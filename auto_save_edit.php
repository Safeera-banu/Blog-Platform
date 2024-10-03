<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "Not authorized";
    exit();
}

$user_id = $_SESSION['user_id'];

// Get the post ID and updated content from the AJAX request
if (isset($_POST['id'], $_POST['title'], $_POST['content'], $_POST['tags'], $_POST['status'])) {
    $post_id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $tags = $_POST['tags'];
    $status = $_POST['status'];

    // Update the draft in the database
    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, tags = ?, status = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param('ssssii', $title, $content, $tags, $status, $post_id, $user_id);

    if ($stmt->execute()) {
        echo "Draft auto-saved.";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid data.";
}
?>

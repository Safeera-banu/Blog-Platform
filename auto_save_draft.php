<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    exit('Unauthorized');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $tags = $_POST['tags'];
    $status = $_POST['status'];
    $user_id = $_SESSION['user_id'];

    if (!empty($title) && !empty($content)) {
        if (!empty($post_id)) {
            // If post_id exists, update the existing draft
            $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, tags = ?, status = ? WHERE id = ? AND user_id = ?");
            $stmt->bind_param('ssssii', $title, $content, $tags, $status, $post_id, $user_id);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Draft updated successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error updating draft: ' . $stmt->error]);
            }
        } else {
            // If no post_id, insert a new draft
            $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content, tags, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('issss', $user_id, $title, $content, $tags, $status);

            if ($stmt->execute()) {
                $new_post_id = $conn->insert_id; 
                echo json_encode(['status' => 'success', 'message' => 'Draft saved successfully', 'post_id' => $new_post_id]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error inserting new draft: ' . $stmt->error]);
            }
        }
    }
}
?>

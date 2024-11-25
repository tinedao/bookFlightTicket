<?php
include 'connect.php';

if (isset($_POST['comment_id']) && isset($_POST['reply'])) {
    $comment_id = $_POST['comment_id'];
    $reply = $_POST['reply'];

    $sql = "INSERT INTO comment_replies (comment_id, reply) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $comment_id, $reply);
    $stmt->execute();

    // Lấy lại post_id từ comment_id để chuyển hướng đúng
    $sql = "SELECT post_id FROM comments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $comment = $result->fetch_assoc();
    $post_id = $comment['post_id'];

    header("Location: ../discussion.php?post_id=$post_id");
    exit();
} else {
    echo "Missing information.";
}
?>

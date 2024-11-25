<?php
include 'connect.php';

$id = $_POST['id'];
$comment = $_POST['comment'];

$sql = "INSERT INTO comments (post_id, comment, username, full_name, created_at) VALUES (?, ?, 'username', 'Full Name', NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id, $comment);

if ($stmt->execute()) {
    header("Location: ../postDetail.php?id=" . $id);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>

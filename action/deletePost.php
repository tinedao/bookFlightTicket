<?php
session_start();
include 'config/connect.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$post_id = $_GET['id'];

$sql = "DELETE FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();

header('Location: ../discussion.php');
exit();

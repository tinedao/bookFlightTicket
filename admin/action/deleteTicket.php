<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit;
}
include '../../config/connect.php';

$ticket_id = $_GET['ticket_id'];

$sql = "DELETE FROM tickets WHERE ticket_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ticket_id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Xóa vé thành công!";
} else {
    $_SESSION['error'] = "Xóa vé thất bại!";
}

header("Location: ../product.php");
exit;
?>

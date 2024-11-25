<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit;
}
include '../../config/connect.php';

$airline_id = $_GET['id'];

$sql = "DELETE FROM airlines WHERE airline_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $airline_id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Xóa hãng hàng không thành công!";
} else {
    $_SESSION['error'] = "Xóa hãng hàng không thất bại!";
}

header("Location: ../airlineBrand.php");
exit;
?>

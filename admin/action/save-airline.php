<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
include '../../config/connect.php';

$airline_id = $_POST['airline_id'];
$airline_name = $_POST['airline_name'];
$airline_code = $_POST['airline_code'];

if ($airline_id) {
    // Cập nhật thông tin hãng hàng không
    $sql = "UPDATE airlines SET airline_name=?, airline_code=? WHERE airline_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $airline_name, $airline_code, $airline_id);
} else {
    // Thêm hãng hàng không mới
    $sql = "INSERT INTO airlines (airline_name, airline_code) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $airline_name, $airline_code);
}

if ($stmt->execute()) {
    $_SESSION['success'] = $airline_id ? "Cập nhật hãng hàng không thành công!" : "Thêm hãng hàng không mới thành công!";
    header("Location: ../airlineBrand.php");
    exit;
} else {
    $_SESSION['error'] = $airline_id ? "Cập nhật hãng hàng không thất bại!" : "Thêm hãng hàng không mới thất bại!";
    header("Location: ../add-airline.php" . ($airline_id ? "?id=$airline_id" : ""));
    exit;
}
?>

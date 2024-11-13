<?php
session_start();
include 'config/connect.php';

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$ticket_id = $_POST['ticket_id'];
$total_price = $_POST['total_price'];

// Kiểm tra số dư trong ví người dùng
$sql = "SELECT wallet FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user['wallet'] >= $total_price) {
    // Trừ tiền trong ví người dùng
    $sql = "UPDATE users SET wallet = wallet - ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ds", $total_price, $username);
    $stmt->execute();

    // Cập nhật trạng thái thanh toán trong bảng cart
    $sql = "UPDATE cart SET paid = 1 WHERE username = ? AND ticket_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $username, $ticket_id);
    $stmt->execute();

    echo "Thanh toán thành công!";
} else {
    echo "Số dư không đủ để thanh toán!";
}

// Quay lại trang giỏ hàng
header('Location: cart.php');
exit();
?>

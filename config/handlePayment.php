<?php
include 'connect.php';
session_start();

if (isset($_POST['ticket_id']) && isset($_POST['total_price'])) {
    $ticket_id = $_POST['ticket_id'];
    $total_price = $_POST['total_price'];
    $username = $_SESSION['username'];

    // Lấy số lượng vé từ giỏ hàng
    $sql = "SELECT quantity FROM cart WHERE ticket_id = ? AND username = ? AND paid = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ticket_id, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart_item = $result->fetch_assoc();
    $quantity = $cart_item['quantity'];

    // Trừ tổng giá trị vào ví của người dùng
    $sql = "UPDATE users SET wallet = wallet - ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ds", $total_price, $username);
    $stmt->execute();

    // Cập nhật giá trị paid trong giỏ hàng
    $sql = "UPDATE cart SET paid = 1 WHERE ticket_id = ? AND username = ? AND paid = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ticket_id, $username);
    $stmt->execute();

    // Trừ số lượng vé còn lại
    $sql = "UPDATE tickets SET remaining = remaining - ? WHERE ticket_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $quantity, $ticket_id);
    $stmt->execute();

    header("Location: ../cart.php");
    exit();
} else {
    echo "Missing information.";
}
?>

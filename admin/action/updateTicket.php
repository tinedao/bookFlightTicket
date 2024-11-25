<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
include '../../config/connect.php';

$ticket_id = $_POST['ticket_id'];
$departure = $_POST['departure'];
$destination = $_POST['destination'];
$airline_code = $_POST['airline_code'];
$departure_time = $_POST['departure_time'];
$price = $_POST['price'];
$discount = $_POST['discount'] / 100; // Chuyển đổi phần trăm thành số thập phân
$remaining = $_POST['remaining'];

$sql = "UPDATE tickets SET departure=?, destination=?, airline_code=?, departure_time=?, price=?, discount=?, remaining=? WHERE ticket_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iissdiii", $departure, $destination, $airline_code, $departure_time, $price, $discount, $remaining, $ticket_id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Cập nhật vé thành công!";
    header("Location: ../product.php");
    exit;
} else {
    $_SESSION['error'] = "Cập nhật vé thất bại!";
    header("Location: ../editTicket.php?ticket_id=$ticket_id");
    exit;
}
?>

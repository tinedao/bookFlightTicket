<?php
include 'config/connect.php';
$userAd = 'master';
$passwordAd = password_hash('quangtiendz1', PASSWORD_DEFAULT);
$role = 1;

$sql = "INSERT INTO admin (idAd, userAd, passwordAd, role) VALUES (NULL, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssi', $userAd, $passwordAd, $role);
$stmt->execute();
if ($stmt->affected_rows > 0) {
    echo "Tạo tài khoản thành công!";
} else {
    echo "Lỗi tạo tài khoản!";
}
$stmt->close();
$conn->close();

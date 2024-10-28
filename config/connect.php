<?php
// kết nối cơ sở dữ liệu
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'flighttickets';

// tạo kết nối
$conn = new mysqli($host, $username, $password, $dbname);

// kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

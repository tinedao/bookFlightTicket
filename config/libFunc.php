<?php
function isTicketInCart($ticket_id, $username, $conn) {
    $sql = "SELECT * FROM cart WHERE ticket_id = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ticket_id, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $interval = $now->diff($ago);

    $strings = array();
    $intervals = array(
        'y' => 'năm',
        'm' => 'tháng',
        'w' => 'tuần',
        'd' => 'ngày',
        'h' => 'giờ',
        'i' => 'phút',
    );

    foreach ($intervals as $interval_key => $interval_name) {
        if ($interval->$interval_key) {
            $strings[] = $interval->$interval_key . ' ' . $interval_name;
        }
    }

    $result = implode(', ', $strings) . ' trước';
    return $result ? $result : 'vừa xong';
}
function handleFileUpload($file, $uploadDir = 'assets/img/') {
    if ($file['error'] == 0) {
        $img_name = basename($file['name']);
        $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_token = uniqid() . '.' . $img_extension; // Tạo tên ảnh mới bằng token
        $target_file = $uploadDir . $img_token;
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            return $img_token;
        } else {
            return false;
        }
    }
    return false;
}
?>

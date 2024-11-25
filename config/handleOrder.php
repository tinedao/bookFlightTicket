<?php
include 'connect.php';
session_start();

if (isset($_POST['ticket_id']) && isset($_POST['quantity'])) {
    $ticket_id = $_POST['ticket_id'];
    $quantity = $_POST['quantity'];
    $username = $_SESSION['username'];

    error_log("ticket_id: " . $ticket_id);
    error_log("quantity: " . $quantity);
    error_log("username: " . $username);

    $sql = "INSERT INTO cart (cart_id, username, ticket_id, quantity, paid) VALUES (NULL, ?, ?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $ticket_id, $quantity);
    $stmt->execute();

    header("Location: ../cart.php");
    exit();
} else {
    echo "Missing information.";
}
?>

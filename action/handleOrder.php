<?php
session_start();

if(isset($_SESSION['username'])) {
    header('Location: ../detailPro.php?ticket_id=' . $_POST['ticket_id']);
    exit();
} else {
    header('Location: ../login.php');
    exit();
}
?>

<?php
include_once('../../config/connect.php');

$id = $_GET['username'];
$sql = "DELETE FROM users WHERE username='$id'";
if (mysqli_query($conn, $sql)) {
    header("Location: ../account.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);


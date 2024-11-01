<?php
include  'layout\header.php';
include 'config/connect.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Đổi lại thành password_verify
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['username'] = $row['username'];
            $_SESSION['full_name'] = $row['full_name'];
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Tài khoản hoặc mật khẩu không chính xác')</script>";
        }
    } else {
        echo "<script>alert('Tài khoản không tồn tại')</script>";
    }
}



?>
<style>
    body {
        background-image: url("assets/img/pexels-buxteh-19649705.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        font-family: 'Roboto', sans-serif !important;
        background-color: rgba(0, 0, 0, 0.8);
    }
</style>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="form bg-white p-5 rounded shadow" style="width: 600px;">
        <div class="text-center mb-4">
            <a href="index.php"><img src="assets/img/logo.png" alt="logo" class="img-fluid" style="width: 150px;"></a>
        </div>
        <h2 class="text-center text-uppercase mb-4">Đăng nhập</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Đăng nhập</button>
        </form>
        <p class="mt-4 text-center">
            <a href="forgot-password.php" class="text-success">Quên mật khẩu?</a>
            <br>
            <a href="register.php" class="text-success">Tạo tài khoản</a>
        </p>
    </div>
</div>
<?php include 'layout\footer.php'; ?>



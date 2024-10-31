<?php include  'layout\header.php'; 
    include 'config/connect.php';
?>
<?php
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];
    $password = $_POST["password"];
    $full_name = $_POST["full_name"];

    if (empty($username) || empty($email) || empty($phone) || empty($dob) || empty($password) || empty($full_name)) {
        $error = "Vui lòng điền đầy đủ thông tin";
    } else {
        if (strlen($phone) != 10 || !is_numeric($phone)) {
            $error = "Số điện thoại phải là 10 số";
        } else if (strlen($password) < 8) {
            $error = "Mật khẩu phải ít nhất 8 ký tự";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, phone, dob, password, full_name) VALUES (?, ?, ?, ?, ?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ssssss", $username, $email, $phone, $dob, $password, $full_name);
                $stmt->execute();
                $stmt->close();
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            header("Location: login.php");
        }
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
    .form {
        padding: 20px 50px !important;
    }
</style>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="form bg-white p-3 rounded shadow" style="width: 700px;">
        <div class="text-center mb-2">
            <a href="index.php"><img src="assets/img/logo.png" alt="logo" class="img-fluid" style="width: 100px;"></a>
        </div>
        <h2 class="text-center text-uppercase mb-2">Đăng ký</h2>
        <?php if (!empty($error)) { ?>
            <p class="text-danger text-center"><?php echo $error; ?></p>
        <?php } ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="row g-3">
            <div class="col-md-6">
                <label for="full_name" class="form-label">Họ tên</label>
                <input type="text" name="full_name" id="full_name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="username" class="form-label">Tên đăng nhập</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="dob" class="form-label">Ngày sinh</label>
                <input type="date" name="dob" id="dob" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
            </div>
        </form>
        <p class="mt-2 text-center">
            <a href="login.php" class="text-primary">Đã có tài khoản? Đăng nhập</a>
        </p>
    </div>
</div>
<?php include 'layout\footer.php'; ?>


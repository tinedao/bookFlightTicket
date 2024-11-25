<?php
session_start();
include '../config/connect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT passwordAd, userAd FROM admin WHERE userAd = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($hashedPassword, $username);
    $stmt->fetch();

    if ($hashedPassword && password_verify($password, $hashedPassword)) {
        $_SESSION['email'] = $email;
        $_SESSION['userAd'] = $username;
        header("Location: home.php");
    } else {
        $error = "Email hoặc mật khẩu không đúng";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <style>
            * {
                box-sizing: border-box;
            }
            body {
                font-family: sans-serif;
            }
            .container {
                width: 500px;
                margin: 50px auto;
            }
            .form-group {
                margin-bottom: 15px;
            }
            label {
                display: block;
                margin-bottom: 5px;
            }
            input[type="text"],
            input[type="password"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            button {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            button:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2 class="text-center">Đăng nhập</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" name="submit">Đăng nhập</button>
                <?php if (isset($error)): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </form>
        </div>
    </body>
</html>


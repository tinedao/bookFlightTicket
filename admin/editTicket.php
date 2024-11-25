<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
include 'layout/header.php';
include '../config/connect.php';

// Lấy thông tin hãng hàng không hiện tại
$airline_id = $_GET['id'];
$query = "SELECT * FROM airlines WHERE airline_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $airline_id);
$stmt->execute();
$result = $stmt->get_result();
$airline = $result->fetch_assoc();
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Chỉnh sửa hãng hàng không</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Chỉnh sửa hãng hàng không</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Chỉnh sửa hãng hàng không</h3>
                    </div>
                    <div class="card-body">
                        <form action="editA.php" method="post">
                            <input type="hidden" name="airline_id" value="<?php echo $airline['airline_id']; ?>">

                            <div class="form-group">
                                <label for="airline_name">Tên hãng</label>
                                <input type="text" class="form-control" id="airline_name" name="airline_name" value="<?php echo $airline['airline_name']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="airline_code">Mã hãng</label>
                                <input type="text" class="form-control" id="airline_code" name="airline_code" value="<?php echo $airline['airline_code']; ?>" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <a href="airlines.php" class="btn btn-secondary">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'layout/footer.php'; ?>

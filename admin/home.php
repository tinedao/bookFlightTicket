<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
$username = isset($_SESSION['userAd']) ? $_SESSION['userAd'] : 'Guest';
include 'layout/header.php';
include '../config/connect.php';

// Đếm số tài khoản
$sql_accounts = "SELECT COUNT(*) AS total_accounts FROM users";
$result_accounts = mysqli_query($conn, $sql_accounts);
$total_accounts = mysqli_fetch_assoc($result_accounts)['total_accounts'];

// Đếm số hãng bay
$sql_airlines = "SELECT COUNT(*) AS total_airlines FROM airlines";
$result_airlines = mysqli_query($conn, $sql_airlines);
$total_airlines = mysqli_fetch_assoc($result_airlines)['total_airlines'];

// Đếm số vé máy bay
$sql_tickets = "SELECT COUNT(*) AS total_tickets FROM tickets";
$result_tickets = mysqli_query($conn, $sql_tickets);
$total_tickets = mysqli_fetch_assoc($result_tickets)['total_tickets'];
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $total_accounts; ?></h3>
                        <p>Total Accounts</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="account.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo $total_airlines; ?></h3>
                        <p>Total Airlines</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-plane"></i>
                    </div>
                    <a href="airlineBrand.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo $total_tickets; ?></h3>
                        <p>Total Tickets</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pricetag"></i>
                    </div>
                    <a href="product.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'layout/footer.php'; ?>


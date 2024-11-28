<?php
include 'config/connect.php';
include 'layout/header.php';
include 'layout/navbar.php';

$location_type = 2;

if (isset($_GET['filter'])) {
    $location_type = $_GET['filter'];
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = '';
}

$whereClauses = [];
$params = [];
$types = '';

$whereClauses[] = "(destination_type_ticket = ? OR destination_type_ticket = ?)";
$params[] = $location_type;
$params[] = $location_type;
$types .= 'ii';

$applyDateFilter = false; // Biến kiểm tra xem có áp dụng lọc ngày tháng không

if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];

    if (!empty($from_date) && !empty($to_date)) {
        $applyDateFilter = true; // Áp dụng lọc ngày tháng nếu có giá trị
        $whereClauses[] = "departure_time BETWEEN ? AND ?";
        $params[] = $from_date;
        $params[] = $to_date;
        $types .= 'ss';
    }
}

$sql = "SELECT ticket_view.ticket_id, departure, destination, remaining, airlines.airline_code, airlines.airline_name, airlines.img as airline_img, departure_time, price, discount, 
            CASE 
                WHEN cart.ticket_id IS NOT NULL THEN 'In Cart'
                ELSE 'Available'
            END AS ticket_status
        FROM ticket_view 
        JOIN airlines ON ticket_view.airline_code = airlines.airline_code 
        LEFT JOIN cart ON ticket_view.ticket_id = cart.ticket_id AND cart.username = ? 
        WHERE " . implode(' AND ', $whereClauses) . " LIMIT 10";

$params = array_merge([$username], $params);
$types = 's' . $types;

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare error: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

if ($applyDateFilter && $result->num_rows == 0) {
    $whereClauses = ["(destination_type_ticket = ? OR destination_type_ticket = ?)"];
    $params = [$location_type, $location_type, $username];
    $types = 'iis';

    $sql = "SELECT ticket_view.ticket_id, departure, destination, remaining, airlines.airline_code, airlines.airline_name, airlines.img as airline_img, departure_time, price, discount, 
                CASE 
                    WHEN cart.ticket_id IS NOT NULL THEN 'In Cart'
                    ELSE 'Available'
                END AS ticket_status
            FROM ticket_view 
            JOIN airlines ON ticket_view.airline_code = airlines.airline_code 
            LEFT JOIN cart ON ticket_view.ticket_id = cart.ticket_id AND cart.username = ? 
            WHERE " . implode(' AND ', $whereClauses) . " LIMIT 10";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>
<style>
.card-title {
    margin: 10px 0;
}

.bgPages {
    background-image: url('assets/img/pexels-stefanstefancik-91217.jpg');
}

.contentPages {
    color: white;
}

.contentPagesr {
    padding-top: 20px;
    padding-bottom: 20px;
}

.btn {
    width: 49%;
    padding: 10px 0;
}

form {
    width: 30%;
}

.img-fluid {
    max-width: none;
}

table {
    border-radius: 5px;
    overflow: hidden;
}

.card-header {
    background-color: #343a40;
    color: white;
}

th,
td {
    text-align: center;
}

.imgLogo {
    overflow: hidden;
    width: 110px;
    height: 100px !important;
    padding: 0 !important;
}

td {
    vertical-align: middle !important;
}

.active {
    background-color: greenyellow !important;
    color: black !important;
}

.formOrder {
    width: 100%;
}
</style>

<div class="addressFolder">
    <h1>Products</h1>
</div>
<div class="bgPages"></div>
<div class="contentPagesr">
    <section class="content">
        <div class="container-fluid w-75">
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark wh">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">List of flight tickets</h3>
                            <form action="?filter=<?php echo $location_type; ?>" method="get" class="ml-3">
                                <button name="filter" value="2" class="btn btn-secondary <?php if($location_type == 2) echo 'active'; ?>">International</button>
                                <button name="filter" value="1" class="btn btn-secondary <?php if($location_type == 1) echo 'active'; ?>">Domestic</button>
                            </form>
                        </div>
                        <div class="w-100 p-3">
                        <form class=" w-100 " action="?filter=<?php echo $location_type; ?>" method="get">
                                <div class="d-flex">
                                <div class="form-group w-50">
                                    <label for="from_date">From Date:</label>
                                    <input type="date" name="from_date" id="from_date" class="form-control">
                                </div>
                                <div class="form-group w-50">
                                    <label for="to_date">To Date:</label>
                                    <input type="date" name="to_date" id="to_date" class="form-control">
                                </div>
                                </div>
                                <button type="submit" class=" w-25 mt-2 btn btn-primary">Search</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="col">Departure</th>
                                        <th class="col">Destination</th>
                                        <th class="col">Airline Name</th>
                                        <th class="col">Departure Time</th>
                                        <th class="col">Price</th>
                                        <th class="col">Discount</th>
                                        <th class="col">Brand</th>
                                        <th class="col-1">Remaining</th>
                                        <th class="col-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['departure']; ?></td>
                                        <td><?php echo $row['destination']; ?></td>
                                        <td><?php echo $row['airline_name']; ?></td>
                                        <td><?php echo $row['departure_time']; ?></td>
                                        <td style="color: red; font-weight: bold"><?php
                                            if ($row['discount'] != 0) {
                                                echo '<s style="color: black !important; font-weight: lighter !important">$' . number_format($row['price']) . '</s><br>';
                                            }
                                            ?>$<?php echo number_format($row['price'] * (1 - $row['discount'])); ?>
                                        </td>
                                        <td><?php echo $row['discount'] * 100; ?>%</td>
                                        <td class="imgLogo">
                                            <img src="assets/img/<?php echo $row['airline_img']; ?>" class="img-fluid" width="100" height="100">
                                        </td>
                                        <td><?php echo $row['remaining']; ?></td>
                                        <td>
                                            <?php 
                                            if(isset($_SESSION['username'])) {
                                                if ($row['ticket_status'] == 'In Cart') {
                                                    echo '<a href="cart.php" class="btn btn-secondary w-100">Vào giỏ hàng</a>';
                                                } else {
                                                    echo '<a href="detailPro.php?ticket_id=' . $row['ticket_id'] .'" class="btn btn-success w-100">Đặt vé</a>';
                                                }
                                            }else{
                                                echo '<a href="login.php" class="btn btn-success w-100">Đặt vé</a>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'layout/footer.php'; ?>

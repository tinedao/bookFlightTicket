<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
include 'layout/header.php';
include '../config/connect.php';

// Số lượng vé hiển thị trên mỗi trang
$limit = 10;

// Lấy số trang hiện tại từ URL (nếu không có thì đặt là 1)
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Lấy tổng số vé
$sql = "SELECT COUNT(*) AS total_tickets FROM tickets";
$result = mysqli_query($conn, $sql);
$total_tickets = mysqli_fetch_assoc($result)['total_tickets'];
$total_pages = ceil($total_tickets / $limit);

// Lấy vé cho trang hiện tại cùng với tên địa điểm bay và tính toán giảm giá
$sql = "SELECT t.ticket_id, l1.location_name AS departure_name, l2.location_name AS destination_name, t.airline_code, t.departure_time, t.price, (t.discount * 100) AS discount_percent, t.remaining
        FROM tickets t
        JOIN locations l1 ON t.departure = l1.location_id
        JOIN locations l2 ON t.destination = l2.location_id
        LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Danh sách vé</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Danh sách vé</li>
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
                        <h3 class="card-title">Danh sách vé</h3>
                        <a href="addTicket.php" class="btn btn-primary float-right">Thêm vé</a>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Ticket ID</th>
                                    <th>Departure</th>
                                    <th>Destination</th>
                                    <th>Airline Code</th>
                                    <th>Departure Time</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Remaining</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['ticket_id'] . "</td>";
                                            echo "<td>" . $row['departure_name'] . "</td>";
                                            echo "<td>" . $row['destination_name'] . "</td>";
                                            echo "<td>" . $row['airline_code'] . "</td>";
                                            echo "<td>" . $row['departure_time'] . "</td>";
                                            echo "<td>$" . number_format($row['price']) . "</td>";
                                            echo "<td>" . number_format($row['discount_percent']) . "%</td>";
                                            echo "<td>" . $row['remaining'] . "</td>";
                                            echo "<td>
                                                    <a href='editTicket.php?ticket_id=" . $row['ticket_id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                                    <a href='action/deleteTicket.php?ticket_id=" . $row['ticket_id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                                                </td>";
                                            echo "</tr>";
                                        }
                                    }
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                                ?>
                            </tbody>
                        </table>

                        <!-- Phân trang -->
                         <br>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <?php if ($page > 1): ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page-1; ?>">Previous</a></li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php endfor; ?>

                                <?php if ($page < $total_pages): ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page+1; ?>">Next</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'layout/footer.php'; ?>

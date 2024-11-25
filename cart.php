<?php
include 'config/connect.php';
include 'layout/header.php';
include 'layout/navbar.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
$username = $_SESSION['username'];

$sql = "SELECT ticket_cart_view.ticket_id, departure, destination, airlines.airline_name, airlines.img as airline_img, departure_time, price, discount, quantity, paid, total_price 
        FROM ticket_cart_view 
        JOIN airlines ON ticket_cart_view.airline_code = airlines.airline_code 
        WHERE username = ?"; 
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $username); 
$stmt->execute(); 
$result = $stmt->get_result();
?>
<style>
.bgPages {
    background-image: url('assets/img/contact.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    font-weight: bold;
}

.cart-container {
    margin-top: 20px;
}

.cart-table {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.table th, .table td {
    vertical-align: middle;
    text-align: center;
}

.table img {
    width: 50px;
    height: 50px;
    object-fit: contain;
}
</style>'
<div class="addressFolder">
    <h1>Carts</h1>
</div>
<div class="bgPages">
</div>

<div class="cart-container w-75 mx-auto">
    <table class="table table-bordered cart-table">
        <thead class="table-dark">
            <tr>
                <th scope="col">Departure</th>
                <th scope="col">Destination</th>
                <th scope="col">Airline</th>
                <th scope="col">Departure Time</th>
                <th scope="col">Price</th>
                <th scope="col">Discount</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) { ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['departure']; ?></td>
                    <td><?php echo $row['destination']; ?></td>
                    <td>
                        <img src="assets/img/<?php echo $row['airline_img']; ?>" alt="<?php echo $row['airline_name']; ?>">
                        <div><?php echo $row['airline_name']; ?></div>
                    </td>
                    <td><?php echo $row['departure_time']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td style="color: red; font-weight: bold"><?php echo $row['discount'] * 100; ?>%</td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['total_price']; ?></td>
                    <td>
                        <?php if (!$row['paid']) { ?>
                            <form action="config/handlePayment.php" method="post">
                                <input type="hidden" name="ticket_id" value="<?php echo $row['ticket_id']; ?>">
                                <input type="hidden" name="total_price" value="<?php echo $row['total_price']; ?>">
                                <button type="submit" class="btn btn-success">Thanh toán</button>
                            </form>
                        <?php } else { ?>
                            <form action="config/handleRefund.php" method="post">
                                <input type="hidden" name="ticket_id" value="<?php echo $row['ticket_id']; ?>">
                                <input type="hidden" name="total_price" value="<?php echo $row['total_price']; ?>">
                                <button type="submit" class="btn btn-warning">Hoàn tiền</button>
                            </form>
                            <form action="config/handleCancel.php" method="post" class="mt-2">
                                <input type="hidden" name="ticket_id" value="<?php echo $row['ticket_id']; ?>">
                                <input type="hidden" name="total_price" value="<?php echo $row['total_price']; ?>">
                                <button type="submit" class="btn btn-danger">Hủy đơn</button>
                            </form>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            <?php }else{ echo "<tr><td colspan='9' class='text-center text-muted'>Không có dữ liệu</td></tr>";} ?>
        </tbody>
    </table>
</div>

<?php include 'layout/footer.php'; ?>

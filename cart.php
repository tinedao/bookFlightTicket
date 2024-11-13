<?php

include 'config/connect.php';
    include 'layout/header.php';
    include 'layout/navbar.php';
    $sql = "SELECT ticket_id, departure, destination, airline_code, airline_name, departure_time, price, discount, quantity, paid, total_price FROM ticket_cart_view WHERE username = ? AND paid = 0"; 
    $stmt = $conn->prepare($sql); $stmt->bind_param("s", $username); 
    $stmt->execute(); $result = $stmt->get_result();
?>
<style>
    .bgPages{
        background-image: url('assets/img/contact.jpg');
    }
</style>
<div class="bgPages"></div>


    <div class="w-75 mx-auto">
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">Ticket ID</th>
                <th scope="col">Departure</th>
                <th scope="col">Destination</th>
                <th scope="col">Airline Code</th>
                <th scope="col">Airline Name</th>
                <th scope="col">Departure Time</th>
                <th scope="col">Price</th>
                <th scope="col">Discount</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
                <th scope="col">Paid</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['ticket_id']; ?></td>
                    <td><?php echo $row['departure']; ?></td>
                    <td><?php echo $row['destination']; ?></td>
                    <td><?php echo $row['airline_code']; ?></td>
                    <td><?php echo $row['airline_name']; ?></td>
                    <td><?php echo $row['departure_time']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['discount'] * 100; ?>%</td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['total_price']; ?></td>
                    <td><?php echo $row['paid'] ? 'Yes' : 'No'; ?></td>
                    <td>
                        <?php if (!$row['paid']) { ?>
                            <form action="handlePayment.php" method="post">
                                <input type="hidden" name="ticket_id" value="<?php echo $row['ticket_id']; ?>">
                                <input type="hidden" name="total_price" value="<?php echo $row['total_price']; ?>">
                                <button type="submit" class="btn btn-success">Thanh toán</button>
                            </form>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    <?php include 'layout/footer.php'; ?>


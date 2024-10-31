<?php 
    include 'layout/header.php';
    include 'layout/navbar.php';
    include 'config/connect.php';

    $sql = "CREATE OR REPLACE VIEW ticket_view AS
    SELECT 
        t.ticket_id,
        l1.location_name AS departure,
        l2.location_name AS destination,
        t.airline_code,
        a.airline_name,
        t.departure_time,
        t.price,
        t.discount,
        l1.type_ticket AS departure_type_ticket,
        l2.type_ticket AS destination_type_ticket
    FROM 
        tickets t
    JOIN 
        locations l1 ON t.departure = l1.location_id
    JOIN 
        locations l2 ON t.destination = l2.location_id
    JOIN 
        airlines a ON t.airline_code = a.airline_code";

    if ($conn->query($sql) === TRUE) {
        echo "View created successfully";
    } else {
        echo "Error creating view: " . $conn->error;
    }

$location_type = 1;

if(isset($_POST['filter'])) {
    $location_type = $_POST['filter'];
}

$sql = "SELECT ticket_id, departure, destination, airline_code, airline_name, departure_time,  price, discount 
        FROM ticket_view 
        WHERE destination_type_ticket = ? OR destination_type_ticket = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $location_type, $location_type);
$stmt->execute();
$result = $stmt->get_result();
?>
<style>
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
}

.img-fluid {
    max-width: none;
}

table {
    border-radius: 5px;
    overflow: hidden;
}
</style>

<div class="addressFolder">
    <h1>Products</h1>
</div>
<div class="bgPages"></div>
<div class="contentPagesr">
    <div class="container">
    <form method="post" action="" class="d-flex justify-content-between">
        <button name="filter" value="2" class="btn btn-secondary">Quốc tế </button>
        <button name="filter" value="1" class="btn btn-secondary">Trong nước</button>
    </form>
    </div>
    <div class="container">
        <table class="table bg-light table-striped mt-3">
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Departure</th>
                    <th>Destination</th>
                    <th>Airline Code</th>
                    <th>Airline Name</th>
                    <th>Departure Time</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Logo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { 
                    $airline_code = $row['airline_code'];
                    if($airline_code == 'VNA') {
                        $logo = 'logoVNA.png';
                    } else if($airline_code == 'BBA') {
                        $logo = 'bamboo.jpg';
                    } else if($airline_code == 'VJA') {
                        $logo = 'logoVJ.png';
                    } else if($airline_code == 'JPA') {
                        $logo = 'logoStar.png';
                    }
                    ?>
                <tr>
                    <td><?php echo $row['ticket_id']; ?></td>
                    <td><?php echo $row['departure']; ?></td>
                    <td><?php echo $row['destination']; ?></td>
                    <td><?php echo $row['airline_code']; ?></td>
                    <td><?php echo $row['airline_name']; ?></td>
                    <td><?php echo $row['departure_time']; ?></td>
                    <td>$<?php echo $row['price']; ?></td>
                    <td><?php echo $row['discount'] * 100; ?>%</td>
                    <td><img src="assets/img/<?php echo $logo; ?>" class="img-fluid" width="50" height="50"></td>
                    <td><button class="btn btn-success w-100">Đặt vé</button></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'layout/footer.php'; ?>



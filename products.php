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
.card-header{
    background-color: #343a40;
    color: white;
}
th,td{
    text-align: center; /* Căn giữa theo chiều dọc */

}
</style>

<div class="addressFolder">
    <h1>Products</h1>
</div>
<div class="bgPages"></div>
<div class="contentPagesr">
    <div class="container">
    <form method="post" action="" class="d-flex justify-content-between">
        <button name="filter" value="2" class="btn btn-secondary">International</button>
        <button name="filter" value="1" class="btn btn-secondary">Domestic</button>
    </form>
    </div>
<section class="content">
    <div class="container-fluid w-75">
        <div class="row">
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">List of flight tickets</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col">Departure</th>
                                    <th class="col">Destination</th>
                                    <th class="col">Airline Code</th>
                                    <th class="col">Airline Name</th>
                                    <th class="col">Departure Time</th>
                                    <th class="col">Price</th>
                                    <th class="col">Discount</th>
                                    <th class="col">Logo</th>
                                    <th class="col">Action</th>
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
                                    <td><?php echo $row['departure']; ?></td>
                                    <td><?php echo $row['destination']; ?></td>
                                    <td><?php echo $row['airline_code']; ?></td>
                                    <td><?php echo $row['airline_name']; ?></td>
                                    <td><?php echo $row['departure_time']; ?></td>
                                    <td>$<s><?php echo $row['price']; ?></s><br>$<?php echo $row['price'] * (1 - $row['discount']); ?></td>
                                    <td><?php echo $row['discount'] * 100; ?>%</td>
                                    <td><img src="assets/img/<?php echo $logo; ?>" class="img-fluid" width="50" height="50"></td>
                                    <td><button class="btn btn-success w-100">Đặt vé</button></td>
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



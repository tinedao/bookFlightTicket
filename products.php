<?php 
    include 'layout/header.php';
    include 'layout/navbar.php';
    include 'config/connect.php';

$location_type = 1;

if(isset($_GET['filter'])) {
    $location_type = $_GET['filter'];
}

$sql = "SELECT ticket_id, departure, destination, remaining, airline_code, airline_name, departure_time,  price, discount 
        FROM ticket_view 
        WHERE destination_type_ticket = ? OR destination_type_ticket = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $location_type, $location_type);
$stmt->execute();
$result = $stmt->get_result();
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
    <div class="container">

    </div>
    <section class="content">
        <div class="container-fluid w-75">
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">List of flight tickets</h3>
                            <form action="?filter=<?php echo $location_type; ?>" method="get">
                                <button name="filter" value="2"
                                    class="btn btn-secondary <?php if($location_type == 2) echo 'active'; ?>">International</button>
                                <button name="filter" value="1"
                                    class="btn btn-secondary <?php if($location_type == 1) echo 'active'; ?>">Domestic</button>
                            </form>
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
                                        <th class="col">Brand</th>
                                        <th class="col-1">Remaining</th>
                                        <th class="col-1">Action</th>
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
                                        <td style="color: red; font-weight: bold"><?php
                                        if($row['discount'] != 0) {
                                            echo '<s style="color: black !important; font-weight: lighter; !important">$'.number_format($row['price']) .'</s><br>';
                                        }
                                    ?>$<?php echo number_format($row['price'] * (1 - $row['discount'])); ?></td>
                                        <td><?php echo $row['discount'] * 100; ?>%</td>
                                        <td class="imgLogo"><img src="assets/img/<?php echo $logo; ?>" class="img-fluid"
                                                width="100" height="100"></td>
                                        <td><?php echo $row['remaining']; ?></td>
                                        <td>
                                            <form class="formOrder" action="action/handleOrder.php" method="post">
                                                <input type="hidden" name="ticket_id"
                                                    value="<?php echo $row['ticket_id']; ?>">
                                                <button type="submit" class="btn btn-success w-100">Đặt vé</button>
                                            </form>
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
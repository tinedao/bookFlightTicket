<?php 
include 'layout/header.php';
include 'layout/navbar.php';
include 'config/connect.php';

if(isset($_GET['ticket_id'])) {
    $ticket_id = $_GET['ticket_id'];

    $sql = "SELECT ticket_id, departure, destination, remaining, airline_code, airline_name, departure_time, price, discount 
            FROM ticket_view 
            WHERE ticket_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ticket = $result->fetch_assoc();
} else {
    echo "Ticket ID is missing.";
    exit();
}
?>
<style>
.bgPages {
    background-image: url('assets/img/pexels-stefanstefancik-91217.jpg');
}

.ticket-detail {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.ticket-detail img {
    max-width: 100%;
    border-radius: 10px;
}

.ticket-info h3 {
    font-size: 1.75rem;
    margin-bottom: 20px;
}

.ticket-info p {
    font-size: 1rem;
    margin-bottom: 10px;
}
</style>
<div class="bgPages ">
    
</div>
<div class="container py-5">
        <div class="ticket-detail row">
            <div class="col-md-6">
                <img src="assets/img/<?php echo $ticket['airline_code'] == 'VNA' ? 'logoVNA.png' : ($ticket['airline_code'] == 'BBA' ? 'bamboo.jpg' : ($ticket['airline_code'] == 'VJA' ? 'logoVJ.png' : 'logoStar.png')); ?>" alt="Airline Logo">
            </div>
            <div class="col-md-6 ticket-info">
                <h3><?php echo $ticket['airline_name']; ?></h3>
                <p><strong>Departure:</strong> <?php echo $ticket['departure']; ?></p>
                <p><strong>Destination:</strong> <?php echo $ticket['destination']; ?></p>
                <p><strong>Departure Time:</strong> <?php echo $ticket['departure_time']; ?></p>
                <p><strong>Price:</strong> <span style="color: red; font-weight: bold"><?php
                if($ticket['discount'] != 0) {
                    echo '<s style="color: black !important; font-weight: lighter !important">$'.number_format($ticket['price']) .'</s> ';
                }
                echo '$'.number_format($ticket['price'] * (1 - $ticket['discount'])); ?></span></p>
                <p><strong>Discount:</strong> <?php echo $ticket['discount'] * 100; ?>%</p>
                <p><strong>Remaining:</strong> <?php echo $ticket['remaining']; ?></p>
                <form action="config/handleOrder.php" method="post">
                    <input type="hidden" name="ticket_id" value="<?php echo $ticket['ticket_id']; ?>">
                    <div class="mb-3">
                        <label for="quantity" class="form-label"><strong>Quantity:</strong></label>
                        <input type="number" class="form-control" name="quantity" id="quantity" value="1" min="1" max="<?php echo $ticket['remaining']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
<?php include 'layout/footer.php'; ?>

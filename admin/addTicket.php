<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
include 'layout/header.php';
include '../config/connect.php';

// Lấy danh sách các địa điểm bay từ cơ sở dữ liệu
$sql_locations = "SELECT location_id, location_name FROM locations";
$result_locations = mysqli_query($conn, $sql_locations);

// Lấy danh sách các hãng bay từ cơ sở dữ liệu
$sql_airlines = "SELECT airline_code, airline_name FROM airlines";
$result_airlines = mysqli_query($conn, $sql_airlines);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $departure = $_POST['departure'];
    $destination = $_POST['destination'];
    $airline_code = $_POST['airline_code'];
    $departure_time = $_POST['departure_time'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $remaining = $_POST['remaining'];

    $sql = "INSERT INTO tickets (departure, destination, airline_code, departure_time, price, discount, remaining) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissdii", $departure, $destination, $airline_code, $departure_time, $price, $discount, $remaining);

    if ($stmt->execute()) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Thêm vé mới</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="departure">Departure:</label>
            <select class="form-control" id="departure" name="departure" required>
                <option value="" disabled selected>Chọn địa điểm khởi hành</option>
                <?php while ($row = mysqli_fetch_assoc($result_locations)): ?>
                    <option value="<?php echo $row['location_id']; ?>"><?php echo $row['location_name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="destination">Destination:</label>
            <select class="form-control" id="destination" name="destination" required>
                <option value="" disabled selected>Chọn địa điểm đến</option>
                <?php mysqli_data_seek($result_locations, 0); // Reset result pointer ?>
                <?php while ($row = mysqli_fetch_assoc($result_locations)): ?>
                    <option value="<?php echo $row['location_id']; ?>"><?php echo $row['location_name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="airline_code">Airline Code:</label>
            <select class="form-control" id="airline_code" name="airline_code" required>
                <option value="" disabled selected>Chọn hãng bay</option>
                <?php while ($row = mysqli_fetch_assoc($result_airlines)): ?>
                    <option value="<?php echo $row['airline_code']; ?>"><?php echo $row['airline_name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="departure_time">Departure Time:</label>
            <input type="datetime-local" class="form-control" id="departure_time" name="departure_time" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="discount">Discount:</label>
            <input type="number" class="form-control" id="discount" name="discount" placeholder="Discount %" value="0" step="1" required>
        </div>
        <div class="form-group">
            <label for="remaining">Remaining:</label>
            <input type="number" class="form-control" id="remaining" name="remaining" value="1" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Ticket</button>
    </form>
</div>

<?php include 'layout/footer.php'; ?>

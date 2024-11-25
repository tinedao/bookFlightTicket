<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
include 'layout/header.php';
include '../config/connect.php';

$airline_id = isset($_GET['id']) ? $_GET['id'] : '';
$airline_name = '';
$airline_code = '';

if ($airline_id) {
    $query = "SELECT * FROM airlines WHERE airline_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $airline_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $airline_name = $row['airline_name'];
        $airline_code = $row['airline_code'];
    }
}

?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo $airline_id ? 'Edit Airline' : 'Add Airline'; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $airline_id ? 'Edit Airline' : 'Add Airline'; ?></li>
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
                        <h3 class="card-title"><?php echo $airline_id ? 'Edit Airline' : 'Add Airline'; ?></h3>
                    </div>
                    <div class="card-body">
                        <form action="action/save-airline.php" method="post">
                            <input type="hidden" name="airline_id" value="<?php echo $airline_id; ?>">

                            <div class="form-group">
                                <label for="airline_name">Brand Name</label>
                                <input type="text" class="form-control" id="airline_name" name="airline_name" value="<?php echo $airline_name; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="airline_code">Brand Code</label>
                                <input type="text" class="form-control" id="airline_code" name="airline_code" value="<?php echo $airline_code; ?>" required>
                            </div>

                            <button type="submit" class="btn btn-primary"><?php echo $airline_id ? 'Update' : 'Add'; ?></button>
                            <a href="airlines.php" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'layout/footer.php'; ?>

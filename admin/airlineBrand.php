<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
include 'layout/header.php';
include '../config/connect.php';

$query = "SELECT * FROM airlines";
$result = mysqli_query($conn, $query);
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Airlines List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Airlines List</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table table-striped table-bordered'>";
        echo "<tr><th>ID</th><th>Brand Name</th><th>Brand Code</th><th>Actions</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["airline_id"] . "</td>";
            echo "<td>" . $row["airline_name"] . "</td>";
            echo "<td>" . $row["airline_code"] . "</td>";
            echo "<td><a href='editA.php?id=" . $row["airline_id"] . "' class='btn btn-info btn-sm'>Edit</a> <a href='action/delete-airline.php?id=" . $row["airline_id"] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<a href='addA.php' class='btn btn-primary'>Add</a>";
    } else {
        echo "0 results";
    }
    ?>
</div>

<?php
mysqli_close($conn);
?>
<?php include 'layout/footer.php'; ?>


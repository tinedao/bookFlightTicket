<?php
    $addressFolder = "Contact Us";
    include 'layout/header.php';
    include 'config/connect.php';
    include 'layout/navbar.php';
    include 'layout/addressFolder.php';
?>
<style>
    .bgContact{
        background-image: url('assets/img/contact.jpg');
        background-repeat: inherit;
        background-size: cover;
        background-position: center;
        position: fixed;
        height: 100vh;
        width: 100%;
        top: 96.61px;
        filter: brightness(30%);
        text-align: center;
        z-index: -1;
    }
</style>
<div class="bgContact"></div>
<div class="container mt-5 w-50" style="margin:0 auto">
    <div class="mt-5 row ml-2 w-100 justify-content-center align-items-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Contact US</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhoneNumber1">Phone Number</label>
                            <input type="text" class="form-control" id="exampleInputPhoneNumber1" name="phonenumber" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputMessage">Message</label>
                            <textarea class="form-control" id="exampleInputMessage" rows="3" name="message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $phonenumber = $_POST["phonenumber"];
        $message = $_POST["message"];
        $sql = "INSERT INTO contactus (email, phonenumber, message) VALUES ('$email', '$phonenumber', '$message')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Your message has been sent successfully!');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    include 'layout/footer.php';
?>


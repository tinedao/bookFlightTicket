<style>
body {
    <?php if( !isset($home)) {
        echo '
margin-top: 133.55px;
        ';

    }

    ?>
}

.infoUser {
    width: 30%;
}

.wallet {
    font-size: 16px;
}

.navbar {
    z-index: 1;
    position: fixed;
    background: none;
    width: 100%;
    transition: background-color 0.5s ease;

    <?php if( !isset($home)) {
        echo '
background-color: #D4BDAC;
        top: 0;
        ';

    }

    ?>
}
i{
    font-family: "Font Awesome 6 Free" !important;
    padding-right: 5px;
}
.navbar.scrolled {
    background-color: #D4BDAC;
}

.inforUser .btn {
    transition: background-color 0.3s;
    display: inline-flex;
    align-items: center;

}

.logout:hover {
    background-color: red;
    color: white;
    text-decoration: none;
}

.loginBtn {
    box-sizing: content-box !important;
}
.dropdown-item{
    padding: 0.5rem 2rem;
}
.dropdown-item:hover {
    background-color: gray  !important;
    color: white !important;
    transition: all 0.3s ease;
}
</style>
<div class="navbar" id="navbar">
    <div class="container">
        <div class="logo">
            <a href="index.php"><img src="assets\img\logo.png" alt="logo"></a>
        </div>
        <nav>
            <ul id="MenuItems" class="menu-items">
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>

        <div class="infoUser d-flex justify-content-end align-items-center">
            <?php 
               session_start();
               
               if (isset($_SESSION['username'])): ?>
            <div class="ifUser me-3">
                <?php
                include 'config/connect.php';
                $stmt = $conn->prepare("SELECT wallet,full_name FROM users WHERE username = ?");
                $stmt->bind_param('s', $_SESSION['username']);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                ?>
                <div class="dropdown" style="z-index: 2;">
                    <p class="mb-0 text-white dropdown-toggle" id="dropdownMenuButton" style="cursor: pointer;">
                        <?php echo $row['full_name']; ?>
                    </p>
                    <ul class="dropdown-menu text-small" id="dropdownMenu">
                        <li><a class="dropdown-item" href="recharge.php"><i class="fas fa-credit-card"></i> Nạp tiền</a></li>
                        <li><a class="dropdown-item" href="cart.php"><i class="fas fa-ticket-alt"></i> Vé đã mua</a></li>
                        <li><a class="dropdown-item" href="user.php"><i class="fas fa-user-edit"></i> Sửa thông tin</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="action/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
                
                <p class=" wallet mb-0 text-white">Wallet: <?php echo number_format($row['wallet']) . ' $'; ?> </p>
            </div>

            <?php else: ?>
            <a href="login.php" class="btn loginBtn btn-outline-light px-4">Login</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
                    const dropdownToggle = document.querySelector('.dropdown-toggle');
                    const dropdownMenu = document.querySelector('.dropdown-menu');

                    dropdownToggle.addEventListener('click', function() {
                        dropdownMenu.classList.toggle('show');
                    });

                    window.addEventListener('click', function(e) {
                        if (!dropdownMenu.contains(e.target) &&
                            !e.target.matches('.dropdown-toggle')) {
                            dropdownMenu.classList.remove('show');
                        }
                    });
                </script>
<?php
    if(isset($home)){
        echo "
        <script>
            window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 0) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        </script>";
    };

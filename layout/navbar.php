<style>
body {
    <?php if( !isset($home)) {
        echo '
margin-top: 96.55px;
        ';

    }

    ?>
}

.infoUser {
    width: 25%;
}

.wallet {
    font-size: 16px;
}

.navbar {

    z-index: 100;
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
    width: 25% !important;
}

.dropdown-item {
    padding: 10px 30px;
}

.dropdown-item:hover {
    background-color: gray !important;
    color: white !important;
    transition: all 0.3s ease;
}

.logo {
    width: 20%;
}

nav {
    width: 55%;
}

#scrollTopBtn {
    display: none;
    position: fixed;
    bottom: 100px;
    right: 30px;
    z-index: 99;
    border: none;
    outline: none;
    background-color: #FFA500; /* Bright orange color */
    color: white;
    cursor: pointer;
    padding: 10px;
    border-radius: 50%;
    box-shadow: 0 0 10px rgba(255, 255, 0, 0.5); /* Yellow glow */
    height: 50px;
    width: 50px;
}

#scrollTopBtn:hover {
    background-color: #FFD700; /* Gold color on hover */
}
</style>
<button id="scrollTopBtn" class="btn btn-primary">
    <i class="fas fa-arrow-up"></i> <!-- Font Awesome up arrow -->
</button>
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
                <li><a href="discussion.php">Discussion</a></li>
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
                        <li><a class="dropdown-item" href="recharge.php"><i class="fas fa-credit-card"></i> Recharge</a>
                        </li>
                        <li><a class="dropdown-item" href="cart.php"><i class="fas fa-ticket-alt"></i> Cart</a></li>
                        <li><a class="dropdown-item" href="user.php"><i class="fas fa-user-edit"></i>Information</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="action/logout.php"><i
                                    class="fas fa-sign-out-alt"></i> Logout</a></li>
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
window.onscroll = function() {
    scrollFunction();
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("scrollTopBtn").style.display = "block";
    } else {
        document.getElementById("scrollTopBtn").style.display = "none";
    }
}

document.getElementById('scrollTopBtn').addEventListener('click', function() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
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
<style>
.navbar {
    z-index: 1;
    position: fixed;
    background: none;
    overflow: hidden;
    width: 100%;
    transition: background-color 0.5s ease;
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
                <p class="mb-0 text-white"><?php echo htmlspecialchars($_SESSION['full_name']); ?></p>
            </div>
            <a href="action/logout.php" class="logout btn btn-outline-light px-4">
                <i class="bi bi-box-arrow-right" style="margin-right: 5px;"></i>Logout
            </a>
            <?php else: ?>
            <a href="login.php" class="btn btn-outline-light px-4">Login</a>
            <?php endif; ?>

        </div>
    </div>
</div>
<script>
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 0) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});
</script>
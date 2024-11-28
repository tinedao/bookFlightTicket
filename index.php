<?php 
$home = 1;
include 'layout/header.php';
include 'layout/navbar.php'; 

?>






<style>
body {
    background-image: url('assets/img/bg-mb.b54724f5.webp');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
}

.banner {
    position: relative;
    width: 100%;
    height: 90%;
}

.banner-img {
    background-size: cover;
    background-position: center;
}

.booking-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 15px 30px;
    background: #ff5a5f;
    color: white;
    text-decoration: none;
    font-size: 18px;
    border-radius: 5px;
}

.title {
    position: relative;
    margin-top: 40px;

}

.booking-button:hover {
    background: #ff3a3f;
}

.section-title {
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    position: absolute;
    z-index: 1;
    color: white;
    background-color: red;
    padding: 0 10px;
    top: 0;
    left: 0;
}

.card-deck {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

.card {
    margin-bottom: 30px;
    width: 30%;
}

.card img {
    height: 200px;
    object-fit: cover;
}

.social-network {
    width: 100%;
    text-align: center;
    margin: 50px 0 150px 0;
}

th,
td {
    text-align: center;
}
.brand{
    width: 70%;
    display: flex;
    justify-content: space-between;
    margin: 0 auto;
    background-color: #fff;
    position: absolute;
    top: -50px;
    left: 150px;
    border-radius: 50px;
    border: 1px solid black;
}

.imgBrand {
    width: auto;
    max-height: 100px;
    object-fit: cover;
    display: block;
    margin: 0 auto;
    padding: 10px;
}
</style>

<div class="banner">
    <div class="banner-img" style="background-image: url('assets/img/herobanner.jpg');">
        <a href="products.php" class="booking-button">Booking Now</a>
    </div>
</div>
<div class="container d-block position-relative" style="z-index: 3;">
    <div class="brand">
        <img class="imgBrand" src="assets/img/bamboo.jpg" alt="">
        <img class="imgBrand" src="assets/img/logoStar.png" alt="">
        <img class="imgBrand" src="assets/img/logoVJ.png" alt="">
        <img class="imgBrand" src="assets/img/logoVNA.png" alt="">
    </div>
</div>

<div class="container d-block">
    <!-- Danh lam thắng cảnh tại Việt Nam -->
    <div class="title">
        <div class="section-title">Travel</div>
        <div class="card-deck">
            <div class="card">
                <img src="assets/img/image2.jpg" class="card-img-top" alt="Hạ Long Bay">
                <div class="card-body">
                    <h5 class="card-title">Hạ Long Bay</h5>
                    <p class="card-text">Hạ Long Bay is known for its emerald waters and thousands of towering limestone
                        islands topped with rainforests.</p>
                </div>
            </div>
            <div class="card">
                <img src="assets/img/phongnha.jpg" class="card-img-top" alt="Phong Nha-Ke Bang National Park">
                <div class="card-body">
                    <h5 class="card-title">Phong Nha-Ke Bang National Park</h5>
                    <p class="card-text">Phong Nha-Ke Bang National Park is a UNESCO World Heritage site famed for its
                        cave systems including Son Doong, the world's largest cave.</p>
                </div>
            </div>
            <div class="card">
                <img src="assets/img/myson.jpg" class="card-img-top" alt="My Son Sanctuary">
                <div class="card-body">
                    <h5 class="card-title">My Son Sanctuary</h5>
                    <p class="card-text">My Son Sanctuary is a cluster of abandoned and partially ruined Hindu temples
                        constructed between the 4th and the 14th century AD.</p>
                </div>
            </div>
        </div>
        <div class="card-deck">
            <div class="card">
                <img src="assets/img/hoankiem.jpg" class="card-img-top" alt="Hoan Kiem Lake">
                <div class="card-body">
                    <h5 class="card-title">Hoan Kiem Lake</h5>
                    <p class="card-text">Hoan Kiem Lake is a freshwater lake in the historical center of Hanoi, Vietnam.
                    </p>
                </div>
            </div>
            <div class="card">
                <img src="assets/img/cuchi.jpg" class="card-img-top" alt="Cu Chi Tunnels">
                <div class="card-body">
                    <h5 class="card-title">Cu Chi Tunnels</h5>
                    <p class="card-text">The Cu Chi Tunnels are an extensive network of tunnels used by the Viet Cong
                        during the Vietnam War.</p>
                </div>
            </div>
            <div class="card">
                <img src="assets/img/hue.jpg" class="card-img-top" alt="Hue Imperial City">
                <div class="card-body">
                    <h5 class="card-title">Hue Imperial City</h5>
                    <p class="card-text">The Imperial City of Hue is a walled fortress and palace in the city of Hue,
                        the former imperial capital of Vietnam.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="title">
        <div class="section-title">Food</div>
        <div class="card-deck">
            <div class="card">
                <img src="assets/img/cuon.webp" class="card-img-top" alt="Phở Cuốn">
                <div class="card-body">
                    <h5 class="card-title">Phở Cuốn</h5>
                    <p class="card-text">Phở Cuốn is a popular Vietnamese street food made from rice noodle sheets
                        wrapped around shrimp, pork, vegetables, and herbs.</p>
                </div>
            </div>
            <div class="card">
                <img src="assets/img/pho.jpg" class="card-img-top" alt="Phở">
                <div class="card-body">
                    <h5 class="card-title">Phở</h5>
                    <p class="card-text">Phở is a popular Vietnamese noodle soup made from beef or chicken broth, rice
                        noodles, herbs, and your choice of beef or chicken.</p>
                </div>
            </div>
            <div class="card">
                <img src="assets/img/puding.jpg" class="card-img-top" alt="Tráng Miệng">
                <div class="card-body">
                    <h5 class="card-title">Puding</h5>
                    <p class="card-text">Puding is a dessert made from agar agar, sugar, and
                        flavorings such as coconut milk and fruit.</p>
                </div>
            </div>
        </div>
        <div class="card-deck">
            <div class="card">
                <img src="assets/img/banhmi.jpg" class="card-img-top" alt="Bánh Mì">
                <div class="card-body">
                    <h5 class="card-title">Bánh Mì</h5>
                    <p class="card-text">Bánh Mì is a popular Vietnamese sandwich made from a crispy baguette, pickled
                        carrots and daikon, cilantro, chili sauce, and various meats such as pork, chicken, or tofu.
                    </p>
                </div>
            </div>
            <div class="card">
                <img src="assets/img/drink.webp" class="card-img-top" alt="Bánh Mì">
                <div class="card-body">
                    <h5 class="card-title">Juice</h5>
                    <p class="card-text">Juice for your chose</p>
                </div>
            </div>
            <div class="card">
                <img src="assets/img/beef.webp" class="card-img-top" alt="Bánh Mì">
                <div class="card-body">
                    <h5 class="card-title">Beefsteak Kobe</h5>
                    <p class="card-text">Beefsteak is a popular Japanese dish of grilled or steamed beef served with
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="social-network">
    <a href="discussion.php">
        <img src="assets/img/chat.png" width="100%"
            alt="Social Network">
    </a>
    <h3 class="mt-4">Connect with us on our social network!</h3>
</div>
</div>

<!-- Social Network Section -->




<?php include 'layout/footer.php'; ?>
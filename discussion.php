<?php
ob_start(); // Bắt đầu output buffering
include 'layout/header.php';
include 'layout/navbar.php';
include 'config/connect.php';
include 'config/libFunc.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['thought'])) {
    $thought = $_POST['thought'];
    $username = $_SESSION['username'];
    $img = '';

    if ($uploadedImg = handleFileUpload($_FILES['img'])) {
        $img = $uploadedImg;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $sql = "INSERT INTO posts (username, img, thought) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $img, $thought);
    $stmt->execute();
    $stmt->close();

    // Chuyển hướng đến cùng trang để tránh gửi lại form khi refresh
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment']) && isset($_POST['post_id'])) {
    $comment = $_POST['comment'];
    $username = $_SESSION['username'];
    $post_id = $_POST['post_id'];

    $sql_comment = "INSERT INTO comments (post_id, username, comment) VALUES (?, ?, ?)";
    $stmt_comment = $conn->prepare($sql_comment);
    $stmt_comment->bind_param("iss", $post_id, $username, $comment);
    $stmt_comment->execute();
    $stmt_comment->close();

    // Chuyển hướng đến cùng trang để tránh gửi lại form khi refresh
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

$sql = "SELECT p.*, u.full_name FROM posts p JOIN users u ON p.username = u.username ORDER BY p.id DESC";
$result = $conn->query($sql);

if (!$result) {
    echo "Error: " . $conn->error;
    exit();
}
ob_end_flush(); // Kết thúc output buffering và gửi đầu ra
?>
<style>
.bgPages {
    background-image: url('assets/img/pexels-stefanstefancik-91217.jpg');
}

.container-discussion {
    display: flex;
    flex-direction: row;
    background: #252728;
    border-radius: 10px;
    margin-bottom: 100px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    height: 600px !important;
}

#inputBtn {
    width: 100%;
    padding: 10px 15px;
    border-radius: 20px;
    border-bottom: #333334;
    position: relative;
}

#inputBtn:focus {
    outline: none;
    cursor: pointer;
}

.input-wrapper {
    width: 80%;
}

.placeholder-text {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    font-size: 17px;
    color: #888;
    pointer-events: none;
}

.openForm {
    border-radius: 15px;
    overflow: hidden;
    background-color: #888;
}

.openForm .btn:hover {
    background-color: white;
    border-radius: 15px;
    color: black !important;
}

.modal-background {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    z-index: 1000;
}

.modal-content {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 10px;
    padding: 20px;
    z-index: 1001;
    width: 50%;
    height: auto;
}

.modal-content .close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: transparent;
    border: none;
    font-size: 20px;
    cursor: pointer;
}

.content {
    color: white;
    width: 40% !important;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.imgC {
    width: 60% !important;
    height: 100%;
    margin-right: 20px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    backdrop-filter: blur(10px);
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.1);
}

.imgContent {
    height: auto;
    width: auto;
}
.post-meta {
    margin-bottom: 10px !important;
}
.content .post-meta {
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
}

.post-meta .btn {
    color: white;
}

.post-meta .btn:hover {
    background-color: #888;
    transition: ease-in 0.5;
}

.content .thought {
    padding-left: 15px;
}

.comment-btn {
    height: 100%;
    padding: 0 20px;
}

.comment {
    padding-top: 10px;
    color: #ccc;
}

.comments {
    max-height: 407px;
    overflow: auto;
}

.comment p {
    margin: 0 !important;
}

.nutdangbai {
    padding: 15px 30px;
    height: 75.09px !important;
}

.comment-input {
    background-color: #888;
    padding: 15px 10px;
    border: none;
    z-index: 1 !important;
}

.comment-input:focus {
    background-color: #888;
    box-shadow: none !important;
}

.comment-form {
    background-color: #888;
    border-radius: 15px;
    overflow: hidden;
}

.comment-text {
    padding-left: 15px;
}

.areaComment {
    max-height: calc(100% - 50px);
    overflow: auto;
}
.optionP a{
    padding: 0;
}
</style>
<div class="bgPages"></div>
<div class="addressFolder">
    <h1>Social Network</h1>
</div>
<?php if (isset($_SESSION['username'])): ?>
<div class="container container-discussion mb-5 nutdangbai">
    <div class="input-wrapper" id="openModalBtn2" style="position: relative;">
        <input type="button" id="inputBtn" value="">
        <span class="placeholder-text"><?php echo $_SESSION['full_name']; ?>, bạn đang nghĩ gì ?</span>
    </div>
    <div class="openForm">
        <button class="btn" id="openModalBtn">
            <img src="assets/img/imgLogo.png" width="25px" height="25px" alt="">
            Thêm ảnh
        </button>
    </div>
</div>
<?php endif; ?>

<div class="modal-background" id="modalBackground"></div>
<div class="modal-content" id="modalContent">
    <button class="close-btn" id="closeModalBtn">&times;</button>
    <!-- Form đăng bài viết -->
    <form action="" method="post" enctype="multipart/form-data">
        <h3 class="text-center">ĐĂNG BÀI VIẾT</h3>
        <div class="form-group">
            <label for="thought">Suy nghĩ của bạn:</label>
            <textarea class="form-control" id="thought" name="thought" rows="3" required></textarea>
        </div>
        <div class="form-group mt-3">
            <label for="img">Chọn ảnh:</label>
            <input type="file" class="form-control" id="img" name="img">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Đăng</button>
    </form>
</div>
<?php if ($result && $result->num_rows > 0): ?>
<?php while ($row = $result->fetch_assoc()): ?>
<div class="container container-discussion">
    <div class="imgC">
        <img class="imgContent" src="assets/img/<?php echo $row['img']; ?>" alt="Post Image">
    </div>
    <div class="content">
        <div class="inforPost">
            <div class="post-meta">
                <strong><?php echo $row['full_name']; ?></strong>
                <div class="optionP">
                    <?php if (isset($_SESSION['username']) && $_SESSION['username'] == $row['username']): ?>
                    <a href="action/deletePost.php?id=<?php echo $row['id']; ?>"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')" class="btn"><i
                            class="fa-solid fa-trash"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="thought" style="border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                <?php echo $row['thought']; ?></div>
            <div class="areaComment">
                <div class="comments">
                    <?php
                    $sql_comments = "SELECT c.*, u.full_name FROM comments c JOIN users u ON c.username = u.username WHERE c.post_id = ?";
                    $stmt_comments = $conn->prepare($sql_comments);
                    if ($stmt_comments) {
                        $stmt_comments->bind_param("i", $row['id']);
                        $stmt_comments->execute();
                        $comments_result = $stmt_comments->get_result();
                    } else {
                        echo "Error preparing statement: " . $conn->error;
                    }
                    ?>
                    <?php if ($comments_result && $comments_result->num_rows > 0): ?>
                    <?php while ($comment = $comments_result->fetch_assoc()): ?>
                    <div class="comment">
                        <p><strong><?php echo $comment['full_name']; ?></strong></p>
                        <p class="comment-text"><?php echo $comment['comment']; ?></p>
                    </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <p>Không có bình luận nào.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="commentForm">
            <?php if (isset($_SESSION['username'])): ?>
            <form action="" method="post" class="comment-form">
                <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                <div class="input-group">
                    <input type="text" class="form-control comment-input" name="comment"
                        placeholder="Nhập bình luận...">
                    <div class="input-group-append">
                        <button type="submit" class="btn comment-btn"><i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </form>
            <?php else: ?>
            <a href="login.php">Đăng nhập để bình luận</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endwhile; ?>
<?php else: ?>
    <br>
<p>Không có bài viết nào.</p>
<?php endif; ?>
<script>
const openModalBtn = document.getElementById('openModalBtn');
const openModalBtn2 = document.getElementById('openModalBtn2');
const closeModalBtn = document.getElementById('closeModalBtn');
const modalBackground = document.getElementById('modalBackground');
const modalContent = document.getElementById('modalContent');
const inputBtn = document.getElementById('inputBtn');
const placeholderText = document.querySelector('.placeholder-text');
const commentBtns = document.querySelectorAll('.commentBtn');

if (openModalBtn) {
    openModalBtn.onclick = function() {
        modalBackground.style.display = 'block';
        modalContent.style.display = 'block';
    };
}

if (openModalBtn2) {
    openModalBtn2.onclick = function() {
        modalBackground.style.display = 'block';
        modalContent.style.display = 'block';
    };
}

closeModalBtn.onclick = function() {
    modalBackground.style.display = 'none';
    modalContent.style.display = 'none';
};

modalBackground.onclick = function() {
    modalBackground.style.display = 'none';
    modalContent.style.display = 'none';
};

inputBtn.onclick = function() {
    if (inputBtn.value === '') {
        placeholderText.style.display = 'block';
    }
};

commentBtns.forEach(function(button) {
    button.onclick = function() {
        <?php if (!isset($_SESSION['username'])): ?>
        window.location.href = 'login.php';
        <?php endif; ?>
    };
});
</script>
<?php include 'layout/footer.php'; ?>
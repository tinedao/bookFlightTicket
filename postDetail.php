<?php
include 'layout/header.php';
include 'layout/navbar.php';
include 'config/connect.php';

// Lấy post_id từ URL
$post_id = $_GET['id'];

// Fetch the post
$sql = "SELECT * FROM view_posts WHERE post_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$post_result = $stmt->get_result();
$post = $post_result->fetch_assoc();
?>
<style>
.bgPages {
    background-image: url('assets/img/pexels-stefanstefancik-91217.jpg');
}

.discussion-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.post-title {
    font-size: 2rem;
    font-weight: bold;
}

.post-img {
    max-width: 100%;
    border-radius: 10px;
}

.comment-box {
    border-radius: 25px;
    padding: 10px 15px;
    width: 100%;
    resize: none;
}

.comment-button {
    border-radius: 50px;
    padding: 10px 20px;
}

.comment-section {
    margin-top: 20px;
}

.comment-item {
    border-bottom: 1px solid #ccc;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.reply-item {
    margin-left: 20px;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
    margin-bottom: 10px;
}
</style>
<div class="bgPages"></div>
<div class="container py-5">
    <div class="discussion-container">
        <h1 class="post-title"><?php echo $post['full_name']; ?></h1>
        <br>
        <p><?php echo $post['thought']; ?></p>
        <img src="assets/img/<?php echo $post['img']; ?>" alt="Post Image" class="post-img">
        <div class="comment-section">
            <h2>Comments</h2>
            <form action="config/handleComment.php" method="post" class="mb-4">
                <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                <div class="mb-3">
                    <textarea name="comment" class="form-control comment-box" placeholder="Write a comment..." rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary comment-button">Comment</button>
            </form>
            <?php
            $sql = "SELECT * FROM view_comments WHERE post_id = ? ORDER BY created_at DESC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $post_id);
            $stmt->execute();
            $comments_result = $stmt->get_result();
            if ($comments_result->num_rows > 0) {
                while ($comment = $comments_result->fetch_assoc()) {
            ?>
            <div class="comment-item">
                <p><?php echo $comment['comment']; ?></p>
                <p><small>Posted by <?php echo $comment['full_name']; ?> on <?php echo $comment['created_at']; ?></small></p>
                <?php
                $comment_id = $comment['comment_id'];
                $sql = "SELECT * FROM view_comment_replies WHERE comment_id = ? ORDER BY created_at DESC";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $comment_id);
                $stmt->execute();
                $replies_result = $stmt->get_result();
                while ($reply = $replies_result->fetch_assoc()) {
                ?>
                <div class="reply-item">
                    <p><?php echo $reply['reply']; ?></p>
                    <p><small>Replied by <?php echo $reply['full_name']; ?> on <?php echo $reply['created_at']; ?></small></p>
                </div>
                <?php } ?>
                <form action="config/handleReply.php" method="post" class="mt-2">
                    <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
                    <div class="mb-3">
                        <textarea name="reply" class="form-control comment-box" placeholder="Write a reply..." rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-secondary comment-button">Reply</button>
                </form>
            </div>
            <?php
                }
            } else {
                echo "<p>No comments yet. Be the first to comment!</p>";
            }
            ?>
        </div>
    </div>
</div>
<?php include 'layout/footer.php'; ?>

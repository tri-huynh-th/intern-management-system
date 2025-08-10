<?php
$active_page = ''; 
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Đánh giá thực tập sinh: <?php echo htmlspecialchars($intern['fullname']); ?></h2>

<div class="card">
    <div class="card-body">
        <?php if (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
        <?php elseif (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="/intern_management_system/mentor/evaluate/<?php echo $intern['intern_id']; ?>" method="POST">
            <div class="form-group mb-3">
                <label for="score">Điểm số (0-100):</label>
                <input type="number" id="score" name="score" class="form-control" min="0" max="100" required>
            </div>
            <div class="form-group mb-3">
                <label for="comments">Bình luận và Phản hồi:</label>
                <textarea id="comments" name="comments" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Lưu đánh giá</button>
            <a href="/intern_management_system/mentor/progress/<?php echo $intern['intern_id']; ?>"
                class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
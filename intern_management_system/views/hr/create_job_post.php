<?php
$active_page = 'manage_job_posts';
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Tạo Tin tuyển dụng mới</h2>

<div class="card">
    <div class="card-body">
        <?php if (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
        <?php elseif (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="/intern_management_system/hr/job/create" method="POST">
            <div class="form-group mb-3">
                <label for="title">Tiêu đề:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Mô tả:</label>
                <textarea id="description" name="description" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="requirements">Yêu cầu:</label>
                <textarea id="requirements" name="requirements" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="application_deadline">Hạn chót ứng tuyển:</label>
                <input type="date" id="application_deadline" name="application_deadline" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Lưu tin tuyển dụng</button>
            <a href="/intern_management_system/hr/job/manage" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
<?php
$active_page = 'profile';
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Hồ sơ cá nhân</h2>
<div class="card">
    <div class="card-body">
        <h5>Thông tin chung</h5>
        <p><strong>Họ và tên:</strong> <?php echo htmlspecialchars($intern['fullname']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($intern['email']); ?></p>
        <p><strong>Điện thoại:</strong> <?php echo htmlspecialchars($intern['phone']); ?></p>

        <h5 class="mt-4">Thông tin thực tập</h5>
        <p><strong>Trường:</strong> <?php echo htmlspecialchars($intern['university']); ?></p>
        <p><strong>Chuyên ngành:</strong> <?php echo htmlspecialchars($intern['major']); ?></p>
        <p><strong>Ngày bắt đầu:</strong> <?php echo htmlspecialchars($intern['start_date']); ?></p>
        <p><strong>Trạng thái:</strong> <?php echo htmlspecialchars($intern['current_status']); ?></p>

        <a href="#" class="btn btn-primary mt-3">Cập nhật hồ sơ</a>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
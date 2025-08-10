<?php
$active_page = 'dashboard';
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Dashboard của Quản trị viên</h2>

<div class="card-grid">
    <div class="card metric-card">
        <i class="fas fa-users fa-3x mb-3 text-primary"></i>
        <h3>Tổng số người dùng</h3>
        <p class="fs-4 fw-bold">50</p>
    </div>
    <div class="card metric-card">
        <i class="fas fa-user-graduate fa-3x mb-3 text-success"></i>
        <h3>Số thực tập sinh</h3>
        <p class="fs-4 fw-bold">30</p>
    </div>
    <div class="card metric-card">
        <i class="fas fa-briefcase fa-3x mb-3 text-info"></i>
        <h3>Tin tuyển dụng đang mở</h3>
        <p class="fs-4 fw-bold">5</p>
    </div>
</div>

<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <h4 class="card-header">Hoạt động gần đây</h4>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">User **nguyenvana** đã tạo tin tuyển dụng mới.</li>
                    <li class="list-group-item">User **lethib** đã cập nhật hồ sơ cá nhân.</li>
                    <li class="list-group-item">Admin **admin_user** đã reset mật khẩu của một người dùng.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
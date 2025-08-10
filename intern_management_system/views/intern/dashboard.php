<?php
$active_page = 'dashboard';
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Dashboard của Thực tập sinh</h2>

<div class="card-grid">
    <div class="card metric-card">
        <i class="fas fa-tasks fa-3x mb-3 text-primary"></i>
        <h3>Tổng số nhiệm vụ</h3>
        <p class="fs-4 fw-bold">12</p>
    </div>
    <div class="card metric-card">
        <i class="fas fa-check-circle fa-3x mb-3 text-success"></i>
        <h3>Đã hoàn thành</h3>
        <p class="fs-4 fw-bold">8</p>
    </div>
    <div class="card metric-card">
        <i class="fas fa-spinner fa-3x mb-3 text-warning"></i>
        <h3>Đang tiến hành</h3>
        <p class="fs-4 fw-bold">4</p>
    </div>
    <div class="card metric-card">
        <i class="fas fa-star fa-3x mb-3 text-info"></i>
        <h3>Điểm đánh giá TB</h3>
        <p class="fs-4 fw-bold">9.1</p>
    </div>
</div>

<div class="row mt-5">
    <div class="col-lg-8">
        <div class="card">
            <h4 class="card-header">Tiến độ nhiệm vụ gần đây</h4>
            <div class="card-body">
                <canvas id="intern-progress-chart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <h4 class="card-header">Nhiệm vụ sắp đến hạn</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Phát triển tính năng đăng nhập
                    <span class="badge bg-danger rounded-pill">Hạn: 15/08</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Viết báo cáo hàng tuần
                    <span class="badge bg-warning text-dark rounded-pill">Hạn: 12/08</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
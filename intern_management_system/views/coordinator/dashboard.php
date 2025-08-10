<?php
$active_page = 'dashboard';
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Dashboard của Điều phối viên</h2>

<div class="card-grid">
    <div class="card metric-card">
        <i class="fas fa-user-friends fa-3x mb-3 text-primary"></i>
        <h3>Tổng số thực tập sinh</h3>
        <p class="fs-4 fw-bold">30</p>
    </div>
    <div class="card metric-card">
        <i class="fas fa-graduation-cap fa-3x mb-3 text-success"></i>
        <h3>Sắp hoàn thành</h3>
        <p class="fs-4 fw-bold">5</p>
    </div>
    <div class="card metric-card">
        <i class="fas fa-calendar-alt fa-3x mb-3 text-warning"></i>
        <h3>Phỏng vấn chờ xử lý</h3>
        <p class="fs-4 fw-bold">8</p>
    </div>
</div>

<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <h4 class="card-header">Hiệu suất trung bình của chương trình</h4>
            <div class="card-body">
                <canvas id="program-performance-chart"></canvas>
            </div>
        </div>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
<?php
$active_page = 'dashboard';
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Dashboard của HR Manager</h2>

<div class="card-grid">
    <div class="card metric-card">
        <i class="fas fa-briefcase fa-3x mb-3 text-primary"></i>
        <h3>Tổng số tin tuyển dụng</h3>
        <p class="fs-4 fw-bold">15</p>
    </div>
    <div class="card metric-card">
        <i class="fas fa-user-plus fa-3x mb-3 text-success"></i>
        <h3>Ứng viên mới</h3>
        <p class="fs-4 fw-bold">25</p>
    </div>
    <div class="card metric-card">
        <i class="fas fa-user-graduate fa-3x mb-3 text-info"></i>
        <h3>Thực tập sinh hoạt động</h3>
        <p class="fs-4 fw-bold">10</p>
    </div>
</div>

<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <h4 class="card-header">Tin tuyển dụng gần đây</h4>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Ngày đăng</th>
                            <th>Hạn chót</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Thực tập sinh Lập trình Web</td>
                            <td>2024-08-01</td>
                            <td>2024-09-30</td>
                            <td><span class="badge bg-success">Đang mở</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary">Xem</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Thực tập sinh Phân tích Dữ liệu</td>
                            <td>2024-07-15</td>
                            <td>2024-08-15</td>
                            <td><span class="badge bg-warning text-dark">Sắp đóng</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary">Xem</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
<?php
$active_page = 'manage_programs';
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Quản lý Chương trình Đào tạo</h2>

<div class="mb-3">
    <a href="/intern_management_system/coordinator/program/create" class="btn btn-success">
        <i class="fas fa-plus"></i> Tạo chương trình mới
    </a>
</div>

<div class="card">
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Chương trình đào tạo Lập trình viên PHP
                <div>
                    <a href="#" class="btn btn-sm btn-warning">Sửa</a>
                    <a href="#" class="btn btn-sm btn-danger">Xóa</a>
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Chương trình đào tạo Phân tích dữ liệu
                <div>
                    <a href="#" class="btn btn-sm btn-warning">Sửa</a>
                    <a href="#" class="btn btn-sm btn-danger">Xóa</a>
                </div>
            </li>
        </ul>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
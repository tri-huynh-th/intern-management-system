<?php
$active_page = 'dashboard';
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Dashboard của Người hướng dẫn</h2>

<div class="card-grid">
    <div class="card metric-card">
        <i class="fas fa-users-cog fa-3x mb-3 text-primary"></i>
        <h3>Số lượng thực tập sinh</h3>
        <p class="fs-4 fw-bold">7</p>
    </div>
    <div class="card metric-card">
        <i class="fas fa-exclamation-triangle fa-3x mb-3 text-danger"></i>
        <h3>Nhiệm vụ quá hạn</h3>
        <p class="fs-4 fw-bold">3</p>
    </div>
    <div class="card metric-card">
        <i class="fas fa-calendar-check fa-3x mb-3 text-warning"></i>
        <h3>Đánh giá đến hạn</h3>
        <p class="fs-4 fw-bold">2</p>
    </div>
</div>

<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <h4 class="card-header">Danh sách Thực tập sinh của bạn</h4>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Ngày bắt đầu</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($interns)): ?>
                        <?php foreach ($interns as $intern): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($intern['fullname']); ?></td>
                            <td><?php echo htmlspecialchars($intern['email']); ?></td>
                            <td><?php echo htmlspecialchars($intern['start_date']); ?></td>
                            <td><span
                                    class="badge bg-info"><?php echo htmlspecialchars($intern['current_status']); ?></span>
                            </td>
                            <td>
                                <a href="/intern_management_system/mentor/progress/<?php echo $intern['intern_id']; ?>"
                                    class="btn btn-sm btn-primary">Xem tiến độ</a>
                                <a href="/intern_management_system/mentor/evaluate/<?php echo $intern['intern_id']; ?>"
                                    class="btn btn-sm btn-warning">Đánh giá</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Bạn chưa phụ trách thực tập sinh nào.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
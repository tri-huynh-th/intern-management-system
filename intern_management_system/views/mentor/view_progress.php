<?php
$active_page = ''; // Trang này không có trong menu chính
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Tiến độ của: <?php echo htmlspecialchars($intern['fullname']); ?></h2>

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <h4 class="card-header">Thông tin chi tiết</h4>
            <div class="card-body">
                <p><strong>Email:</strong> <?php echo htmlspecialchars($intern['email']); ?></p>
                <p><strong>Ngày bắt đầu:</strong> <?php echo htmlspecialchars($intern['start_date']); ?></p>
                <p><strong>Trạng thái:</strong> <span
                        class="badge bg-info"><?php echo htmlspecialchars($intern['current_status']); ?></span></p>
                <a href="/intern_management_system/mentor/evaluate/<?php echo $intern['intern_id']; ?>"
                    class="btn btn-warning mt-3">Thực hiện đánh giá mới</a>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card mb-4">
            <h4 class="card-header">Thống kê hiệu suất</h4>
            <div class="card-body">
                <canvas id="performance-chart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <h4 class="card-header">Danh sách nhiệm vụ</h4>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Ngày đến hạn</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($assignments)): ?>
                <?php foreach ($assignments as $assignment): ?>
                <tr>
                    <td><?php echo htmlspecialchars($assignment['title']); ?></td>
                    <td><?php echo htmlspecialchars($assignment['due_date']); ?></td>
                    <td>
                        <span class="badge bg-<?php 
                                    switch ($assignment['status']) {
                                        case 'completed': echo 'success'; break;
                                        case 'in_progress': echo 'warning'; break;
                                        case 'overdue': echo 'danger'; break;
                                        default: echo 'secondary'; break;
                                    }
                                ?>">
                            <?php echo htmlspecialchars($assignment['status']); ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">Thực tập sinh này chưa có nhiệm vụ.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
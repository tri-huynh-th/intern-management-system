<?php
$active_page = 'manage_interns';
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Quản lý Thực tập sinh</h2>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Họ và tên</th>
                    <th>Chuyên ngành</th>
                    <th>Ngày bắt đầu</th>
                    <th>Trạng thái</th>
                    <th>Người hướng dẫn</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($interns)): ?>
                <?php foreach ($interns as $intern): ?>
                <tr>
                    <td><?php echo htmlspecialchars($intern['fullname']); ?></td>
                    <td><?php echo htmlspecialchars($intern['major']); ?></td>
                    <td><?php echo htmlspecialchars($intern['start_date']); ?></td>
                    <td><span class="badge bg-info"><?php echo htmlspecialchars($intern['current_status']); ?></span>
                    </td>
                    <td><?php echo htmlspecialchars($intern['mentor_name']); ?></td>
                    <td>
                        <a href="/intern_management_system/coordinator/intern/view/<?php echo $intern['intern_id']; ?>"
                            class="btn btn-sm btn-primary">Xem chi tiết</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Không có thực tập sinh nào.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
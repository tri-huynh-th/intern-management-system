<?php
$active_page = 'assignments';
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Danh sách Nhiệm vụ</h2>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tiêu đề nhiệm vụ</th>
                    <th>Mô tả</th>
                    <th>Người giao</th>
                    <th>Ngày đến hạn</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($assignments)): ?>
                <?php foreach ($assignments as $assignment): ?>
                <tr>
                    <td><?php echo htmlspecialchars($assignment['title']); ?></td>
                    <td><?php echo htmlspecialchars(substr($assignment['description'], 0, 50)) . '...'; ?></td>
                    <td><?php echo htmlspecialchars($assignment['assigned_by_name']); ?></td>
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
                    <td>
                        <a href="/intern_management_system/intern/assignment/view/<?php echo $assignment['assignment_id']; ?>"
                            class="btn btn-sm btn-info">Xem</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Không có nhiệm vụ nào được giao.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
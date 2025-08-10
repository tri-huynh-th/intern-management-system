<?php
$active_page = 'evaluations';
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Đánh giá Hiệu suất</h2>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Người đánh giá</th>
                    <th>Ngày đánh giá</th>
                    <th>Điểm số</th>
                    <th>Bình luận</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($evaluations)): ?>
                <?php foreach ($evaluations as $evaluation): ?>
                <tr>
                    <td><?php echo htmlspecialchars($evaluation['evaluator_name']); ?></td>
                    <td><?php echo htmlspecialchars($evaluation['evaluation_date']); ?></td>
                    <td><span
                            class="badge bg-primary fs-6"><?php echo htmlspecialchars($evaluation['score']); ?>/100</span>
                    </td>
                    <td><?php echo nl2br(htmlspecialchars($evaluation['comments'])); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Chưa có đánh giá nào.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
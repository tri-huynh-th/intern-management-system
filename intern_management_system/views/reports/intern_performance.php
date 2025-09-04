<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>reports" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại Báo cáo</a>
<br>
<h1>Báo cáo Hiệu suất Thực tập sinh</h1>

<?php if (!empty($data['intern_performance'])): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tên Thực tập sinh</th>
            <th>Email</th>
            <th>Điểm đánh giá trung bình</th>
            <th>Tổng số đánh giá</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['intern_performance'] as $report): ?>
            <tr>
                <td><?php echo $report['intern_name']; ?></td>
                <td><?php echo $report['intern_email']; ?></td>
                <td><?php echo round($report['average_rating'], 2) ?? 'N/A'; ?></td>
                <td><?php echo $report['total_evaluations']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>Không có dữ liệu báo cáo hiệu suất thực tập sinh.</p>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>

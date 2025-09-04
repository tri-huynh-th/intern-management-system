<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>reports" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại Báo cáo</a>
<br>
<h1>Báo cáo Hiệu suất Chiến dịch Tuyển dụng</h1>

<?php if (!empty($data['campaign_performance'])): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tên Chiến dịch</th>
            <th>Tổng số Thực tập sinh</th>
            <th>Số Thực tập sinh được chấp nhận</th>
            <th>Tỷ lệ chấp nhận</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['campaign_performance'] as $report): ?>
            <tr>
                <td><?php echo $report['campaign_title']; ?></td>
                <td><?php echo $report['total_interns']; ?></td>
                <td><?php echo $report['accepted_interns']; ?></td>
                <td>
                    <?php
                        if ($report['total_interns'] > 0) {
                            echo round(($report['accepted_interns'] / $report['total_interns']) * 100, 2) . '%';
                        } else {
                            echo 'N/A';
                        }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>Không có dữ liệu báo cáo hiệu suất chiến dịch.</p>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>

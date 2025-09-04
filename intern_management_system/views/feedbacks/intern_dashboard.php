<?php require APPROOT . '/views/inc/header.php'; ?>
<h1>Phản hồi Thực tập sinh</h1>
<p>Chào mừng, <?php echo $_SESSION['username']; ?>!</p>

<h3 class="mt-4">Phản hồi của bạn</h3>
<?php if (!empty($data['feedback_list'])): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Người cung cấp phản hồi</th>
            <th>Loại phản hồi</th>
            <th>Ngày phản hồi</th>
            <th>Nội dung</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['feedback_list'] as $feedback): ?>
        <tr>
            <td><?php echo $feedback['feedback_provider_name']; ?></td>
            <td><?php echo $feedback['feedback_type']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($feedback['feedback_date'])); ?></td>
            <td><?php echo $feedback['feedback_content']; ?></td>
            <td>
                <a href="<?php echo BASE_URL; ?>internfeedbacks/details/<?php echo $feedback['id']; ?>"
                    class="btn btn-info">Chi tiết</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>Bạn chưa có phản hồi nào.</p>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>
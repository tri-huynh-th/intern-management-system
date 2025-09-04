<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('feedback_message'); ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Phản hồi Thực tập sinh</h1>
    </div>
    <div class="col-md-6">
        <?php if (isAdmin() || isHR() || isCoordinator() || isMentor()): ?>
        <a href="<?php echo BASE_URL; ?>internfeedbacks/add" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Thêm phản hồi mới
        </a>
        <?php endif; ?>
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Thực tập sinh</th>
            <th>Người cung cấp phản hồi</th>
            <th>Loại phản hồi</th>
            <th>Ngày phản hồi</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['intern_feedbacks'] as $feedback): ?>
        <tr>
            <td><?php echo $feedback['intern_name']; ?></td>
            <td><?php echo $feedback['feedback_provider_name']; ?></td>
            <td><?php echo $feedback['feedback_type']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($feedback['feedback_date'])); ?></td>
            <td>
                <a href="<?php echo BASE_URL; ?>internfeedbacks/details/<?php echo $feedback['id']; ?>"
                    class="btn btn-info">Chi tiết</a>
                <?php if (isAdmin() || isHR() || isCoordinator() || isMentor()): ?>
                <a href="<?php echo BASE_URL; ?>internfeedbacks/edit/<?php echo $feedback['id']; ?>"
                    class="btn btn-warning">Sửa</a>
                <form class="d-inline"
                    action="<?php echo BASE_URL; ?>internfeedbacks/delete/<?php echo $feedback['id']; ?>" method="post">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>
<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('program_message'); ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Chương trình Đào tạo</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo BASE_URL; ?>trainingprograms/add" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Thêm chương trình mới
        </a>
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tiêu đề</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Điều phối viên</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['training_programs'] as $program): ?>
            <tr>
                <td><?php echo $program['title']; ?></td>
                <td><?php echo $program['start_date']; ?></td>
                <td><?php echo $program['end_date']; ?></td>
                <td><?php echo $program['coordinator_name']; ?></td>
                <td><?php echo $program['status']; ?></td>
                <td>
                    <a href="<?php echo BASE_URL; ?>trainingprograms/details/<?php echo $program['id']; ?>" class="btn btn-info">Chi tiết</a>
                    <?php if (isAdmin() || isHR() || isCoordinator()): ?>
                        <a href="<?php echo BASE_URL; ?>trainingprograms/edit/<?php echo $program['id']; ?>" class="btn btn-warning">Sửa</a>
                        <form class="d-inline" action="<?php echo BASE_URL; ?>trainingprograms/delete/<?php echo $program['id']; ?>" method="post">
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>

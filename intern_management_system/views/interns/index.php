<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('intern_message'); ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Hồ sơ Thực tập sinh</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo BASE_URL; ?>interns/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Thêm thực tập sinh mới
        </a>
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tên thực tập sinh</th>
            <th>Chiến dịch</th>
            <th>GPA</th>
            <th>Trường đại học</th>
            <th>Chuyên ngành</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['interns'] as $intern): ?>
        <tr>
            <td><?php echo $intern['intern_name']; ?></td>
            <td><?php echo $intern['campaign_title']; ?></td>
            <td><?php echo $intern['gpa']; ?></td>
            <td><?php echo $intern['university']; ?></td>
            <td><?php echo $intern['major']; ?></td>
            <td><?php echo $intern['status']; ?></td>
            <td>
                <a href="<?php echo BASE_URL; ?>interns/details/<?php echo $intern['intern_id']; ?>"
                    class="btn btn-info">Chi
                    tiết</a>
                <?php if (isAdmin() || isHR()): ?>
                <a href="<?php echo BASE_URL; ?>interns/edit/<?php echo $intern['intern_id']; ?>"
                    class="btn btn-warning">Sửa</a>
                <form class="d-inline"
                    action="<?php echo BASE_URL; ?>interns/delete/<?php echo $intern['intern_id']; ?>" method="post">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>
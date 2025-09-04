<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('campaign_message'); ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Chiến dịch Tuyển dụng</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo BASE_URL; ?>campaigns/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Thêm chiến dịch mới
        </a>
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tiêu đề</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['campaigns'] as $campaign): ?>
            <tr>
                <td><?php echo $campaign['title']; ?></td>
                <td><?php echo $campaign['start_date']; ?></td>
                <td><?php echo $campaign['end_date']; ?></td>
                <td><?php echo $campaign['status']; ?></td>
                <td>
                    <a href="<?php echo BASE_URL; ?>campaigns/details/<?php echo $campaign['id']; ?>" class="btn btn-info">Chi tiết</a>
                    <a href="<?php echo BASE_URL; ?>campaigns/edit/<?php echo $campaign['id']; ?>" class="btn btn-warning">Sửa</a>
                    <form class="d-inline" action="<?php echo BASE_URL; ?>campaigns/delete/<?php echo $campaign['id']; ?>" method="post">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>

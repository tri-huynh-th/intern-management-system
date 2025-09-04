<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('interview_message'); ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Lịch Phỏng vấn</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo BASE_URL; ?>interviewschedules/add" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Thêm lịch phỏng vấn mới
        </a>
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Thực tập sinh</th>
            <th>Người phỏng vấn</th>
            <th>Ngày và giờ</th>
            <th>Địa điểm</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['interview_schedules'] as $schedule): ?>
            <tr>
                <td><?php echo $schedule['intern_name']; ?></td>
                <td><?php echo $schedule['interviewer_name']; ?></td>
                <td><?php echo date('d/m/Y H:i', strtotime($schedule['interview_date'])); ?></td>
                <td><?php echo $schedule['location']; ?></td>
                <td><?php echo $schedule['status']; ?></td>
                <td>
                    <a href="<?php echo BASE_URL; ?>interviewschedules/details/<?php echo $schedule['id']; ?>" class="btn btn-info">Chi tiết</a>
                    <?php if (isAdmin() || isHR() || isCoordinator()): ?>
                        <a href="<?php echo BASE_URL; ?>interviewschedules/edit/<?php echo $schedule['id']; ?>" class="btn btn-warning">Sửa</a>
                        <form class="d-inline" action="<?php echo BASE_URL; ?>interviewschedules/delete/<?php echo $schedule['id']; ?>" method="post">
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>

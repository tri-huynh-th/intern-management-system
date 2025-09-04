<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>interviewschedules" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại</a>
<br>
<h1>Chi tiết Lịch phỏng vấn</h1>
<div class="bg-light p-2 mb-3">
    <strong>Thực tập sinh:</strong> <?php echo $data['interview_schedule']['intern_name']; ?><br>
    <strong>Người phỏng vấn:</strong> <?php echo $data['interview_schedule']['interviewer_name']; ?><br>
    <strong>Ngày và giờ:</strong> <?php echo date('d/m/Y H:i', strtotime($data['interview_schedule']['interview_date'])); ?><br>
    <strong>Địa điểm:</strong> <?php echo $data['interview_schedule']['location']; ?><br>
    <strong>Trạng thái:</strong> <?php echo $data['interview_schedule']['status']; ?><br>
    <strong>Ghi chú:</strong> <?php echo $data['interview_schedule']['notes']; ?><br>
    <strong>Ngày tạo:</strong> <?php echo $data['interview_schedule']['created_at']; ?><br>
</div>

<?php if (isAdmin() || isHR() || isCoordinator()): ?>
<a href="<?php echo BASE_URL; ?>interviewschedules/edit/<?php echo $data['interview_schedule']['id']; ?>" class="btn btn-dark">Sửa</a>

<form class="pull-right" action="<?php echo BASE_URL; ?>interviewschedules/delete/<?php echo $data['interview_schedule']['id']; ?>" method="post">
    <input type="submit" value="Xóa" class="btn btn-danger">
</form>
<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>

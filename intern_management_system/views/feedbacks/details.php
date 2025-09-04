<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>internfeedbacks" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại</a>
<br>
<h1>Chi tiết Phản hồi Thực tập sinh</h1>
<div class="bg-light p-2 mb-3">
    <strong>Thực tập sinh:</strong> <?php echo $data['intern_feedback']['intern_name']; ?><br>
    <strong>Người cung cấp phản hồi:</strong> <?php echo $data['intern_feedback']['feedback_provider_name']; ?><br>
    <strong>Loại phản hồi:</strong> <?php echo $data['intern_feedback']['feedback_type']; ?><br>
    <strong>Ngày phản hồi:</strong>
    <?php echo date('d/m/Y', strtotime($data['intern_feedback']['feedback_date'])); ?><br>
    <strong>Nội dung phản hồi:</strong> <?php echo $data['intern_feedback']['feedback_content']; ?><br>
    <strong>Ngày tạo:</strong> <?php echo $data['intern_feedback']['created_at']; ?><br>
</div>

<?php if (isAdmin() || isHR() || isCoordinator() || isMentor()): ?>
<a href="<?php echo BASE_URL; ?>internfeedbacks/edit/<?php echo $data['intern_feedback']['id']; ?>"
    class="btn btn-dark">Sửa</a>

<form class="pull-right"
    action="<?php echo BASE_URL; ?>internfeedbacks/delete/<?php echo $data['intern_feedback']['id']; ?>" method="post">
    <input type="submit" value="Xóa" class="btn btn-danger">
</form>
<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
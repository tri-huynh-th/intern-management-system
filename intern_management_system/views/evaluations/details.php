<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>internevaluations" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại</a>
<br>
<h1>Chi tiết Đánh giá Thực tập sinh</h1>
<div class="bg-light p-2 mb-3">
    <strong>Thực tập sinh:</strong> <?php echo $data['evaluation']['intern_name']; ?><br>
    <strong>Người đánh giá:</strong> <?php echo $data['evaluation']['evaluator_name']; ?><br>
    <strong>Ngày đánh giá:</strong> <?php echo date('d/m/Y', strtotime($data['evaluation']['evaluation_date'])); ?><br>
    <strong>Điểm tổng thể:</strong> <?php echo $data['evaluation']['overall_rating']; ?><br>
    <strong>Bình luận:</strong> <?php echo $data['evaluation']['comments']; ?><br>
    <strong>Ngày tạo:</strong> <?php echo $data['evaluation']['created_at']; ?><br>
</div>

<?php if (isAdmin() || isHR() || isCoordinator() || isMentor()): ?>
<a href="<?php echo BASE_URL; ?>internevaluations/edit/<?php echo $data['evaluation']['id']; ?>" class="btn btn-dark">Sửa</a>

<form class="pull-right" action="<?php echo BASE_URL; ?>internevaluations/delete/<?php echo $data['evaluation']['id']; ?>" method="post">
    <input type="submit" value="Xóa" class="btn btn-danger">
</form>
<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>

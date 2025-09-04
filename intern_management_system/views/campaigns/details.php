<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>campaigns" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại</a>
<br>
<h1><?php echo $data['campaign']['title']; ?></h1>
<div class="bg-light p-2 mb-3">
    Mô tả: <?php echo $data['campaign']['description']; ?><br>
    Ngày bắt đầu: <?php echo $data['campaign']['start_date']; ?><br>
    Ngày kết thúc: <?php echo $data['campaign']['end_date']; ?><br>
    Trạng thái: <?php echo $data['campaign']['status']; ?><br>
    Ngày tạo: <?php echo $data['campaign']['created_at']; ?><br>
</div>

<?php if (isAdmin() || isHR()): ?>
<a href="<?php echo BASE_URL; ?>campaigns/edit/<?php echo $data['campaign']['id']; ?>" class="btn btn-dark">Sửa</a>

<form class="pull-right" action="<?php echo BASE_URL; ?>campaigns/delete/<?php echo $data['campaign']['id']; ?>" method="post">
    <input type="submit" value="Xóa" class="btn btn-danger">
</form>
<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>

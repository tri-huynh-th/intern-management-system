<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>interns" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại</a>
<br>
<h1>Thông tin Thực tập sinh: <?php echo $data['intern']['intern_name']; ?></h1>
<div class="bg-light p-2 mb-3">
    <strong>Chiến dịch:</strong> <?php echo $data['intern']['campaign_title']; ?><br>
    <strong>Email:</strong> <?php echo $data['intern']['email']; ?><br>
    <strong>GPA:</strong> <?php echo $data['intern']['gpa']; ?><br>
    <strong>Trường đại học:</strong> <?php echo $data['intern']['university']; ?><br>
    <strong>Chuyên ngành:</strong> <?php echo $data['intern']['major']; ?><br>
    <strong>Ngày bắt đầu:</strong> <?php echo $data['intern']['start_date']; ?><br>
    <strong>Ngày kết thúc:</strong> <?php echo $data['intern']['end_date']; ?><br>
    <strong>Trạng thái:</strong> <?php echo $data['intern']['status']; ?><br>
    <strong>Ngày tạo hồ sơ:</strong> <?php echo $data['intern']['created_at']; ?><br>
</div>

<?php if (isAdmin() || isHR()): ?>
<a href="<?php echo BASE_URL; ?>interns/edit/<?php echo $data['intern']['id']; ?>" class="btn btn-dark">Sửa</a>

<form class="pull-right" action="<?php echo BASE_URL; ?>interns/delete/<?php echo $data['intern']['id']; ?>"
    method="post">
    <input type="submit" value="Xóa" class="btn btn-danger">
</form>
<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
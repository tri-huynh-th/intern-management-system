<?php require APPROOT . '/views/inc/header.php'; ?>
<h1>Chi tiết Người dùng</h1>
<a href="<?php echo BASE_URL; ?>users" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại</a>
<div class="card card-body bg-light mt-5">
    <p><strong>ID:</strong> <?php echo $data['user']['id']; ?></p>
    <p><strong>Họ và Tên:</strong> <?php echo $data['user']['full_name']; ?></p>
    <p><strong>Tên người dùng:</strong> <?php echo $data['user']['username']; ?></p>
    <p><strong>Email:</strong> <?php echo $data['user']['email']; ?></p>
    <p><strong>Vai trò:</strong> <?php echo $data['user']['role_id']; ?></p>
    <p><strong>Ngày tạo:</strong> <?php echo $data['user']['created_at']; ?></p>
    <hr>
    <a href="<?php echo BASE_URL; ?>users/edit/<?php echo $data['user']['id']; ?>" class="btn btn-warning">Sửa</a>
    <a href="<?php echo BASE_URL; ?>users/changePassword/<?php echo $data['user']['id']; ?>"
        class="btn btn-secondary">Đổi mật khẩu</a>
    <form action="<?php echo BASE_URL; ?>users/delete/<?php echo $data['user']['id']; ?>" method="post"
        class="pull-right">
        <button type="submit" class="btn btn-danger">Xóa</button>
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
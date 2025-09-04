<?php require APPROOT . '/views/inc/header.php'; ?>
<h1>Quản lý Người dùng</h1>
<?php flash('user_message'); ?>
<a href="<?php echo BASE_URL; ?>users/add" class="btn btn-primary">Thêm người dùng</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Họ và Tên</th>
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>Vai trò</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['users'] as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['full_name']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['role_name']; ?></td>
                <td><?php echo $user['created_at']; ?></td>
                <td>
                    <a href="<?php echo BASE_URL; ?>users/details/<?php echo $user['id']; ?>" class="btn btn-info">Xem</a>
                    <a href="<?php echo BASE_URL; ?>users/edit/<?php echo $user['id']; ?>" class="btn btn-warning">Sửa</a>
                    <a href="<?php echo BASE_URL; ?>users/changePassword/<?php echo $user['id']; ?>" class="btn btn-secondary">Đổi mật khẩu</a>
                    <form action="<?php echo BASE_URL; ?>users/delete/<?php echo $user['id']; ?>" method="post" style="display:inline-block;">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>

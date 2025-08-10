<?php
$active_page = 'user_management';
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Quản lý Người dùng</h2>

<div class="mb-3">
    <a href="/intern_management_system/admin/user/create" class="btn btn-success">
        <i class="fas fa-plus"></i> Tạo người dùng mới
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên đăng nhập</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['role_name']); ?></td>
                    <td>
                        <a href="/intern_management_system/admin/user/edit/<?php echo $user['user_id']; ?>"
                            class="btn btn-sm btn-warning">Sửa</a>
                        <a href="/intern_management_system/admin/user/delete/<?php echo $user['user_id']; ?>"
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Không có người dùng nào.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
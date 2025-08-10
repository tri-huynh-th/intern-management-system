<?php
$active_page = 'user_management';
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Tạo người dùng mới</h2>

<div class="card">
    <div class="card-body">
        <?php if (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
        <?php elseif (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="/intern_management_system/admin/user/create" method="POST">
            <div class="form-group mb-3">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="fullname">Họ và tên:</label>
                <input type="text" id="fullname" name="fullname" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="role_id">Vai trò:</label>
                <select id="role_id" name="role_id" class="form-control" required>
                    <?php if (!empty($roles)): ?>
                    <?php foreach ($roles as $role): ?>
                    <option value="<?php echo $role['role_id']; ?>"><?php echo htmlspecialchars($role['role_name']); ?>
                    </option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tạo người dùng</button>
            <a href="/intern_management_system/admin/user/manage" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
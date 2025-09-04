<?php require APPROOT . '/views/inc/header.php'; ?>
<h1>Thêm Người dùng mới</h1>
<form action="<?php echo BASE_URL; ?>users/add" method="post">
    <div class="form-group">
        <label for="full_name">Họ và Tên: <sup>*</sup></label>
        <input type="text" name="full_name"
            class="form-control <?php echo (!empty($data['full_name_err'])) ? 'is-invalid' : ''; ?>"
            value="<?php echo $data['full_name']; ?>">
        <span class="invalid-feedback"><?php echo $data['full_name_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="phone_number">Số điện thoại:</label>
        <input type="text" name="phone_number" placeholder="Nhập số điện thoại" class="form-control"
            value="<?php echo isset($data['phone_number']) ? $data['phone_number'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="address">Địa chỉ:</label>
        <input type="text" name="address" placeholder="Nhập địa chỉ" class="form-control"
            value="<?php echo isset($data['address']) ? $data['address'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="email">Email: <sup>*</sup></label>
        <input type="email" name="email"
            class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
            value="<?php echo $data['email']; ?>">
        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="username">Tên người dùng: <sup>*</sup></label>
        <input type="text" name="username"
            class="form-control <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>"
            value="<?php echo $data['username']; ?>">
        <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="password">Mật khẩu: <sup>*</sup></label>
        <input type="password" name="password"
            class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"
            value="<?php echo $data['password']; ?>">
        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="confirm_password">Xác nhận mật khẩu: <sup>*</sup></label>
        <input type="password" name="confirm_password"
            class="form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>"
            value="<?php echo $data['confirm_password']; ?>">
        <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="role_id">Vai trò: <sup>*</sup></label>
        <select name="role_id" class="form-control <?php echo (!empty($data['role_id_err'])) ? 'is-invalid' : ''; ?>">
            <option value="">Chọn vai trò</option>
            <?php foreach ($data['roles'] as $role): ?>
            <option value="<?php echo $role['id']; ?>"
                <?php echo ($data['role_id'] == $role['id']) ? 'selected' : ''; ?>><?php echo $role['role_name']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <span class="invalid-feedback"><?php echo $data['role_id_err']; ?></span>
    </div>
    <button type="submit" class="btn btn-success">Thêm người dùng</button>
</form>
<?php require APPROOT . '/views/inc/footer.php'; ?>
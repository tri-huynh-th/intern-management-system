<?php require APPROOT . '/views/inc/header.php'; ?>
<h1>Chỉnh sửa Người dùng</h1>
<form action="<?php echo BASE_URL; ?>users/edit/<?php echo $data['id']; ?>" method="post">
    <div class="form-group">
        <label for="full_name">Họ và Tên: <sup>*</sup></label>
        <input type="text" name="full_name" class="form-control <?php echo (!empty($data['full_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['full_name']; ?>">
        <span class="invalid-feedback"><?php echo $data['full_name_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="email">Email: <sup>*</sup></label>
        <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="role_id">Vai trò: <sup>*</sup></label>
        <select name="role_id" class="form-control <?php echo (!empty($data['role_id_err'])) ? 'is-invalid' : ''; ?>">
            <option value="">Chọn vai trò</option>
            <?php foreach ($data['roles'] as $role): ?>
                <option value="<?php echo $role['id']; ?>" <?php echo ($data['role_id'] == $role['id']) ? 'selected' : ''; ?>><?php echo $role['role_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <span class="invalid-feedback"><?php echo $data['role_id_err']; ?></span>
    </div>
    <button type="submit" class="btn btn-success">Cập nhật người dùng</button>
</form>
<?php require APPROOT . '/views/inc/footer.php'; ?>

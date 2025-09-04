<?php require APPROOT . '/views/inc/header.php'; ?>
<h1>Đổi mật khẩu cho Người dùng: <?php echo $data['user']['username']; ?></h1>
<form action="<?php echo BASE_URL; ?>users/changePassword/<?php echo $data['id']; ?>" method="post">
    <div class="form-group">
        <label for="new_password">Mật khẩu mới: <sup>*</sup></label>
        <input type="password" name="new_password" class="form-control <?php echo (!empty($data['new_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['new_password']; ?>">
        <span class="invalid-feedback"><?php echo $data['new_password_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="confirm_new_password">Xác nhận mật khẩu mới: <sup>*</sup></label>
        <input type="password" name="confirm_new_password" class="form-control <?php echo (!empty($data['confirm_new_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_new_password']; ?>">
        <span class="invalid-feedback"><?php echo $data['confirm_new_password_err']; ?></span>
    </div>
    <button type="submit" class="btn btn-success">Đổi mật khẩu</button>
</form>
<?php require APPROOT . '/views/inc/footer.php'; ?>

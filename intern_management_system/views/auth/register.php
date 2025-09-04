<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?> - Đăng ký</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-image">
                <img src="<?php echo BASE_URL; ?>img/register_illustration.png" alt="Register Illustration">
            </div>
            <h1>Chào mừng đến với Hệ thống Quản lý thực tập sinh</h1>
            <p class="description">Tham gia cùng chúng tôi để quản lý chương trình thực tập của bạn một cách dễ dàng.
            </p>

            <?php flash('user_message'); ?>
            <?php if (isset($_SESSION['success_message'])) : ?>
            <div class="alert success"><?php echo $_SESSION['success_message']; ?></div>
            <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <form action="<?php echo BASE_URL; ?>auth/register" method="post">
                <div class="form-group">
                    <label for="full_name">Họ và Tên: <sup>*</sup></label>
                    <input type="text" name="full_name" placeholder="Nhập họ và tên"
                        class="form-control <?php echo (isset($data['full_name_err']) && !empty($data['full_name_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo isset($data['full_name']) ? $data['full_name'] : ''; ?>">
                    <?php if (isset($data['full_name_err'])): ?><span
                        class="invalid-feedback"><?php echo $data['full_name_err']; ?></span><?php endif; ?>
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
                    <input type="email" name="email" placeholder="Nhập địa chỉ email"
                        class="form-control <?php echo (isset($data['email_err']) && !empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>">
                    <?php if (isset($data['email_err'])): ?><span
                        class="invalid-feedback"><?php echo $data['email_err']; ?></span><?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="username">Tên người dùng: <sup>*</sup></label>
                    <input type="text" name="username" placeholder="Nhập tên người dùng"
                        class="form-control <?php echo (isset($data['username_err']) && !empty($data['username_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>">
                    <?php if (isset($data['username_err'])): ?><span
                        class="invalid-feedback"><?php echo $data['username_err']; ?></span><?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu: <sup>*</sup></label>
                    <input type="password" name="password" placeholder="Nhập mật khẩu"
                        class="form-control <?php echo (isset($data['password_err']) && !empty($data['password_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo isset($data['password']) ? $data['password'] : ''; ?>">
                    <?php if (isset($data['password_err'])): ?><span
                        class="invalid-feedback"><?php echo $data['password_err']; ?></span><?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Xác nhận mật khẩu: <sup>*</sup></label>
                    <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu"
                        class="form-control <?php echo (isset($data['confirm_password_err']) && !empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo isset($data['confirm_password']) ? $data['confirm_password'] : ''; ?>">
                    <?php if (isset($data['confirm_password_err'])): ?><span
                        class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span><?php endif; ?>
                </div>
                <button type="submit" class="btn btn-auth">Đăng Ký</button>
            </form>
            <div class="link-text">
                <p>Đã có tài khoản? <a href="<?php echo BASE_URL; ?>auth/login">Đăng nhập</a></p>
            </div>
            <footer>
                <p>&copy; <?php echo date('Y'); ?> Hệ thống Quản lý thực tập sinh. Mọi quyền được bảo lưu.</p>
            </footer>
        </div>
    </div>
</body>

</html>
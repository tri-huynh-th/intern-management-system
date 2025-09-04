<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?> - Đăng nhập</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-image">
                <img src="<?php echo BASE_URL; ?>img/login_illustration.png" alt="Login Illustration">
            </div>
            <h1>Chào mừng đến với Hệ thống Quản lý thực tập sinh</h1>
            <p class="description">Quản lý chương trình thực tập của bạn một cách hiệu quả với các công cụ mạnh mẽ của
                chúng tôi.</p>

            <?php flash('user_message'); ?>
            <?php if (isset($_SESSION['success_message'])) : ?>
            <div class="alert success"><?php echo $_SESSION['success_message']; ?></div>
            <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <form action="<?php echo BASE_URL; ?>auth/login" method="post">
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" name="username" placeholder="Nhập tên đăng nhập"
                        class="form-control <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $data['username']; ?>">
                    <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" placeholder="Nhập mật khẩu"
                        class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="remember_me" name="remember_me">
                    <label for="remember_me">Ghi nhớ đăng nhập</label>
                </div>
                <button type="submit" class="btn btn-auth">Đăng Nhập</button>
            </form>
            <div class="link-text">
                <!-- <a href="<?php echo BASE_URL; ?>auth/forgotPassword" class="forgot-password">Quên mật khẩu?</a> -->
                <p>Chưa có tài khoản? <a href="<?php echo BASE_URL; ?>auth/register">Đăng ký</a></p>
            </div>
            <footer>
                <p>&copy; <?php echo date('Y'); ?> Hệ thống Quản lý thực tập sinh. Mọi quyền được bảo lưu.</p>
            </footer>
        </div>
    </div>
</body>

</html>
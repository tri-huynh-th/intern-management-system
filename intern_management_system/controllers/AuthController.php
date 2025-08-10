<?php
// intern_management_system/controllers/AuthController.php

require_once 'config/database.php';
require_once 'models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new UserModel($conn);
    }

    public function login() {
        // Kiểm tra nếu người dùng đã submit form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                // Đăng nhập thành công, tạo session
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role_id'] = $user['role_id'];

                // Chuyển hướng người dùng về trang dashboard
                header('Location: /intern_management_system/dashboard');
                exit();
            } else {
                // Đăng nhập thất bại, hiển thị lại trang login với thông báo lỗi
                $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
                require_once 'views/auth/login.php';
            }
        } else {
            // Lần đầu truy cập trang login, hiển thị form
            require_once 'views/auth/login.php';
        }
    }

    public function logout() {
        session_start();
        session_unset(); // Xóa tất cả các biến session
        session_destroy(); // Hủy session
        header('Location: /intern_management_system/login');
        exit();
    }
}
?>
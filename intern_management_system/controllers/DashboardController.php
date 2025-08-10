<?php
// intern_management_system/controllers/DashboardController.php

// session_start();

class DashboardController {

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            // Nếu chưa đăng nhập, chuyển hướng về trang login
            header('Location: /intern_management_system/login');
            exit();
        }

        // Lấy vai trò của người dùng từ session
        $role_id = $_SESSION['role_id'];

        // Tùy thuộc vào role_id, hiển thị dashboard tương ứng
        switch ($role_id) {
            case 1: // Administrator
                // Load dữ liệu cho admin dashboard
                require_once '../views/admin/dashboard.php';
                break;
            case 2: // HR Manager
                // Load dữ liệu cho HR dashboard
                require_once '../views/hr/dashboard.php';
                break;
            // ... Thêm các trường hợp khác cho các vai trò còn lại
            case 5: // Intern
                require_once '../views/intern/dashboard.php';
                break;
            default:
                // Vai trò không xác định hoặc không có dashboard
                header('Location: /intern_management_system/login');
                exit();
        }
    }
}
?>
<?php
// Bắt đầu session nếu chưa có
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    header('Location: /intern_management_system/views/auth/login.php');
    exit();
}

// Lấy role_id từ session
$role_id = $_SESSION['role_id'];

// Tùy thuộc vào role_id, nhúng file dashboard tương ứng
switch ($role_id) {
    case 1: // Administrator
        require_once 'admin/dashboard.php';
        break;
    case 2: // HR Manager
        require_once 'hr/dashboard.php';
        break;
    case 3: // Intern Coordinator
        require_once 'coordinator/dashboard.php';
        break;
    case 4: // Mentor
        require_once 'mentor/dashboard.php';
        break;
    case 5: // Intern
        require_once 'intern/dashboard.php';
        break;
    default:
        // Xử lý các vai trò không xác định hoặc không có dashboard
        echo "Bạn không có quyền truy cập vào trang này.";
        // Có thể chuyển hướng về trang đăng nhập
        // header('Location: /intern_management_system/views/auth/login.php');
        // exit();
        break;
}
?>
<?php
// Bắt đầu session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Nhúng các file cần thiết
require_once 'config/database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/InternController.php';
require_once 'controllers/HRController.php';
require_once 'controllers/MentorController.php';
require_once 'controllers/AdminController.php';
require_once 'models/UserModel.php';
require_once 'models/InternModel.php';
require_once 'models/JobModel.php';
require_once 'models/AssignmentModel.php';
require_once 'models/EvaluationModel.php';
require_once 'models/RoleModel.php';

// Lấy URI từ server
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_uri = trim($request_uri, '/');
$base_path = 'intern_management_system';

// Lọc URI để lấy các tham số
if (strpos($request_uri, $base_path) === 0) {
    $request_uri = substr($request_uri, strlen($base_path));
}
$routes = explode('/', trim($request_uri, '/'));

$controller_name = array_shift($routes);
$method_name = array_shift($routes);

// --- Logic định tuyến (Routing Logic) ---

// Nếu không có controller nào được chỉ định, mặc định sẽ là trang dashboard
if (empty($controller_name) || $controller_name === 'dashboard') {
    $controller = new DashboardController();
    $controller->index();
    exit();
}

// Định tuyến cho trang đăng nhập/đăng xuất
if ($controller_name === 'login') {
    $controller = new AuthController($conn);
    $controller->login();
    exit();
}

if ($controller_name === 'logout') {
    $controller = new AuthController($conn);
    $controller->logout();
    exit();
}

// Định tuyến cho các controller khác
switch ($controller_name) {
    case 'intern':
        $controller = new InternController($conn);
        break;
    case 'hr':
        $controller = new HRController($conn);
        break;
    case 'mentor':
        $controller = new MentorController($conn);
        break;
    case 'admin':
        $controller = new AdminController($conn);
        break;
    default:
        // Xử lý trang 404 - Not Found
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
        exit();
}

// Kiểm tra xem method có tồn tại không
if (method_exists($controller, $method_name)) {
    // Gọi phương thức với các tham số còn lại
    call_user_func_array([$controller, $method_name], $routes);
} else {
    // Xử lý trang 404 nếu method không tồn tại
    http_response_code(404);
    echo "<h1>404 - Method Not Found</h1>";
}

// Đóng kết nối CSDL
$conn->close();
?>
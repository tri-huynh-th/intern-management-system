<?php
// Cấu hình kết nối MySQL
define('DB_SERVER', 'localhost'); // Server CSDL (thường là localhost khi dùng XAMPP)
define('DB_USERNAME', 'root');    // Tên người dùng CSDL mặc định của XAMPP
define('DB_PASSWORD', '');       // Mật khẩu CSDL mặc định của XAMPP (để trống)
define('DB_NAME', 'intern_management_db'); // Tên CSDL của dự án

/*
 * Cố gắng kết nối với CSDL MySQL
 */
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Kiểm tra kết nối
if($conn === false){
    die("Lỗi: Không thể kết nối. " . $conn->connect_error);
}

// Thiết lập bộ ký tự (charset) để hỗ trợ tiếng Việt
$conn->set_charset("utf8mb4");

?>
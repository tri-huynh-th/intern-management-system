<?php
// intern_management_system/controllers/HRController.php

require_once 'config/database.php';
require_once 'models/JobModel.php';

class HRController {
    private $jobModel;

    public function __construct($conn) {
        $this->jobModel = new JobModel($conn);
    }

    public function manageJobPosts() {
        // Lấy danh sách tất cả các tin tuyển dụng từ model
        $jobPosts = $this->jobModel->getAllJobPosts();

        // Hiển thị giao diện quản lý tin tuyển dụng
        require_once '../views/hr/manage_job_posts.php';
    }

    public function createJobPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $requirements = $_POST['requirements'];
    $application_deadline = $_POST['application_deadline']; // Thêm dòng này
    $posted_by = $_SESSION['user_id'];

    // Truyền đủ 5 tham số vào phương thức
    if ($this->jobModel->addJobPost($title, $description, $requirements, $posted_by, $application_deadline)) {
        $success = "Tạo tin tuyển dụng thành công.";
    } else {
        $error = "Đã xảy ra lỗi khi tạo tin tuyển dụng.";
    }
}
        
        // Hiển thị form tạo tin tuyển dụng
        require_once '../views/hr/create_job_post.php';
    }
}
<?php
// intern_management_system/controllers/InternController.php

require_once 'config/database.php';
require_once 'models/InternModel.php';
require_once 'models/AssignmentModel.php';
require_once 'models/EvaluationModel.php';

class InternController {
    private $internModel;
    private $assignmentModel;
    private $evaluationModel;

    public function __construct($conn) {
        $this->internModel = new InternModel($conn);
        $this->assignmentModel = new AssignmentModel($conn);
        $this->evaluationModel = new EvaluationModel($conn);
    }

    public function viewProfile() {
        $user_id = $_SESSION['user_id'];
        
        // Lấy thông tin chi tiết của thực tập sinh
        $intern = $this->internModel->getInternByUserId($user_id);
        // Lấy danh sách nhiệm vụ của họ
        $assignments = $this->assignmentModel->getAssignmentsByInternId($intern['intern_id']);
        // Lấy các đánh giá
        $evaluations = $this->evaluationModel->getEvaluationsByInternId($intern['intern_id']);

        // Hiển thị giao diện hồ sơ cá nhân
        require_once '../views/intern/profile.php';
    }

    // Các hàm khác như submit feedback, update profile... có thể được thêm vào đây
}
<?php
// intern_management_system/controllers/MentorController.php

require_once 'config/database.php';
require_once 'models/InternModel.php';
require_once 'models/AssignmentModel.php';
require_once 'models/EvaluationModel.php';

class MentorController {
    private $internModel;
    private $assignmentModel;
    private $evaluationModel;

    public function __construct($conn) {
        $this->internModel = new InternModel($conn);
        $this->assignmentModel = new AssignmentModel($conn);
        $this->evaluationModel = new EvaluationModel($conn);
    }

    public function viewInternProgress($intern_id) {
        // Lấy thông tin thực tập sinh
        $intern = $this->internModel->getInternById($intern_id);
        // Lấy danh sách các nhiệm vụ của thực tập sinh
        $assignments = $this->assignmentModel->getAssignmentsByInternId($intern_id);
        // Lấy các đánh giá của thực tập sinh
        $evaluations = $this->evaluationModel->getEvaluationsByInternId($intern_id);

        // Hiển thị giao diện theo dõi tiến độ
        require_once '../views/mentor/view_progress.php';
    }

    public function evaluateIntern($intern_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $score = $_POST['score'];
            $comments = $_POST['comments'];
            $evaluator_id = $_SESSION['user_id'];

            // Lưu đánh giá vào CSDL
            $this->evaluationModel->addEvaluation($intern_id, $evaluator_id, $score, $comments);
            
            // Chuyển hướng về trang xem tiến độ
            header("Location: /intern_management_system/mentor/progress/{$intern_id}");
            exit();
        }

        // Hiển thị form đánh giá
        require_once '../views/mentor/evaluate_intern.php';
    }
}
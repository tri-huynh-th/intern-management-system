<?php
// intern_management_system/models/EvaluationModel.php

class EvaluationModel {
    private $conn;
    private $table_name = "evaluations";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả đánh giá của một thực tập sinh
    public function getEvaluationsByInternId($intern_id) {
        $sql = "SELECT e.*, u.fullname AS evaluator_name FROM " . $this->table_name . " e
                JOIN users u ON e.evaluator_id = u.user_id
                WHERE e.intern_id = ? ORDER BY evaluation_date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $intern_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // Thêm đánh giá mới
    public function addEvaluation($intern_id, $evaluator_id, $score, $comments) {
        $sql = "INSERT INTO " . $this->table_name . " (intern_id, evaluator_id, score, comments) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiss", $intern_id, $evaluator_id, $score, $comments);
        return $stmt->execute();
    }
}
?>
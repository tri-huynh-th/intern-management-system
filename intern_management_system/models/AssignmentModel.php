<?php
// intern_management_system/models/AssignmentModel.php

class AssignmentModel {
    private $conn;
    private $table_name = "assignments";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy danh sách nhiệm vụ của một thực tập sinh cụ thể
    public function getAssignmentsByInternId($intern_id) {
        $sql = "SELECT * FROM " . $this->table_name . " WHERE intern_id = ? ORDER BY due_date ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $intern_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // Tạo nhiệm vụ mới
    public function addAssignment($intern_id, $title, $description, $assigned_by, $due_date) {
        $sql = "INSERT INTO " . $this->table_name . " (intern_id, title, description, assigned_by, due_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issss", $intern_id, $title, $description, $assigned_by, $due_date);
        return $stmt->execute();
    }

    // Cập nhật trạng thái nhiệm vụ
    public function updateAssignmentStatus($assignment_id, $status) {
        $sql = "UPDATE " . $this->table_name . " SET status=? WHERE assignment_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $assignment_id);
        return $stmt->execute();
    }
}
?>
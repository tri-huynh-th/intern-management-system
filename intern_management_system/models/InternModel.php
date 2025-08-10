<?php
// intern_management_system/models/InternModel.php

class InternModel {
    private $conn;
    private $table_name = "interns";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Hàm lấy thông tin thực tập sinh bằng ID
    public function getInternById($intern_id) {
        $sql = "SELECT i.*, u.fullname, u.email, u.phone FROM " . $this->table_name . " i
                JOIN users u ON i.user_id = u.user_id
                WHERE i.intern_id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $intern_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // Hàm lấy thông tin thực tập sinh bằng User ID
    public function getInternByUserId($user_id) {
        $sql = "SELECT i.*, u.fullname, u.email, u.phone FROM " . $this->table_name . " i
                JOIN users u ON i.user_id = u.user_id
                WHERE i.user_id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Hàm lấy danh sách tất cả thực tập sinh
    public function getAllInterns() {
        $sql = "SELECT i.*, u.fullname FROM " . $this->table_name . " i
                JOIN users u ON i.user_id = u.user_id";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
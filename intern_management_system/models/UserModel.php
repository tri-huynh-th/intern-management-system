<?php
// intern_management_system/models/UserModel.php

class UserModel {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Hàm lấy thông tin người dùng bằng username
    public function getUserByUsername($username) {
        $sql = "SELECT u.*, r.role_name 
                FROM " . $this->table_name . " u
                JOIN roles r ON u.role_id = r.role_id
                WHERE u.username = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
    
    // Hàm lấy danh sách tất cả người dùng
    public function getAllUsers() {
        $sql = "SELECT u.*, r.role_name FROM " . $this->table_name . " u
                JOIN roles r ON u.role_id = r.role_id
                ORDER BY u.user_id DESC";
        
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // Hàm tạo người dùng mới
    public function createUser($username, $password, $email, $role_id) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO " . $this->table_name . " (username, password, email, role_id) VALUES (?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $hashed_password, $email, $role_id);
        
        return $stmt->execute();
    }
    
    // Hàm xóa người dùng
    public function deleteUser($user_id) {
        $sql = "DELETE FROM " . $this->table_name . " WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }
}
?>
<?php
// intern_management_system/models/RoleModel.php

class RoleModel {
    private $conn;
    private $table_name = "roles";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả các vai trò
    public function getAllRoles() {
        $sql = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
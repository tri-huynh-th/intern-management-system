<?php
// intern_management_system/models/JobModel.php

class JobModel {
    private $conn;
    private $table_name = "job_posts";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả các tin tuyển dụng
    public function getAllJobPosts() {
        $sql = "SELECT * FROM " . $this->table_name . " ORDER BY posted_at DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // Tạo tin tuyển dụng mới
    public function addJobPost($title, $description, $requirements, $posted_by, $application_deadline) {
        $sql = "INSERT INTO " . $this->table_name . " (title, description, requirements, posted_by, application_deadline) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssii", $title, $description, $requirements, $posted_by, $application_deadline);
        return $stmt->execute();
    }
    
    // Cập nhật thông tin tin tuyển dụng
    public function updateJobPost($job_id, $title, $description, $requirements, $application_deadline) {
        $sql = "UPDATE " . $this->table_name . " SET title=?, description=?, requirements=?, application_deadline=? WHERE job_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssii", $title, $description, $requirements, $application_deadline, $job_id);
        return $stmt->execute();
    }
    
    // Xóa tin tuyển dụng
    public function deleteJobPost($job_id) {
        $sql = "DELETE FROM " . $this->table_name . " WHERE job_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $job_id);
        return $stmt->execute();
    }
}
?>
<?php
// intern_management_system/models/MessageModel.php

class MessageModel {
    private $conn;
    private $table_name = "messages";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Gửi một tin nhắn mới
    public function sendMessage($sender_id, $receiver_id, $subject, $content) {
        $sql = "INSERT INTO " . $this->table_name . " (sender_id, receiver_id, subject, content) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiss", $sender_id, $receiver_id, $subject, $content);
        return $stmt->execute();
    }
    
    // Lấy tất cả tin nhắn đã nhận của một người dùng
    public function getReceivedMessages($user_id) {
        $sql = "SELECT m.*, u.fullname AS sender_name FROM " . $this->table_name . " m
                JOIN users u ON m.sender_id = u.user_id
                WHERE m.receiver_id = ? ORDER BY sent_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
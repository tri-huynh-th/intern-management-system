<?php
class Dashboard
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Tổng số thực tập sinh đang active
    public function getActiveInternCount()
    {
        $this->db->query('SELECT COUNT(*) as count FROM interns WHERE status = :status');
        $this->db->bind(':status', 'in_progress');
        $row = $this->db->single();
        return $row['count'] ?? 0;
    }

    // Tổng số chương trình
    public function getTotalTrainingProgramsCount()
    {
        $this->db->query('SELECT COUNT(*) as count FROM training_programs');
        $row = $this->db->single();
        return $row['count'] ?? 0;
    }

    // Số chương trình đã hoàn thành
    public function getCompletedTrainingProgramsCount()
    {
        $this->db->query('SELECT COUNT(*) as count FROM training_programs WHERE status = :status');
        $this->db->bind(':status', 'completed');
        $row = $this->db->single();
        return $row['count'] ?? 0;
    }

    // Số chương trình còn lại = tổng - đã hoàn thành
    public function getRemainingTrainingProgramsCount()
    {
        $total = $this->getTotalTrainingProgramsCount();
        $completed = $this->getCompletedTrainingProgramsCount();
        return max(0, $total - $completed);
    }

    // Tổng số nhiệm vụ đã hoàn thành
    public function getCompletedTasksCount()
    {
        $this->db->query('SELECT COUNT(*) as count FROM intern_evaluations WHERE overall_rating >= :rating');
        $this->db->bind(':rating', 3);
        $row = $this->db->single();
        return $row['count'] ?? 0;
    }

    // Tổng số nhiệm vụ
    public function getTotalTasksCount()
    {
        $this->db->query('SELECT COUNT(*) as count FROM intern_evaluations');
        $row = $this->db->single();
        return $row['count'] ?? 0;
    }

    // Số nhiệm vụ đang pending
    public function getPendingTasksCount()
    {
        $this->db->query('SELECT COUNT(*) as count FROM intern_feedback WHERE feedback_type = :type');
        $this->db->bind(':type', 'daily_progress');
        $row = $this->db->single();
        return $row['count'] ?? 0;
    }

    // Số nhiệm vụ chưa bắt đầu
    public function getNotStartedTasksCount()
    {
        $this->db->query('SELECT COUNT(*) as count FROM interns WHERE status = :status');
        $this->db->bind(':status', 'applied');
        $row = $this->db->single();
        return $row['count'] ?? 0;
    }

    // Notifications
    public function getLatestNotifications()
    {
        $this->db->query('SELECT 
            DATE_FORMAT(feedback_date, "%Y-%m-%d") as date,
            CONCAT("Feedback: ", feedback_content) as message
            FROM intern_feedback 
            ORDER BY feedback_date DESC 
            LIMIT 5');
        $notifications = $this->db->resultSet();

        if (empty($notifications)) {
            return $this->getDefaultNotifications();
        }
        return $notifications;
    }

    private function getDefaultNotifications()
    {
        return [
            [
                'date' => '2025-01-15',
                'message' => 'Chương trình đào tạo "Web Development" đã hoàn thành'
            ],
            [
                'date' => '2025-01-14',
                'message' => 'Thực tập sinh mới đã được thêm vào hệ thống'
            ],
            [
                'date' => '2025-01-13',
                'message' => 'Nhiệm vụ "Thiết kế giao diện" đã được giao'
            ],
            [
                'date' => '2025-01-12',
                'message' => 'Đánh giá hiệu suất tháng 1 đã được cập nhật'
            ],
            [
                'date' => '2025-01-11',
                'message' => 'Lịch phỏng vấn mới đã được lên kế hoạch'
            ]
        ];
    }
    public function getQualifiedInternsCount()
{
    $this->db->query("
        SELECT COUNT(*) AS total
        FROM (
            SELECT i.id, AVG(ie.overall_rating) AS avg_rating
            FROM interns i
            JOIN intern_evaluations ie ON i.id = ie.intern_id
            GROUP BY i.id
            HAVING avg_rating >= 3
        ) AS qualified_interns
    ");
    $row = $this->db->single();
return $row['total'];

}

}
<?php
class InterviewSchedule
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Lấy toàn bộ lịch phỏng vấn (dùng LEFT JOIN để không bỏ mất record nào)
    public function getInterviewSchedules()
    {
        $this->db->query("
        SELECT i.id, i.intern_id, i.interviewer_id, i.interview_date, 
               i.location, i.status, i.notes, i.created_at,  
               u.full_name AS intern_name,
               iv.full_name AS interviewer_name
        FROM interview_schedules i
        LEFT JOIN interns it ON i.intern_id = it.id
        LEFT JOIN users u ON it.user_id = u.id
        LEFT JOIN users iv ON i.interviewer_id = iv.id
        ORDER BY i.interview_date DESC
    ");
    return $this->db->resultSet();
    }

    public function addInterviewSchedule($data)
    {
        $this->db->query("
            INSERT INTO interview_schedules 
            (intern_id, interviewer_id, interview_date, location, status, notes) 
            VALUES (:intern_id, :interviewer_id, :interview_date, :location, :status, :notes)
        ");
        $this->db->bind(':intern_id', $data['intern_id']);
        $this->db->bind(':interviewer_id', $data['interviewer_id']);
        $this->db->bind(':interview_date', $data['interview_date']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':notes', $data['notes']);

        return $this->db->execute();
    }

    public function getInterviewScheduleById($id)
    {
        $this->db->query("
        SELECT i.id, i.intern_id, i.interviewer_id, i.interview_date, 
               i.location, i.status, i.notes, i.created_at,  -- thêm dòng này
               u.full_name AS intern_name,
               iv.full_name AS interviewer_name
        FROM interview_schedules i
        LEFT JOIN interns it ON i.intern_id = it.id
        LEFT JOIN users u ON it.user_id = u.id
        LEFT JOIN users iv ON i.interviewer_id = iv.id
        WHERE i.id = :id
    ");
    $this->db->bind(':id', $id);
    return $this->db->single();
    }

    public function updateInterviewSchedule($data)
    {
        $this->db->query("
            UPDATE interview_schedules 
            SET intern_id = :intern_id,
                interviewer_id = :interviewer_id,
                interview_date = :interview_date,
                location = :location,
                status = :status,
                notes = :notes
            WHERE id = :id
        ");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':intern_id', $data['intern_id']);
        $this->db->bind(':interviewer_id', $data['interviewer_id']);
        $this->db->bind(':interview_date', $data['interview_date']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':notes', $data['notes']);

        return $this->db->execute();
    }

    public function deleteInterviewSchedule($id)
    {
        $this->db->query("DELETE FROM interview_schedules WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Lấy danh sách interviewer (Admin, HR, Coordinator, Mentor)
    public function getInterviewers()
    {
        $this->db->query("
            SELECT id, full_name, email 
            FROM users 
            WHERE role_id IN (1, 2, 3, 4)
        ");
        return $this->db->resultSet();
    }
}
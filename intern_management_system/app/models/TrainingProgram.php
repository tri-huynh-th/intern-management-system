<?php

class TrainingProgram
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTrainingPrograms()
    {
        $this->db->query('SELECT training_programs.*, users.full_name as coordinator_name FROM training_programs JOIN users ON training_programs.coordinator_id = users.id ORDER BY training_programs.created_at DESC');
        return $this->db->resultSet();
    }

    public function addTrainingProgram($data)
    {
        $this->db->query('INSERT INTO training_programs (title, description, start_date, end_date, coordinator_id, status) VALUES(:title, :description, :start_date, :end_date, :coordinator_id, :status)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);
        $this->db->bind(':coordinator_id', $data['coordinator_id']);
        $this->db->bind(':status', $data['status']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getTrainingProgramById($id)
    {
        $this->db->query('SELECT training_programs.*, users.full_name as coordinator_name FROM training_programs JOIN users ON training_programs.coordinator_id = users.id WHERE training_programs.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateTrainingProgram($data)
    {
        $this->db->query('UPDATE training_programs SET title = :title, description = :description, start_date = :start_date, end_date = :end_date, coordinator_id = :coordinator_id, status = :status WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);
        $this->db->bind(':coordinator_id', $data['coordinator_id']);
        $this->db->bind(':status', $data['status']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTrainingProgram($id)
    {
        $this->db->query('DELETE FROM training_programs WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCoordinators()
    {
        $this->db->query('SELECT id, full_name, email FROM users WHERE role_id IN (1, 3)'); // Admin and Coordinator roles
        return $this->db->resultSet();
    }

    public function getInternsNotInProgram($program_id)
    {
        $this->db->query('SELECT users.id, users.full_name, users.email FROM users JOIN interns ON users.id = interns.user_id WHERE users.role_id = 5 AND interns.id NOT IN (SELECT intern_id FROM program_interns WHERE program_id = :program_id)');
        $this->db->bind(':program_id', $program_id);
        return $this->db->resultSet();
    }

    public function getInternsInProgram($program_id)
    // SELECT users.id, users.full_name, users.email FROM users JOIN interns ON users.id = interns.user_id JOIN program_interns ON interns.id = program_interns.intern_id WHERE program_interns.program_id = :program_id
    {
        $this->db->query(' SELECT interns.id as intern_id, users.full_name, users.email
        FROM interns
        JOIN users ON users.id = interns.user_id
        JOIN program_interns ON interns.id = program_interns.intern_id
        WHERE program_interns.program_id = :program_id');
        $this->db->bind(':program_id', $program_id);
        return $this->db->resultSet();
    }

    public function addInternToProgram($program_id, $intern_id)
    {
         // 1. Kiểm tra intern có tồn tại trong bảng interns
    $this->db->query("SELECT id FROM interns WHERE id = :intern_id");
    $this->db->bind(':intern_id', $intern_id);
    $intern = $this->db->single();

    if (!$intern) {
        // Intern không tồn tại → không insert
        return false;
    }

    // 2. Kiểm tra xem intern đã nằm trong program này chưa
    $this->db->query("SELECT * FROM program_interns 
                      WHERE program_id = :program_id AND intern_id = :intern_id");
    $this->db->bind(':program_id', $program_id);
    $this->db->bind(':intern_id', $intern_id);
    $exists = $this->db->single();

    if ($exists) {
        // Đã tồn tại rồi → không insert nữa
        return false;
    }

    // 3. Thêm mới nếu hợp lệ
    $this->db->query("INSERT INTO program_interns (program_id, intern_id) 
                      VALUES (:program_id, :intern_id)");
    $this->db->bind(':program_id', $program_id);
    $this->db->bind(':intern_id', $intern_id);

    return $this->db->execute();
    }

    public function removeInternFromProgram($program_id, $intern_id)
    {
        $this->db->query('DELETE FROM program_interns WHERE program_id = :program_id AND intern_id = :intern_id');
        $this->db->bind(':program_id', $program_id);
        $this->db->bind(':intern_id', $intern_id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
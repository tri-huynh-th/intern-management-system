<?php

class Intern
{
     private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    
    public function getAllInternUsers()
    // --SELECT u.id, u.full_name AS intern_name, u.email
    //     --FROM users u
    //     --WHERE u.role_id = 5
    //     --ORDER BY u.full_name ASC
{
    $this->db->query("
         SELECT 
                i.id AS intern_id, 
                u.full_name AS intern_name, 
                u.email
            FROM interns i
            JOIN users u ON i.user_id = u.id
            WHERE u.role_id = 5
            ORDER BY u.full_name ASC
    ");
    return $this->db->resultSet();
}

    public function addIntern($data)
    {
        $this->db->query('INSERT INTO interns (user_id, campaign_id, gpa, university, major, start_date, end_date, status) VALUES(:user_id, :campaign_id, :gpa, :university, :major, :start_date, :end_date, :status)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':campaign_id', $data['campaign_id']);
        $this->db->bind(':gpa', $data['gpa']);
        $this->db->bind(':university', $data['university']);
        $this->db->bind(':major', $data['major']);
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);
        $this->db->bind(':status', $data['status']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    

    public function updateIntern($data)
    {
        $this->db->query('UPDATE interns SET user_id = :user_id, campaign_id = :campaign_id, gpa = :gpa, university = :university, major = :major, start_date = :start_date, end_date = :end_date, status = :status WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':campaign_id', $data['campaign_id']);
        $this->db->bind(':gpa', $data['gpa']);
        $this->db->bind(':university', $data['university']);
        $this->db->bind(':major', $data['major']);
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);
        $this->db->bind(':status', $data['status']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteIntern($id)
    {
        $this->db->query('DELETE FROM interns WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAvailableUsersForInterns()
    {
        $this->db->query('SELECT users.id, users.full_name, users.email FROM users LEFT JOIN interns ON users.id = interns.user_id WHERE interns.user_id IS NULL AND users.role_id = 5'); 
        return $this->db->resultSet();
    }

    public function getInternByUserId($user_id)
    {
        $this->db->query('SELECT * FROM interns WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }
    

public function getAllUsersWithRolesMentor()
{
    $this->db->query("
        SELECT 
            u.id as user_id,
            u.full_name as intern_name,
            u.email,
            r.role_name
        FROM users u
        JOIN roles r ON u.role_id = r.id
        WHERE u.role_id IN (4)
        ORDER BY u.full_name ASC
    ");
    return $this->db->resultSet();
}
// Lấy danh sách thực tập sinh
    public function getInterns() {
    $this->db->query("
        SELECT 
            i.id AS intern_id,
            u.full_name AS intern_name,
            u.email,
            r.role_name,
            c.title AS campaign_title,
            i.gpa,
            i.university,
            i.major,
            i.status
        FROM interns i
        JOIN users u ON i.user_id = u.id
        JOIN roles r ON u.role_id = r.id
        LEFT JOIN campaigns c ON i.campaign_id = c.id
        WHERE u.role_id = 5
        ORDER BY u.full_name ASC
    ");
    return $this->db->resultSet();
}
public function getInternsForFeedback()
{
    $this->db->query("
        SELECT i.id AS intern_id, u.full_name AS intern_name, u.email
        FROM interns i
        JOIN users u ON i.user_id = u.id
        WHERE u.role_id = 5
        ORDER BY u.full_name ASC
    ");
    return $this->db->resultSet();
}
public function getInternById($id) { 
    $this->db->query("
        SELECT interns.*,
               users.full_name as intern_name,
               users.email,
               campaigns.title as campaign_title
        FROM interns
        JOIN users ON interns.user_id = users.id
        LEFT JOIN campaigns ON interns.campaign_id = campaigns.id
        WHERE interns.id = :id
    ");
    $this->db->bind(':id', $id);
    return $this->db->single();
}

}
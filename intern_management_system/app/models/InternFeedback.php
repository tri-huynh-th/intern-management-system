<?php

class InternFeedback
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getInternFeedback()
    {
        $this->db->query('SELECT intern_feedback.*, users.full_name as intern_name, feedback_provider_users.full_name as feedback_provider_name FROM intern_feedback JOIN interns ON intern_feedback.intern_id = interns.id JOIN users ON interns.user_id = users.id JOIN users as feedback_provider_users ON intern_feedback.feedback_provider_id = feedback_provider_users.id ORDER BY intern_feedback.feedback_date DESC');
        return $this->db->resultSet();
    }

    public function addInternFeedback($data)
    {
        $this->db->query('INSERT INTO intern_feedback (intern_id, feedback_provider_id, feedback_type, feedback_date, feedback_content) VALUES(:intern_id, :feedback_provider_id, :feedback_type, :feedback_date, :feedback_content)');
        $this->db->bind(':intern_id', $data['intern_id']);
        $this->db->bind(':feedback_provider_id', $data['feedback_provider_id']);
        $this->db->bind(':feedback_type', $data['feedback_type']);
        $this->db->bind(':feedback_date', $data['feedback_date']);
        $this->db->bind(':feedback_content', $data['feedback_content']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getInternFeedbackById($id)
    {
        $this->db->query('SELECT intern_feedback.*, users.full_name as intern_name, feedback_provider_users.full_name as feedback_provider_name FROM intern_feedback JOIN interns ON intern_feedback.intern_id = interns.id JOIN users ON interns.user_id = users.id JOIN users as feedback_provider_users ON intern_feedback.feedback_provider_id = feedback_provider_users.id WHERE intern_feedback.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateInternFeedback($data)
    {
        $this->db->query('UPDATE intern_feedback SET intern_id = :intern_id, feedback_provider_id = :feedback_provider_id, feedback_type = :feedback_type, feedback_date = :feedback_date, feedback_content = :feedback_content WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':intern_id', $data['intern_id']);
        $this->db->bind(':feedback_provider_id', $data['feedback_provider_id']);
        $this->db->bind(':feedback_type', $data['feedback_type']);
        $this->db->bind(':feedback_date', $data['feedback_date']);
        $this->db->bind(':feedback_content', $data['feedback_content']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteInternFeedback($id)
    {
        $this->db->query('DELETE FROM intern_feedback WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getInternsByMentorId($mentor_id)
    {
        $this->db->query('SELECT interns.id, users.full_name, users.email FROM interns JOIN users ON interns.user_id = users.id WHERE interns.id IN (SELECT DISTINCT intern_id FROM intern_evaluations WHERE evaluator_id = :mentor_id)'); // Or based on program assignment
        $this->db->bind(':mentor_id', $mentor_id);
        return $this->db->resultSet();
    }

    public function getFeedbackByInternId($intern_id)
    {
        $this->db->query('SELECT intern_feedback.*, feedback_provider_users.full_name as feedback_provider_name FROM intern_feedback JOIN users as feedback_provider_users ON intern_feedback.feedback_provider_id = feedback_provider_users.id WHERE intern_feedback.intern_id = :intern_id ORDER BY intern_feedback.feedback_date DESC');
        $this->db->bind(':intern_id', $intern_id);
        return $this->db->resultSet();
    }
}

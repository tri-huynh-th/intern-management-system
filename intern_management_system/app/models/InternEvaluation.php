<?php

class InternEvaluation
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getInternEvaluations()
    {
        $this->db->query('SELECT intern_evaluations.*, users.full_name as intern_name, evaluator_users.full_name as evaluator_name FROM intern_evaluations JOIN interns ON intern_evaluations.intern_id = interns.id JOIN users ON interns.user_id = users.id JOIN users as evaluator_users ON intern_evaluations.evaluator_id = evaluator_users.id ORDER BY intern_evaluations.evaluation_date DESC');
        return $this->db->resultSet();
    }

    public function addInternEvaluation($data)
    {
        $this->db->query('INSERT INTO intern_evaluations (intern_id, evaluator_id, evaluation_date, overall_rating, comments) VALUES(:intern_id, :evaluator_id, :evaluation_date, :overall_rating, :comments)');
        $this->db->bind(':intern_id', $data['intern_id']);
        $this->db->bind(':evaluator_id', $data['evaluator_id']);
        $this->db->bind(':evaluation_date', $data['evaluation_date']);
        $this->db->bind(':overall_rating', $data['overall_rating']);
        $this->db->bind(':comments', $data['comments']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getInternEvaluationById($id)
    {
        $this->db->query('SELECT intern_evaluations.*, users.full_name as intern_name, evaluator_users.full_name as evaluator_name FROM intern_evaluations JOIN interns ON intern_evaluations.intern_id = interns.id JOIN users ON interns.user_id = users.id JOIN users as evaluator_users ON intern_evaluations.evaluator_id = evaluator_users.id WHERE intern_evaluations.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateInternEvaluation($data)
    {
        $this->db->query('UPDATE intern_evaluations SET intern_id = :intern_id, evaluator_id = :evaluator_id, evaluation_date = :evaluation_date, overall_rating = :overall_rating, comments = :comments WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':intern_id', $data['intern_id']);
        $this->db->bind(':evaluator_id', $data['evaluator_id']);
        $this->db->bind(':evaluation_date', $data['evaluation_date']);
        $this->db->bind(':overall_rating', $data['overall_rating']);
        $this->db->bind(':comments', $data['comments']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteInternEvaluation($id)
    {
        $this->db->query('DELETE FROM intern_evaluations WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getEvaluators()
    {
        $this->db->query('SELECT id, full_name, email FROM users WHERE role_id IN (1, 2, 3, 4)'); // Admin, HR, Coordinator, Mentor roles
        return $this->db->resultSet();
    }
}

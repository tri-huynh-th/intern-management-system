<?php

class Report
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCampaignPerformanceReport()
    {
        $this->db->query('SELECT c.title as campaign_title, COUNT(i.id) as total_interns, SUM(CASE WHEN i.status = \'accepted\' THEN 1 ELSE 0 END) as accepted_interns FROM campaigns c LEFT JOIN interns i ON c.id = i.campaign_id GROUP BY c.id');
        return $this->db->resultSet();
    }

    public function getInternPerformanceReport()
    {
        $this->db->query('SELECT u.full_name as intern_name, u.email as intern_email, AVG(ie.overall_rating) as average_rating, COUNT(ie.id) as total_evaluations FROM interns i JOIN users u ON i.user_id = u.id LEFT JOIN intern_evaluations ie ON i.id = ie.intern_id GROUP BY i.id');
        return $this->db->resultSet();
    }
}

<?php

class Campaign
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCampaigns()
    {
        $this->db->query('SELECT * FROM campaigns ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function addCampaign($data)
    {
        $this->db->query('INSERT INTO campaigns (title, description, start_date, end_date, status) VALUES(:title, :description, :start_date, :end_date, :status)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);
        $this->db->bind(':status', $data['status']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCampaignById($id)
    {
        $this->db->query('SELECT * FROM campaigns WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateCampaign($data)
    {
        $this->db->query('UPDATE campaigns SET title = :title, description = :description, start_date = :start_date, end_date = :end_date, status = :status WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);
        $this->db->bind(':status', $data['status']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCampaign($id)
    {
        $this->db->query('DELETE FROM campaigns WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

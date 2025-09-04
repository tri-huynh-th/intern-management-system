<?php
class Role
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getRoles()
    {
        $this->db->query('SELECT * FROM roles ORDER BY id ASC');
        return $this->db->resultSet();
    }

    public function getRoleById($id)
    {
        $this->db->query('SELECT * FROM roles WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    // Potentially add methods for addRole, updateRole, deleteRole if needed in the future
}

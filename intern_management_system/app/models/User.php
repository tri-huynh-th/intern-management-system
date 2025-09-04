<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Register User
    public function register($data)
    {
    $this->db->query('INSERT INTO users (full_name, username, email, password, phone_number, address, role_id) 
                      VALUES (:full_name, :username, :email, :password, :phone_number, :address, :role_id)');
    
    $this->db->bind(':full_name', $data['full_name']);
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);
    $this->db->bind(':phone_number', $data['phone_number']);
    $this->db->bind(':address', $data['address']);
    $this->db->bind(':role_id', 5);

    return $this->db->execute();
    }

    // Login User
    public function login($username_or_email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username_or_email OR email = :username_or_email');
        $this->db->bind(':username_or_email', $username_or_email);

        $row = $this->db->single();

        if ($row) {
            $hashed_password = $row['password'];
            if (password_verify($password, $hashed_password)) {
                return $row;
            } else {
                return false;
            }
        }
        return false;
    }

    // Find user by ID
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
    //
        public function getRoleNameById($role_id)
    {
        $this->db->query("SELECT role_name FROM roles WHERE id = :id");
        $this->db->bind(':id', $role_id);
        $row = $this->db->single();

        if ($row) {
            return $row->role_name; // chú ý đổi đúng tên cột
        } else {
            return null;
        }
    }
    // Find user by email or username
    public function findUserByEmailOrUsername($username_or_email)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username_or_email OR email = :username_or_email');
        $this->db->bind(':username_or_email', $username_or_email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Get all users
    public function getUsers()
    {
        $this->db->query('SELECT users.*, roles.role_name FROM users JOIN roles ON users.role_id = roles.id ORDER BY users.created_at DESC');
        return $this->db->resultSet();
    }

    // Get all roles
    public function getRoles()
    {
        $this->db->query('SELECT * FROM roles');
        return $this->db->resultSet();
    }

    // Add User
    public function addUser($data)
    {
        $this->db->query('INSERT INTO users (full_name, phone_number, address, username, email, password, role_id) 
                  VALUES(:full_name, :phone_number, :address, :username, :email, :password, :role_id)');
        $this->db->bind(':full_name', $data['full_name']);
$this->db->bind(':phone_number', $data['phone_number']);
$this->db->bind(':address', $data['address']);
$this->db->bind(':username', $data['username']);
$this->db->bind(':email', $data['email']);
$this->db->bind(':password', $data['password']);
$this->db->bind(':role_id', $data['role_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Update User
    public function updateUser($data)
    {
        $this->db->query('UPDATE users SET full_name = :full_name, email = :email, role_id = :role_id WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role_id', $data['role_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete User
    public function deleteUser($id)
    {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Change User Password
    public function changeUserPassword($data)
    {
        $this->db->query('UPDATE users SET password = :new_password WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':new_password', $data['new_password']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
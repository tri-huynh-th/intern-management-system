<?php
// intern_management_system/controllers/AdminController.php

require_once 'config/database.php';
require_once 'models/UserModel.php';
require_once 'models/RoleModel.php';

class AdminController {
    private $userModel;
    private $roleModel;

    public function __construct($conn) {
        $this->userModel = new UserModel($conn);
        $this->roleModel = new RoleModel($conn);
    }

    public function manageUsers() {
        // Lấy danh sách tất cả người dùng
        $users = $this->userModel->getAllUsers();
        // Lấy danh sách tất cả các vai trò
        $roles = $this->roleModel->getAllRoles();
        
        // Hiển thị giao diện quản lý người dùng
        require_once '../views/admin/user_management.php';
    }

    public function editUser($user_id) {
        // Xử lý logic sửa thông tin người dùng
    }

    public function deleteUser($user_id) {
        // Xử lý logic xóa người dùng
    }
}
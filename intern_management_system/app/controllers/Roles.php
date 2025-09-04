<?php
class Roles extends Controller
{
    // protected $roleModel;

    public function __construct()
    {
        $this->roleModel = $this->model('Role');
    }

    public function index()
    {
        if (!isAdmin()) {
            $this->redirect('home/index');
        }

        $roles = $this->roleModel->getRoles();

        $data = [
            'roles' => $roles
        ];

        $this->view('roles/index', $data);
    }

    // Potentially add methods for add, edit, delete if role management becomes more complex
}
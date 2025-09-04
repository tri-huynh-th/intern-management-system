<?php
class Settings extends Controller
{
    public function __construct()
    {
        // Ensure user is logged in
        if (!isLoggedIn()) {
            $this->redirect('auth/login');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Settings',
            'description' => 'This is the settings page.'
        ];
        $this->view('settings/index', $data);
    }
}

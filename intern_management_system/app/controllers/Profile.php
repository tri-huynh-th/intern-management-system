<?php
class Profile extends Controller
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
            'title' => 'My Profile',
            'description' => 'This is the user profile page.'
        ];
        $this->view('profile/index', $data);
    }
}

<?php
class HelpAndSupport extends Controller
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
            'title' => 'Help and Support',
            'description' => 'This is the help and support page.'
        ];
        $this->view('helpandsupport/index', $data);
    }
}

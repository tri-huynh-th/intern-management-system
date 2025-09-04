<?php

class Auth extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'full_name' => trim($_POST['full_name'] ?? ''),
                'username' => trim($_POST['username'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'password' => trim($_POST['password'] ?? ''),
                'confirm_password' => trim($_POST['confirm_password'] ?? ''),
                'role_id' => trim($_POST['role_id'] ?? ''),
                'phone_number' => trim($_POST['phone_number'] ?? ''),
                'address' => trim($_POST['address'] ?? ''),
                'full_name_err' => '',
                'username_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'role_id_err' => ''
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Vui lòng nhập email';
            } elseif ($this->userModel->findUserByEmailOrUsername($data['email'])) {
                $data['email_err'] = 'Email này đã được sử dụng';
            }

            // Validate username
            if (empty($data['username'])) {
                $data['username_err'] = 'Vui lòng nhập tên người dùng';
            } elseif ($this->userModel->findUserByEmailOrUsername($data['username'])) {
                $data['username_err'] = 'Tên người dùng này đã được sử dụng';
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Vui lòng nhập mật khẩu';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            }

            // Confirm password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Vui lòng xác nhận mật khẩu';
            } elseif ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Mật khẩu không khớp';
            }

            // Nếu không có lỗi
            if (empty($data['email_err']) && empty($data['username_err']) &&
                empty($data['password_err']) && empty($data['confirm_password_err'])) {

                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->register($data)) {
                    $_SESSION['success_message'] = 'Bạn đã đăng ký thành công và có thể đăng nhập';
                    $this->redirect('auth/login');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                $this->view('auth/register', $data);
            }
        } else {
            $data = [
                'full_name' => '',
                'username' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'full_name_err' => '',
                'username_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            $this->view('auth/register', $data);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username'] ?? ''),
                'password' => trim($_POST['password'] ?? ''),
                'username_err' => '',
                'password_err' => ''
            ];

            if (empty($data['username'])) {
                $data['username_err'] = 'Vui lòng nhập tên người dùng hoặc email';
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'Vui lòng nhập mật khẩu';
            }

            if ($this->userModel->findUserByEmailOrUsername($data['username'])) {
                // user tồn tại
            } else {
                $data['username_err'] = 'Không tìm thấy người dùng';
            }

            if (empty($data['username_err']) && empty($data['password_err'])) {
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Mật khẩu không đúng';
                    $this->view('auth/login', $data);
                }
            } else {
                $this->view('auth/login', $data);
            }
        } else {
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];
            $this->view('auth/login', $data);
        }
    }

    public function createUserSession($user)
{
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role_id'] = $user['role_id'];
    $_SESSION['role_name'] = $this->getRoleNameById($user['role_id']);

    // Redirect theo role_id
    switch ($user['role_id']) {
        case 1: // Admin
        case 2: // HR
            $this->redirect('home/index');
            break;

        case 3: // Coordinator
            $this->redirect('trainingprograms');
            break;
        case 4: // Mentor
            $this->redirect('internfeedbacks');
            break;

        case 5: // Intern
            $this->redirect('internfeedbacks');
            break;

        default:
            $this->redirect('home/index'); // fallback
            break;
    }
}


    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['role_id']);
        unset($_SESSION['role_name']);
        session_destroy();
        $this->redirect('auth/login');
    }

    private function getRoleNameById($role_id)
    {
        $this->db = new Database();
        $this->db->query('SELECT role_name FROM roles WHERE id = :role_id');
        $this->db->bind(':role_id', $role_id);
        $row = $this->db->single();
        return $row['role_name'] ?? 'Unknown';
    }
}
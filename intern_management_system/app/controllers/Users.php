<?php
class Users extends Controller
{
    // protected $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        if (!isAdmin()) {
            $this->redirect('home/index');
        }

        $users = $this->userModel->getUsers();
        $roles = $this->userModel->getRoles();
        $data = [
            'users' => $users,
            'roles' => $roles
        ];

        $this->view('users/index', $data);
    }

    public function add()
    {
        if (!isAdmin()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'full_name' => trim($_POST['full_name']),
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'role_id' => trim($_POST['role_id']),
                'full_name_err' => '',
                'username_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'role_id_err' => '',
                'phone_number' => trim($_POST['phone_number'] ?? ''),
                'address' => trim($_POST['address'] ?? '')
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Vui lòng nhập email';
            } else {
                if ($this->userModel->findUserByEmailOrUsername($data['email'], '')) {
                    $data['email_err'] = 'Email đã được sử dụng';
                }
            }

            // Validate Username
            if (empty($data['username'])) {
                $data['username_err'] = 'Vui lòng nhập tên người dùng';
            } else {
                if ($this->userModel->findUserByEmailOrUsername('', $data['username'])) {
                    $data['username_err'] = 'Tên người dùng đã được sử dụng';
                }
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Vui lòng nhập mật khẩu';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Vui lòng xác nhận mật khẩu';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Mật khẩu xác nhận không khớp';
                }
            }

            // Validate Full Name
            if (empty($data['full_name'])) {
                $data['full_name_err'] = 'Vui lòng nhập họ và tên';
            }

            // Validate Role ID
            if (empty($data['role_id'])) {
                $data['role_id_err'] = 'Vui lòng chọn vai trò';
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['username_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['full_name_err']) && empty($data['role_id_err'])) {
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if ($this->userModel->addUser($data)) {
                    flash('user_message', 'Người dùng đã được thêm thành công');
                    $this->redirect('users');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                // Load view with errors
                $data['roles'] = $this->userModel->getRoles();
                $this->view('users/add', $data);
            }
        } else {
            $data = [
                'full_name' => '',
                'username' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'role_id' => '',
                'full_name_err' => '',
                'username_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'role_id_err' => ''
            ];
            $data['roles'] = $this->userModel->getRoles();
            $this->view('users/add', $data);
        }
    }

    public function edit($id)
    {
        if (!isAdmin()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'full_name' => trim($_POST['full_name']),
                'email' => trim($_POST['email']),
                'role_id' => trim($_POST['role_id']),
                'full_name_err' => '',
                'email_err' => '',
                'role_id_err' => ''
            ];

            // Validate Email
if (empty($data['email'])) {
    $data['email_err'] = 'Vui lòng nhập email';
} else {
    $currentUser = $this->userModel->getUserById($data['id']);
    if ($currentUser && $currentUser['email'] !== $data['email']) {
        // Chỉ check nếu email thay đổi
        $existingUser = $this->userModel->findUserByEmailOrUsername($data['email'], '');
        if ($existingUser && isset($existingUser['id']) && $existingUser['id'] != $data['id']) {
            $data['email_err'] = 'Email đã được sử dụng bởi người dùng khác';
        }
    }
}


            // Validate Full Name
            if (empty($data['full_name'])) {
                $data['full_name_err'] = 'Vui lòng nhập họ và tên';
            }

            // Validate Role ID
            if (empty($data['role_id'])) {
                $data['role_id_err'] = 'Vui lòng chọn vai trò';
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['full_name_err']) && empty($data['role_id_err'])) {
                if ($this->userModel->updateUser($data)) {
                    flash('user_message', 'Thông tin người dùng đã được cập nhật thành công');
                    $this->redirect('users');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                // Load view with errors
                $data['user'] = $this->userModel->getUserById($id);
                $data['roles'] = $this->userModel->getRoles();
                $this->view('users/edit', $data);
            }
        } else {
            $user = $this->userModel->getUserById($id);
            if (!$user) {
                $this->redirect('users');
            }

            $data = [
                'id' => $id,
                'full_name' => $user['full_name'],
                'username' => $user['username'], // Keep username for display, but not editable
                'email' => $user['email'],
                'role_id' => $user['role_id'],
                'full_name_err' => '',
                'email_err' => '',
                'role_id_err' => ''
            ];
            $data['roles'] = $this->userModel->getRoles();
            $this->view('users/edit', $data);
        }
    }

    public function delete($id)
    {
        if (!isAdmin()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->userModel->deleteUser($id)) {
                flash('user_message', 'Người dùng đã được xóa thành công');
                $this->redirect('users');
            } else {
                die('Có lỗi xảy ra');
            }
        } else {
            $this->redirect('users');
        }
    }

    public function details($id)
    {
        if (!isAdmin()) {
            $this->redirect('home/index');
        }

        $user = $this->userModel->getUserById($id);
        if (!$user) {
            $this->redirect('users');
        }
        $data = ['user' => $user];
        $this->view('users/details', $data);
    }

    public function changePassword($id)
    {
        if (!isAdmin()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'new_password' => trim($_POST['new_password']),
                'confirm_new_password' => trim($_POST['confirm_new_password']),
                'new_password_err' => '',
                'confirm_new_password_err' => ''
            ];

            // Validate New Password
            if (empty($data['new_password'])) {
                $data['new_password_err'] = 'Vui lòng nhập mật khẩu mới';
            } elseif (strlen($data['new_password']) < 6) {
                $data['new_password_err'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            }

            // Validate Confirm New Password
            if (empty($data['confirm_new_password'])) {
                $data['confirm_new_password_err'] = 'Vui lòng xác nhận mật khẩu mới';
            } else {
                if ($data['new_password'] != $data['confirm_new_password']) {
                    $data['confirm_new_password_err'] = 'Mật khẩu xác nhận không khớp';
                }
            }

            // Make sure errors are empty
            if (empty($data['new_password_err']) && empty($data['confirm_new_password_err'])) {
                // Hash Password
                $data['new_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);

                if ($this->userModel->changeUserPassword($data)) {
                    flash('user_message', 'Mật khẩu người dùng đã được thay đổi thành công');
                    $this->redirect('users');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                // Load view with errors
                $data['user'] = $this->userModel->getUserById($id);
                $this->view('users/change_password', $data);
            }
        } else {
            $user = $this->userModel->getUserById($id);
            if (!$user) {
                $this->redirect('users');
            }

            $data = [
                'id' => $id,
                'new_password' => '',
                'confirm_new_password' => '',
                'new_password_err' => '',
                'confirm_new_password_err' => ''
            ];
            $data['user'] = $user;
            $this->view('users/change_password', $data);
        }
    }
}
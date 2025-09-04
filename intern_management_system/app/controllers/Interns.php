<?php

class Interns extends Controller
{
    // private $internModel;
    // private $campaignModel;
    // private $userModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            $this->redirect('auth/login');
        }

        $this->internModel = $this->model('Intern');
        $this->userModel = $this->model('User');
        $this->campaignModel = $this->model('Campaign');
    }

    public function index()
    {
        if (!isAdmin() && !isHR()) {
            $this->redirect('home/index');
        }

        $interns = $this->internModel->getInterns();
        $data = [
            'interns' => $interns
        ];
        $this->view('interns/index', $data);
    }

    public function add()
    {
        if (!isAdmin() && !isHR()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => trim($_POST['user_id']),
                'campaign_id' => trim($_POST['campaign_id']),
                'gpa' => trim($_POST['gpa']),
                'university' => trim($_POST['university']),
                'major' => trim($_POST['major']),
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
                'status' => trim($_POST['status']),
                'user_id_err' => '',
                'gpa_err' => '',
                'university_err' => '',
                'major_err' => '',
                'start_date_err' => '',
                'end_date_err' => '',
            ];

            // Validate data
            if (empty($data['user_id'])) {
                $data['user_id_err'] = 'Vui lòng chọn người dùng';
            }
            if (empty($data['gpa'])) {
                $data['gpa_err'] = 'Vui lòng nhập GPA';
            }
            if (empty($data['university'])) {
                $data['university_err'] = 'Vui lòng nhập trường đại học';
            }
            if (empty($data['major'])) {
                $data['major_err'] = 'Vui lòng nhập chuyên ngành';
            }
            if (empty($data['start_date'])) {
                $data['start_date_err'] = 'Vui lòng nhập ngày bắt đầu';
            }
            if (empty($data['end_date'])) {
                $data['end_date_err'] = 'Vui lòng nhập ngày kết thúc';
            }

            // Make sure no errors
            if (empty($data['user_id_err']) && empty($data['gpa_err']) && empty($data['university_err']) && empty($data['major_err']) && empty($data['start_date_err']) && empty($data['end_date_err'])) {
                if ($this->internModel->addIntern($data)) {
                    flash('intern_message', 'Hồ sơ thực tập sinh đã được thêm');
                    $this->redirect('interns');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                // Get available users and campaigns again for the view
                $data['available_users'] = $this->internModel->getAvailableUsersForInterns();
                $data['campaigns'] = $this->campaignModel->getCampaigns();
                $this->view('interns/add', $data);
            }
        } else {
            // Get available users for interns (users with role_id 5 who are not already interns)
            $availableUsers = $this->internModel->getAvailableUsersForInterns();
            $campaigns = $this->campaignModel->getCampaigns();

            $data = [
                'user_id' => '',
                'campaign_id' => '',
                'gpa' => '',
                'university' => '',
                'major' => '',
                'start_date' => '',
                'end_date' => '',
                'status' => 'applied',
                'user_id_err' => '',
                'gpa_err' => '',
                'university_err' => '',
                'major_err' => '',
                'start_date_err' => '',
                'end_date_err' => '',
                'available_users' => $availableUsers,
                'campaigns' => $campaigns
            ];
            $this->view('interns/add', $data);
        }
    }

    public function edit($id)
    {
        if (!isAdmin() && !isHR()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'user_id' => trim($_POST['user_id']),
                'campaign_id' => trim($_POST['campaign_id']),
                'gpa' => trim($_POST['gpa']),
                'university' => trim($_POST['university']),
                'major' => trim($_POST['major']),
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
                'status' => trim($_POST['status']),
                'user_id_err' => '',
                'gpa_err' => '',
                'university_err' => '',
                'major_err' => '',
                'start_date_err' => '',
                'end_date_err' => '',
            ];

            // Validate data
            if (empty($data['user_id'])) {
                $data['user_id_err'] = 'Vui lòng chọn người dùng';
            }
            if (empty($data['gpa'])) {
                $data['gpa_err'] = 'Vui lòng nhập GPA';
            }
            if (empty($data['university'])) {
                $data['university_err'] = 'Vui lòng nhập trường đại học';
            }
            if (empty($data['major'])) {
                $data['major_err'] = 'Vui lòng nhập chuyên ngành';
            }
            if (empty($data['start_date'])) {
                $data['start_date_err'] = 'Vui lòng nhập ngày bắt đầu';
            }
            if (empty($data['end_date'])) {
                $data['end_date_err'] = 'Vui lòng nhập ngày kết thúc';
            }

            // Make sure no errors
            if (empty($data['user_id_err']) && empty($data['gpa_err']) && empty($data['university_err']) && empty($data['major_err']) && empty($data['start_date_err']) && empty($data['end_date_err'])) {
                if ($this->internModel->updateIntern($data)) {
                    flash('intern_message', 'Hồ sơ thực tập sinh đã được cập nhật');
                    $this->redirect('interns');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                // Get available users and campaigns again for the view
                $data['available_users'] = $this->internModel->getAvailableUsersForInterns(); // This might need to include the current intern's user if not explicitly excluded
                $data['campaigns'] = $this->campaignModel->getCampaigns();
                $this->view('interns/edit', $data);
            }
        } else {
            // Get existing intern from model
            $intern = $this->internModel->getInternById($id);

            if (!$intern) {
                $this->redirect('interns');
            }

            // Get available users and campaigns
            $availableUsers = $this->internModel->getAvailableUsersForInterns();
            $campaigns = $this->campaignModel->getCampaigns();

            // Include the current intern's user in available users if they are not already listed
            $currentUserInAvailable = false;
            foreach ($availableUsers as $user) {
                if ($user['id'] == $intern['user_id']) {
                    $currentUserInAvailable = true;
                    break;
                }
            }
            if (!$currentUserInAvailable) {
                // Fetch current intern's user details
                $currentUser = $this->userModel->getUserById($intern['user_id']); // Assuming a method getUserById in UserModel
                if ($currentUser) {
                    array_unshift($availableUsers, ['id' => $currentUser['id'], 'full_name' => $currentUser['full_name'], 'email' => $currentUser['email']]);
                }
            }

            $data = [
                'id' => $id,
                'user_id' => $intern['user_id'],
                'campaign_id' => $intern['campaign_id'],
                'gpa' => $intern['gpa'],
                'university' => $intern['university'],
                'major' => $intern['major'],
                'start_date' => $intern['start_date'],
                'end_date' => $intern['end_date'],
                'status' => $intern['status'],
                'user_id_err' => '',
                'gpa_err' => '',
                'university_err' => '',
                'major_err' => '',
                'start_date_err' => '',
                'end_date_err' => '',
                'available_users' => $availableUsers,
                'campaigns' => $campaigns
            ];
            $this->view('interns/edit', $data);
        }
    }

    public function delete($id)
    {
        if (!isAdmin() && !isHR()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get existing intern from model
            $intern = $this->internModel->getInternById($id);

            if (!$intern) {
                $this->redirect('interns');
            }

            if ($this->internModel->deleteIntern($id)) {
                flash('intern_message', 'Hồ sơ thực tập sinh đã được xóa');
                $this->redirect('interns');
            } else {
                die('Có lỗi xảy ra');
            }
        } else {
            $this->redirect('interns');
        }
    }

    public function details($id)
    {
        if (!isAdmin() && !isHR() && !isCoordinator() && !isMentor() && !isIntern()) {
            $this->redirect('home/index');
        }

        // An intern can only view their own profile
        if (isIntern() && $_SESSION['user_id'] != $this->internModel->getInternById($id)['user_id']) {
            $this->redirect('interns/dashboard'); // Redirect to their own dashboard or restricted access page
        }

        $intern = $this->internModel->getInternById($id);

        if (!$intern) {
            $this->redirect('interns');
        }

        $data = [
            'intern' => $intern
        ];

        $this->view('interns/details', $data);
    }
}
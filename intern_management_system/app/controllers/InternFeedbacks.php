<?php

class InternFeedbacks extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            $this->redirect('auth/login');
        }

        $this->internFeedbackModel = $this->model('InternFeedback');
        $this->internModel = $this->model('Intern');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        if (!isAdmin() && !isHR() && !isCoordinator() && !isMentor() && !isIntern()) {
            $this->redirect('home/index');
        }

        $internFeedbacks = $this->internFeedbackModel->getInternFeedback();
        $data = [
            'intern_feedbacks' => $internFeedbacks
        ];
        $this->view('feedbacks/index', $data);
    }

    public function add()
    {
        if (!isAdmin() && !isHR() && !isCoordinator() && !isMentor() && !isIntern()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'intern_id' => trim($_POST['intern_id']),
                'feedback_provider_id' => $_SESSION['user_id'],
                'feedback_type' => trim($_POST['feedback_type']),
                'feedback_date' => trim($_POST['feedback_date']),
                'feedback_content' => trim($_POST['feedback_content']),
                'intern_id_err' => '',
                'feedback_type_err' => '',
                'feedback_date_err' => '',
                'feedback_content_err' => '',
            ];

            // Validate data
            if (empty($data['intern_id'])) {
                $data['intern_id_err'] = 'Vui lòng chọn thực tập sinh';
            }
            if (empty($data['feedback_type'])) {
                $data['feedback_type_err'] = 'Vui lòng chọn loại phản hồi';
            }
            if (empty($data['feedback_date'])) {
                $data['feedback_date_err'] = 'Vui lòng nhập ngày phản hồi';
            }
            if (empty($data['feedback_content'])) {
                $data['feedback_content_err'] = 'Vui lòng nhập nội dung phản hồi';
            }

            // Make sure no errors
            if (empty($data['intern_id_err']) && empty($data['feedback_type_err']) && empty($data['feedback_date_err']) && empty($data['feedback_content_err'])) {
                if ($this->internFeedbackModel->addInternFeedback($data)) {
                    flash('feedback_message', 'Phản hồi đã được thêm');
                    $this->redirect('internfeedbacks');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                $data['interns'] = $this->internModel->getInterns(); // Get all interns for selection
                $this->view('feedbacks/add', $data);
            }
        } else {
            $interns = $this->internModel->getInternsForFeedback();

            $data = [
                'intern_id' => '',
                'feedback_provider_id' => '',
                'feedback_type' => '',
                'feedback_date' => date('Y-m-d'),
                'feedback_content' => '',
                'intern_id_err' => '',
                'feedback_type_err' => '',
                'feedback_date_err' => '',
                'feedback_content_err' => '',
                'interns' => $interns
            ];
            $this->view('feedbacks/add', $data);
        }
    }

    public function edit($id)
    {
        if (!isAdmin() && !isHR() && !isCoordinator() && !isMentor() && !isIntern()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'intern_id' => trim($_POST['intern_id']),
                'feedback_provider_id' => $_SESSION['user_id'],
                'feedback_type' => trim($_POST['feedback_type']),
                'feedback_date' => trim($_POST['feedback_date']),
                'feedback_content' => trim($_POST['feedback_content']),
                'intern_id_err' => '',
                'feedback_type_err' => '',
                'feedback_date_err' => '',
                'feedback_content_err' => '',
            ];

            // Validate data
            if (empty($data['intern_id'])) {
                $data['intern_id_err'] = 'Vui lòng chọn thực tập sinh';
            }
            if (empty($data['feedback_type'])) {
                $data['feedback_type_err'] = 'Vui lòng chọn loại phản hồi';
            }
            if (empty($data['feedback_date'])) {
                $data['feedback_date_err'] = 'Vui lòng nhập ngày phản hồi';
            }
            if (empty($data['feedback_content'])) {
                $data['feedback_content_err'] = 'Vui lòng nhập nội dung phản hồi';
            }

            // Make sure no errors
            if (empty($data['intern_id_err']) && empty($data['feedback_type_err']) && empty($data['feedback_date_err']) && empty($data['feedback_content_err'])) {
                if ($this->internFeedbackModel->updateInternFeedback($data)) {
                    flash('feedback_message', 'Phản hồi đã được cập nhật');
                    $this->redirect('internfeedbacks');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                $data['interns'] = $this->internModel->getInterns(); // Get all interns for selection
                $this->view('feedbacks/edit', $data);
            }
        } else {
            // Get existing feedback from model
            $feedback = $this->internFeedbackModel->getInternFeedbackById($id);

            if (!$feedback) {
                $this->redirect('internfeedbacks');
            }

            $interns = $this->internModel->getInternsForFeedback();



            $data = [
                'id' => $id,
                'intern_id' => $feedback['intern_id'],
                'feedback_provider_id' => $feedback['feedback_provider_id'],
                'feedback_type' => $feedback['feedback_type'],
                'feedback_date' => $feedback['feedback_date'],
                'feedback_content' => $feedback['feedback_content'],
                'intern_id_err' => '',
                'feedback_type_err' => '',
                'feedback_date_err' => '',
                'feedback_content_err' => '',
                'interns' => $interns
            ];
            $this->view('feedbacks/edit', $data);
        }
    }

    public function delete($id)
    {
        if (!isAdmin() && !isHR() && !isCoordinator() && !isMentor() && !isIntern()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get existing feedback from model
            $feedback = $this->internFeedbackModel->getInternFeedbackById($id);

            if (!$feedback) {
                $this->redirect('internfeedbacks');
            }

            if ($this->internFeedbackModel->deleteInternFeedback($id)) {
                flash('feedback_message', 'Phản hồi đã được xóa');
                $this->redirect('internfeedbacks');
            } else {
                die('Có lỗi xảy ra');
            }
        }
        $this->redirect('internfeedbacks');
    }

    public function internFeedbackDashboard()
    {
        if (!isIntern()) {
            $this->redirect('home/index');
        }

        $intern = $this->internModel->getInternByUserId($_SESSION['user_id']); // Assuming getInternByUserId method exists in InternModel

        if (!$intern) {
            die('Không tìm thấy hồ sơ thực tập sinh cho người dùng này.');
        }

        $feedbackList = $this->internFeedbackModel->getFeedbackByInternId($intern['id']);

        $data = [
            'intern' => $intern,
            'feedback_list' => $feedbackList
        ];
        $this->view('feedbacks/intern_dashboard', $data);
    }
    public function details($id)
    {
    if (!isAdmin() && !isHR() && !isCoordinator() && !isMentor() && !isIntern()) {
        $this->redirect('home/index');
    }

    $feedback = $this->internFeedbackModel->getInternFeedbackById($id);

    if (!$feedback) {
        flash('feedback_message', 'Không tìm thấy phản hồi');
        $this->redirect('internfeedbacks');
    }

    $data = [
        'intern_feedback' => $feedback
    ];

    $this->view('feedbacks/details', $data);
    }

}
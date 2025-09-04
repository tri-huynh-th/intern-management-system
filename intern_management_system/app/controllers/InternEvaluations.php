<?php

class InternEvaluations extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            $this->redirect('auth/login');
        }

        $this->internEvaluationModel = $this->model('InternEvaluation');
        $this->internModel = $this->model('Intern');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        if (!isAdmin() && !isHR() && !isCoordinator() && !isMentor()) {
            $this->redirect('home/index');
        }

        $internEvaluations = $this->internEvaluationModel->getInternEvaluations();
        $data = [
            'intern_evaluations' => $internEvaluations
        ];
        $this->view('evaluations/index', $data);
    }

    public function add()
    {
        if (!isAdmin() && !isHR() && !isCoordinator() && !isMentor()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'intern_id' => trim($_POST['intern_id']),
                'evaluator_id' => $_SESSION['user_id'], // The logged in user is the evaluator
                'evaluation_date' => trim($_POST['evaluation_date']),
                'overall_rating' => trim($_POST['overall_rating']),
                'comments' => trim($_POST['comments']),
                'intern_id_err' => '',
                'evaluation_date_err' => '',
                'overall_rating_err' => '',
            ];

            // Validate data
            if (empty($data['intern_id'])) {
                $data['intern_id_err'] = 'Vui lòng chọn thực tập sinh';
            }
            if (empty($data['evaluation_date'])) {
                $data['evaluation_date_err'] = 'Vui lòng nhập ngày đánh giá';
            }
            if (empty($data['overall_rating'])) {
                $data['overall_rating_err'] = 'Vui lòng nhập điểm đánh giá tổng thể';
            } elseif (!is_numeric($data['overall_rating']) || $data['overall_rating'] < 1 || $data['overall_rating'] > 5) {
                $data['overall_rating_err'] = 'Điểm đánh giá phải từ 1 đến 5';
            }

            // Make sure no errors
            if (empty($data['intern_id_err']) && empty($data['evaluation_date_err']) && empty($data['overall_rating_err'])) {
                if ($this->internEvaluationModel->addInternEvaluation($data)) {
                    flash('evaluation_message', 'Đánh giá đã được thêm');
                    $this->redirect('internevaluations');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                // Get interns again for the view
                $data['interns'] = $this->internModel->getInterns();
                $this->view('evaluations/add', $data);
            }
        } else {
            $interns = $this->internModel->getInterns();



            $data = [
                'intern_id' => '',
                'evaluator_id' => '',
                'evaluation_date' => date('Y-m-d'),
                'overall_rating' => '',
                'comments' => '',
                'intern_id_err' => '',
                'evaluation_date_err' => '',
                'overall_rating_err' => '',
                'interns' => $interns
            ];
            $this->view('evaluations/add', $data);
        }
    }

    public function edit($id)
    {
        if (!isAdmin() && !isHR() && !isCoordinator() && !isMentor()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'intern_id' => trim($_POST['intern_id']),
                'evaluator_id' => $_SESSION['user_id'], // The logged in user is the evaluator
                'evaluation_date' => trim($_POST['evaluation_date']),
                'overall_rating' => trim($_POST['overall_rating']),
                'comments' => trim($_POST['comments']),
                'intern_id_err' => '',
                'evaluation_date_err' => '',
                'overall_rating_err' => '',
            ];

            // Validate data
            if (empty($data['intern_id'])) {
                $data['intern_id_err'] = 'Vui lòng chọn thực tập sinh';
            }
            if (empty($data['evaluation_date'])) {
                $data['evaluation_date_err'] = 'Vui lòng nhập ngày đánh giá';
            }
            if (empty($data['overall_rating'])) {
                $data['overall_rating_err'] = 'Vui lòng nhập điểm đánh giá tổng thể';
            } elseif (!is_numeric($data['overall_rating']) || $data['overall_rating'] < 1 || $data['overall_rating'] > 5) {
                $data['overall_rating_err'] = 'Điểm đánh giá phải từ 1 đến 5';
            }

            // Make sure no errors
            if (empty($data['intern_id_err']) && empty($data['evaluation_date_err']) && empty($data['overall_rating_err'])) {
                if ($this->internEvaluationModel->updateInternEvaluation($data)) {
                    flash('evaluation_message', 'Đánh giá đã được cập nhật');
                    $this->redirect('internevaluations');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                // Get interns again for the view
                $data['interns'] = $this->internModel->getInterns();
                $this->view('evaluations/edit', $data);
            }
        } else {
            // Get existing evaluation from model
            $evaluation = $this->internEvaluationModel->getInternEvaluationById($id);

            if (!$evaluation) {
                $this->redirect('internevaluations');
            }

            $interns = $this->internModel->getInterns();



            $data = [
                'id' => $id,
                'intern_id' => $evaluation['intern_id'],
                'evaluator_id' => $evaluation['evaluator_id'],
                'evaluation_date' => $evaluation['evaluation_date'],
                'overall_rating' => $evaluation['overall_rating'],
                'comments' => $evaluation['comments'],
                'intern_id_err' => '',
                'evaluation_date_err' => '',
                'overall_rating_err' => '',
                'interns' => $interns
            ];
            $this->view('evaluations/edit', $data);
        }
    }

    public function delete($id)
    {
        if (!isAdmin() && !isHR() && !isCoordinator() && !isMentor()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get existing evaluation from model
            $evaluation = $this->internEvaluationModel->getInternEvaluationById($id);

            if (!$evaluation) {
                $this->redirect('internevaluations');
            }

            if ($this->internEvaluationModel->deleteInternEvaluation($id)) {
                flash('evaluation_message', 'Đánh giá đã được xóa');
                $this->redirect('internevaluations');
            } else {
                die('Có lỗi xảy ra');
            }
        } else {
            $this->redirect('internevaluations');
        }
    }

    public function details($id)
    {
        if (!isAdmin() && !isHR() && !isCoordinator() && !isMentor() && !isIntern()) {
            $this->redirect('home/index');
        }

        $evaluation = $this->internEvaluationModel->getInternEvaluationById($id);

        if (!$evaluation) {
            $this->redirect('internevaluations');
        }

        $data = [
            'evaluation' => $evaluation
        ];

        $this->view('evaluations/details', $data);
    }
}
<?php

class TrainingPrograms extends Controller
{
    // private $internModel;
    // private $trainingProgramModel;
    // private $userModel;
    public function __construct()
    {
        if (!isLoggedIn()) {
            $this->redirect('auth/login');
        }

        $this->trainingProgramModel = $this->model('TrainingProgram');
        $this->userModel = $this->model('User');
        $this->internModel = $this->model('Intern');
    }

    public function index()
    {
        if (!isAdmin() && !isHR() && !isCoordinator()) {
            $this->redirect('home/index');
        }

        $trainingPrograms = $this->trainingProgramModel->getTrainingPrograms();
        $data = [
            'training_programs' => $trainingPrograms
        ];
        $this->view('programs/index', $data);
    }

    public function add()
    {
        if (!isAdmin() && !isHR() && !isCoordinator()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
                'coordinator_id' => trim($_POST['coordinator_id']),
                'status' => trim($_POST['status']),
                'title_err' => '',
                'start_date_err' => '',
                'end_date_err' => '',
                'coordinator_id_err' => '',
            ];

            // Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Vui lòng nhập tiêu đề chương trình';
            }
            if (empty($data['start_date'])) {
                $data['start_date_err'] = 'Vui lòng nhập ngày bắt đầu';
            }
            if (empty($data['end_date'])) {
                $data['end_date_err'] = 'Vui lòng nhập ngày kết thúc';
            }
            if (empty($data['coordinator_id'])) {
                $data['coordinator_id_err'] = 'Vui lòng chọn điều phối viên';
            }

            // Make sure no errors
            if (empty($data['title_err']) && empty($data['start_date_err']) && empty($data['end_date_err']) && empty($data['coordinator_id_err'])) {
                if ($this->trainingProgramModel->addTrainingProgram($data)) {
                    flash('program_message', 'Chương trình đào tạo đã được thêm');
                    $this->redirect('trainingprograms');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                // Get coordinators again for the view
                $data['coordinators'] = $this->trainingProgramModel->getCoordinators();
                $this->view('programs/add', $data);
            }
        } else {
            $coordinators = $this->trainingProgramModel->getCoordinators();

            $data = [
                'title' => '',
                'description' => '',
                'start_date' => '',
                'end_date' => '',
                'coordinator_id' => '',
                'status' => 'planned',
                'title_err' => '',
                'start_date_err' => '',
                'end_date_err' => '',
                'coordinator_id_err' => '',
                'coordinators' => $coordinators
            ];
            $this->view('programs/add', $data);
        }
    }

    public function edit($id)
    {
        if (!isAdmin() && !isHR() && !isCoordinator()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
                'coordinator_id' => trim($_POST['coordinator_id']),
                'status' => trim($_POST['status']),
                'title_err' => '',
                'start_date_err' => '',
                'end_date_err' => '',
                'coordinator_id_err' => '',
            ];

            // Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Vui lòng nhập tiêu đề chương trình';
            }
            if (empty($data['start_date'])) {
                $data['start_date_err'] = 'Vui lòng nhập ngày bắt đầu';
            }
            if (empty($data['end_date'])) {
                $data['end_date_err'] = 'Vui lòng nhập ngày kết thúc';
            }
            if (empty($data['coordinator_id'])) {
                $data['coordinator_id_err'] = 'Vui lòng chọn điều phối viên';
            }

            // Make sure no errors
            if (empty($data['title_err']) && empty($data['start_date_err']) && empty($data['end_date_err']) && empty($data['coordinator_id_err'])) {
                if ($this->trainingProgramModel->updateTrainingProgram($data)) {
                    flash('program_message', 'Chương trình đào tạo đã được cập nhật');
                    $this->redirect('trainingprograms');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                // Get coordinators again for the view
                $data['coordinators'] = $this->trainingProgramModel->getCoordinators();
                $this->view('programs/edit', $data);
            }
        } else {
            // Get existing training program from model
            $program = $this->trainingProgramModel->getTrainingProgramById($id);

            if (!$program) {
                $this->redirect('trainingprograms');
            }

            $coordinators = $this->trainingProgramModel->getCoordinators();

            $data = [
                'id' => $id,
                'title' => $program['title'],
                'description' => $program['description'],
                'start_date' => $program['start_date'],
                'end_date' => $program['end_date'],
                'coordinator_id' => $program['coordinator_id'],
                'status' => $program['status'],
                'title_err' => '',
                'start_date_err' => '',
                'end_date_err' => '',
                'coordinator_id_err' => '',
                'coordinators' => $coordinators
            ];
            $this->view('programs/edit', $data);
        }
    }

    public function delete($id)
    {
        if (!isAdmin() && !isHR() && !isCoordinator()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get existing training program from model
            $program = $this->trainingProgramModel->getTrainingProgramById($id);

            if (!$program) {
                $this->redirect('trainingprograms');
            }

            if ($this->trainingProgramModel->deleteTrainingProgram($id)) {
                flash('program_message', 'Chương trình đào tạo đã được xóa');
                $this->redirect('trainingprograms');
            } else {
                die('Có lỗi xảy ra');
            }
        } else {
            $this->redirect('trainingprograms');
        }
    }

    public function details($id)
    {
        if (!isAdmin() && !isHR() && !isCoordinator() && !isMentor() && !isIntern()) {
            $this->redirect('home/index');
        }

        $program = $this->trainingProgramModel->getTrainingProgramById($id);
        $internsInProgram = $this->trainingProgramModel->getInternsInProgram($id);
        $internsNotInProgram = $this->trainingProgramModel->getInternsNotInProgram($id);

        if (!$program) {
            $this->redirect('trainingprograms');
        }

        $data = [
            'program' => $program,
            'interns_in_program' => $internsInProgram,
            'interns_not_in_program' => $internsNotInProgram
        ];

        $this->view('programs/details', $data);
    }

    public function addIntern($program_id)
    {
    if (!isAdmin() && !isHR() && !isCoordinator()) {
        $this->redirect('home/index');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $intern_id = trim($_POST['intern_id'] ?? '');

        // ✅ Kiểm tra nếu chưa chọn intern
        if (empty($intern_id)) {
            flash('program_message', 'Vui lòng chọn thực tập sinh trước khi thêm');
            $this->redirect('trainingprograms/details/' . $program_id);
            return;
        }

        if ($this->trainingProgramModel->addInternToProgram($program_id, $intern_id)) {
            flash('program_message', 'Thực tập sinh đã được thêm vào chương trình');
        } else {
            flash('program_message', 'Không thể thêm thực tập sinh. Vui lòng thử lại.');
        }

        $this->redirect('trainingprograms/details/' . $program_id);
    } else {
        $this->redirect('trainingprograms/details/' . $program_id);
    }
    }

    public function removeIntern($program_id, $intern_id)
    {
        if (!isAdmin() && !isHR() && !isCoordinator()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->trainingProgramModel->removeInternFromProgram($program_id, $intern_id)) {
                flash('program_message', 'Thực tập sinh đã được xóa khỏi chương trình');
                $this->redirect('trainingprograms/details/' . $program_id);
            } else {
                die('Có lỗi xảy ra');
            }
        }
        $this->redirect('trainingprograms/details/' . $program_id);
    }
}
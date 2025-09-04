<?php
class InterviewSchedules extends Controller
{
     public function __construct()
    {
        if (!isLoggedIn()) {
            $this->redirect('auth/login');
        }

        $this->interviewScheduleModel = $this->model('InterviewSchedule');
        $this->internModel = $this->model('Intern');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        if (!isAdmin() && !isHR() && !isCoordinator() && !isMentor()) {
            $this->redirect('home/index');
        }

        $data = [
            'interview_schedules' => $this->interviewScheduleModel->getInterviewSchedules()
        ];

        $this->view('interviews/index', $data);
    }

    public function add()
    {
        if (!isAdmin() && !isHR() && !isCoordinator()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'intern_id' => trim($_POST['intern_id']),
                'interviewer_id' => trim($_POST['interviewer_id']),
                'interview_date' => trim($_POST['interview_date']),
                'location' => trim($_POST['location']),
                'status' => trim($_POST['status']),
                'notes' => trim($_POST['notes']),
                'intern_id_err' => '',
                'interviewer_id_err' => '',
                'interview_date_err' => '',
            ];

            // Validate
            if (empty($data['intern_id'])) {
                $data['intern_id_err'] = 'Vui lòng chọn thực tập sinh';
            }
            if (empty($data['interviewer_id'])) {
                $data['interviewer_id_err'] = 'Vui lòng chọn người phỏng vấn';
            }
            if (empty($data['interview_date'])) {
                $data['interview_date_err'] = 'Vui lòng nhập ngày và giờ phỏng vấn';
            }

            if (empty($data['intern_id_err']) && empty($data['interviewer_id_err']) && empty($data['interview_date_err'])) {
                if ($this->interviewScheduleModel->addInterviewSchedule($data)) {
                    flash('interview_message', 'Lịch phỏng vấn đã được thêm');
                    $this->redirect('interviewschedules');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                $data['interns'] = $this->internModel->getAllInternUsers();
                $data['interviewers'] = $this->interviewScheduleModel->getInterviewers();
                $this->view('interviews/add', $data);
            }
        } else {
            $data = [
                'intern_id' => '',
                'interviewer_id' => '',
                'interview_date' => '',
                'location' => '',
                'status' => 'scheduled',
                'notes' => '',
                'intern_id_err' => '',
                'interviewer_id_err' => '',
                'interview_date_err' => '',
                'interns' => $this->internModel->getAllInternUsers(),
                'interviewers' => $this->interviewScheduleModel->getInterviewers()
            ];
            $this->view('interviews/add', $data);
        }
    }

    public function edit($id)
    {
        if (!isAdmin() && !isHR() && !isCoordinator()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'intern_id' => trim($_POST['intern_id']),
                'interviewer_id' => trim($_POST['interviewer_id']),
                'interview_date' => trim($_POST['interview_date']),
                'location' => trim($_POST['location']),
                'status' => trim($_POST['status']),
                'notes' => trim($_POST['notes']),
                'intern_id_err' => '',
                'interviewer_id_err' => '',
                'interview_date_err' => '',
            ];

            // Validate data
            if (empty($data['intern_id'])) {
                $data['intern_id_err'] = 'Vui lòng chọn thực tập sinh';
            }
            if (empty($data['interviewer_id'])) {
                $data['interviewer_id_err'] = 'Vui lòng chọn người phỏng vấn';
            }
            if (empty($data['interview_date'])) {
                $data['interview_date_err'] = 'Vui lòng nhập ngày và giờ phỏng vấn';
            }

            // Make sure no errors
            if (empty($data['intern_id_err']) && empty($data['interviewer_id_err']) && empty($data['interview_date_err'])) {
                if ($this->interviewScheduleModel->updateInterviewSchedule($data)) {
                    flash('interview_message', 'Lịch phỏng vấn đã được cập nhật');
                    $this->redirect('interviewschedules');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                // Get interns and interviewers again for the view
                $data['interns'] = $this->internModel->getInterns();
                $data['interviewers'] = $this->interviewScheduleModel->getInterviewers();
                $this->view('interviews/edit', $data);
            }
        } else {
            // Get existing interview schedule from model
            $interviewSchedule = $this->interviewScheduleModel->getInterviewScheduleById($id);

            // Check if schedule exists
            if (!$interviewSchedule) {
                $this->redirect('interviewschedules');
            }

            $interns = $this->internModel->getAllInternUsers();

            $interviewers = $this->interviewScheduleModel->getInterviewers();

            $data = [
                'id' => $id,
                'intern_id' => $interviewSchedule['intern_id'],
                'interviewer_id' => $interviewSchedule['interviewer_id'],
                'interview_date' => $interviewSchedule['interview_date'],
                'location' => $interviewSchedule['location'],
                'status' => $interviewSchedule['status'],
                'notes' => $interviewSchedule['notes'],
                'intern_id_err' => '',
                'interviewer_id_err' => '',
                'interview_date_err' => '',
                'interns' => $interns,
                'interviewers' => $interviewers
            ];

            $this->view('interviews/edit', $data);
        }
    }

    public function delete($id)
    {
        if (!isAdmin() && !isHR() && !isCoordinator()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get existing interview schedule from model
            $interviewSchedule = $this->interviewScheduleModel->getInterviewScheduleById($id);

            // Check if schedule exists
            if (!$interviewSchedule) {
                $this->redirect('interviewschedules');
            }

            if ($this->interviewScheduleModel->deleteInterviewSchedule($id)) {
                flash('interview_message', 'Lịch phỏng vấn đã được xóa');
                $this->redirect('interviewschedules');
            } else {
                die('Có lỗi xảy ra');
            }
        } else {
            $this->redirect('interviewschedules');
        }
    }

    public function details($id)
    {
        if (!isAdmin() && !isHR() && !isCoordinator() && !isMentor() && !isIntern()) {
            $this->redirect('home/index');
        }

        $interviewSchedule = $this->interviewScheduleModel->getInterviewScheduleById($id);

        if (!$interviewSchedule) {
            $this->redirect('interviewschedules');
        }

        $data = [
            'interview_schedule' => $interviewSchedule
        ];

        $this->view('interviews/details', $data);
    }
}
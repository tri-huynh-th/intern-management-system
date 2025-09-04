<?php

class Campaigns extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            $this->redirect('auth/login');
        }

        $this->campaignModel = $this->model('Campaign');
    }

    public function index()
    {
        if (!isAdmin() && !isHR()) {
            $this->redirect('home/index');
        }

        $campaigns = $this->campaignModel->getCampaigns();
        $data = [
            'campaigns' => $campaigns
        ];
        $this->view('campaigns/index', $data);
    }

    public function add()
    {
        if (!isAdmin() && !isHR()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
                'status' => trim($_POST['status']),
                'title_err' => '',
                'start_date_err' => '',
                'end_date_err' => '',
            ];

            // Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Vui lòng nhập tiêu đề chiến dịch';
            }
            if (empty($data['start_date'])) {
                $data['start_date_err'] = 'Vui lòng nhập ngày bắt đầu';
            }
            if (empty($data['end_date'])) {
                $data['end_date_err'] = 'Vui lòng nhập ngày kết thúc';
            }

            // Make sure no errors
            if (empty($data['title_err']) && empty($data['start_date_err']) && empty($data['end_date_err'])) {
                if ($this->campaignModel->addCampaign($data)) {
                    flash('campaign_message', 'Chiến dịch đã được thêm');
                    $this->redirect('campaigns');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                // Load view with errors
                $this->view('campaigns/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'description' => '',
                'start_date' => '',
                'end_date' => '',
                'status' => 'open',
                'title_err' => '',
                'start_date_err' => '',
                'end_date_err' => '',
            ];
            $this->view('campaigns/add', $data);
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
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
                'status' => trim($_POST['status']),
                'title_err' => '',
                'start_date_err' => '',
                'end_date_err' => '',
            ];

            // Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Vui lòng nhập tiêu đề chiến dịch';
            }
            if (empty($data['start_date'])) {
                $data['start_date_err'] = 'Vui lòng nhập ngày bắt đầu';
            }
            if (empty($data['end_date'])) {
                $data['end_date_err'] = 'Vui lòng nhập ngày kết thúc';
            }

            // Make sure no errors
            if (empty($data['title_err']) && empty($data['start_date_err']) && empty($data['end_date_err'])) {
                if ($this->campaignModel->updateCampaign($data)) {
                    flash('campaign_message', 'Chiến dịch đã được cập nhật');
                    $this->redirect('campaigns');
                } else {
                    die('Có lỗi xảy ra');
                }
            } else {
                // Load view with errors
                $this->view('campaigns/edit', $data);
            }
        } else {
            // Get existing campaign from model
            $campaign = $this->campaignModel->getCampaignById($id);

            // Check for owner
            // if ($campaign->user_id != $_SESSION['user_id']) {
            //     $this->redirect('campaigns');
            // }

            $data = [
                'id' => $id,
                'title' => $campaign['title'],
                'description' => $campaign['description'],
                'start_date' => $campaign['start_date'],
                'end_date' => $campaign['end_date'],
                'status' => $campaign['status'],
                'title_err' => '',
                'start_date_err' => '',
                'end_date_err' => '',
            ];
            $this->view('campaigns/edit', $data);
        }
    }

    public function delete($id)
    {
        if (!isAdmin() && !isHR()) {
            $this->redirect('home/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get existing campaign from model
            $campaign = $this->campaignModel->getCampaignById($id);

            // Check for owner
            // if ($campaign->user_id != $_SESSION['user_id']) {
            //     $this->redirect('campaigns');
            // }

            if ($this->campaignModel->deleteCampaign($id)) {
                flash('campaign_message', 'Chiến dịch đã được xóa');
                $this->redirect('campaigns');
            } else {
                die('Có lỗi xảy ra');
            }
        } else {
            $this->redirect('campaigns');
        }
    }

    public function details($id)
    {
        if (!isLoggedIn()) {
            $this->redirect('auth/login');
        }

        $campaign = $this->campaignModel->getCampaignById($id);

        if (!$campaign) {
            $this->redirect('campaigns');
        }

        $data = [
            'campaign' => $campaign
        ];

        $this->view('campaigns/details', $data);
    }
}
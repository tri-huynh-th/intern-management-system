<?php

class Reports extends Controller
{
    // private $reportModel;
    public function __construct()
    {
        if (!isLoggedIn()) {
            $this->redirect('auth/login');
        }

        if (!isAdmin() && !isHR()) {
            $this->redirect('home/index');
        }

        $this->reportModel = $this->model('Report');
    }

    public function index()
    {
        $this->view('reports/index');
    }

    public function campaignPerformance()
    {
        $campaignPerformance = $this->reportModel->getCampaignPerformanceReport();
        $data = [
            'campaign_performance' => $campaignPerformance
        ];
        $this->view('reports/campaign_performance', $data);
    }

    public function internPerformance()
    {
        $internPerformance = $this->reportModel->getInternPerformanceReport();
        $data = [
            'intern_performance' => $internPerformance
        ];
        $this->view('reports/intern_performance', $data);
    }
}
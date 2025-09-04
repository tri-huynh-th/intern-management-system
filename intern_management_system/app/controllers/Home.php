<?php
class Home extends Controller
{
    protected $dashboardModel;

    public function __construct()
    {
        $this->dashboardModel = $this->model('Dashboard');
    }

    public function index()
    {
        if (!isLoggedIn()) {
            $this->redirect('auth/login');
        }

        // --- Dashboard data ---
        $activeInterns = $this->dashboardModel->getActiveInternCount();

        // Training programs
        $totalTrainingPrograms = $this->dashboardModel->getTotalTrainingProgramsCount();
        $completedTrainingPrograms = $this->dashboardModel->getCompletedTrainingProgramsCount();
        $remainingTrainingPrograms = $this->dashboardModel->getRemainingTrainingProgramsCount();

        // Tasks
        $completedTasks = $this->dashboardModel->getCompletedTasksCount();
        $totalTasks = $this->dashboardModel->getTotalTasksCount();
        $pendingTasks = $this->dashboardModel->getPendingTasksCount();
        $notStartedTasks = $this->dashboardModel->getNotStartedTasksCount();

        // Task completion %
        $taskCompletionRate = $totalTasks > 0 
            ? round(($completedTasks / $totalTasks) * 100) 
            : 0;

        // Notifications
        $notifications = $this->dashboardModel->getLatestNotifications();
        $qualifiedInterns = $this->dashboardModel->getQualifiedInternsCount();

        // --- Pass to view ---
        $data = [
            'active_interns' => $activeInterns,

            // Training program stats
            'total_training_programs' => $totalTrainingPrograms,
            'completed_training_programs' => $completedTrainingPrograms,
            'remaining_training_programs' => $remainingTrainingPrograms,

            // Task stats
            'completed_tasks' => $completedTasks,
            'total_tasks' => $totalTasks,
            'pending_tasks' => $pendingTasks,
            'not_started_tasks' => $notStartedTasks,
            'task_completion_rate' => $taskCompletionRate,

            // Notifications
            'notifications' => $notifications,

             'qualified_interns' => $qualifiedInterns 
        ];

        $this->view('home/index', $data);
    }
}
<?php

session_start();

define('APPROOT', dirname(dirname(__FILE__)));
define('BASE_URL', 'http://localhost/intern/public/'); // Adjust this based on your project setup
define('SITENAME', 'Hệ thống Quản lý thực tập sinh');

require_once __DIR__ . '/core/App.php';
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/models/Campaign.php';
require_once __DIR__ . '/models/Intern.php';
require_once __DIR__ . '/models/InterviewSchedule.php';
require_once __DIR__ . '/models/TrainingProgram.php';
require_once __DIR__ . '/models/InternEvaluation.php';
require_once __DIR__ . '/models/InternFeedback.php';
require_once __DIR__ . '/models/Message.php';
require_once __DIR__ . '/models/Report.php';
require_once __DIR__ . '/models/Dashboard.php';
require_once __DIR__ . '/models/Role.php';
require_once __DIR__ . '/controllers/Profile.php';
require_once __DIR__ . '/controllers/Settings.php';
require_once __DIR__ . '/controllers/HelpAndSupport.php';
require_once __DIR__ . '/helpers/SessionHelper.php';

// Load database config
require_once __DIR__ . '/../config/database.php';

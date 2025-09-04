<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="wrapper">
        <aside class="sidebar">
            <?php if (isAdmin() || isHR()): ?>
            <a href="<?php echo BASE_URL; ?>" class="logo">Quản lý TTS</a>
            <?php else: ?>
            <a href="" class="logo">Quản lý TTS</a>
            <?php endif; ?>

            <ul>
                <?php if (isLoggedIn()): ?>
                <?php if (isAdmin() || isHR()): ?>
                <li><a href="<?php echo BASE_URL; ?>campaigns"><i class="fas fa-bullhorn"></i> Chiến dịch
                    </a>
                </li>
                <li><a href="<?php echo BASE_URL; ?>interviewschedules"><i class="fas fa-calendar-alt"></i> Lịch Phỏng
                        vấn </a></li>
                <li><a href="<?php echo BASE_URL; ?>trainingprograms"><i class="fas fa-chalkboard-teacher"></i> Chương
                        trình Đào tạo </a></li>
                <li><a href="<?php echo BASE_URL; ?>internevaluations"><i class="fas fa-chart-line"></i> Đánh giá
                    </a></li>
                <li><a href="<?php echo BASE_URL; ?>internfeedbacks"><i class="fas fa-comments"></i> Phản
                        hồi</a></li>
                <li><a href="<?php echo BASE_URL; ?>interns"><i class="fas fa-user-graduate"></i> Quản lý Hồ sơ TTS</a>
                </li>
                <li><a href="<?php echo BASE_URL; ?>reports"><i class="fas fa-chart-pie"></i> Báo cáo Tuyển dụng</a>
                </li>
                <?php if (isAdmin()): ?>
                <li><a href="<?php echo BASE_URL; ?>users"><i class="fas fa-cogs"></i> Quản lý Người dùng</a></li>
                <?php endif; ?>

                <?php if (isAdmin()): ?>
                <li><a href="<?php echo BASE_URL; ?>roles"><i class="fas fa-lock"></i> Các vai trò</a></li>
                <?php endif; ?>

                <?php elseif (isCoordinator()): ?>
                <li><a href="<?php echo BASE_URL; ?>trainingprograms"><i class="fas fa-chalkboard-teacher"></i> Chương
                        trình Đào tạo</a></li>
                <li><a href="<?php echo BASE_URL; ?>interviewschedules"><i class="fas fa-calendar-alt"></i> Lịch Phỏng
                        vấn</a></li>
                <li><a href="<?php echo BASE_URL; ?>internevaluations"><i class="fas fa-chart-line"></i> Đánh giá</a>
                </li>
                <li><a href="<?php echo BASE_URL; ?>internfeedbacks"><i class="fas fa-comments"></i> Phản
                        hồi</a></li>
                <!-- <li><a href="<?php echo BASE_URL; ?>messages"><i class="fas fa-envelope"></i> Tin nhắn</a></li> -->
                <?php elseif (isMentor()): ?>
                <li><a href="<?php echo BASE_URL; ?>internfeedbacks"><i class="fas fa-comments"></i> Phản hồi</a></li>
                <li><a href="<?php echo BASE_URL; ?>internevaluations"><i class="fas fa-chart-line"></i> Đánh giá</a>
                </li>
                <!-- <li><a href="<?php echo BASE_URL; ?>messages"><i class="fas fa-envelope"></i> Công cụ Giao tiếp</a></li> -->
                <?php elseif (isIntern()): ?>
                <!-- <li><a href="<?php echo BASE_URL; ?>internskills"><i class="fas fa-chart-bar"></i> Bảng điều khiển cá
                        nhân</a></li> -->
                <li><a href="<?php echo BASE_URL; ?>internfeedbacks/"><i class="fas fa-tachometer-alt"></i> Phản hồi</a>
                </li>
                <!-- <li><a href="<?php echo BASE_URL; ?>internfeedbacks/add"><i class="fas fa-paper-plane"></i> Gửi phản
                        hồi</a></li> -->
                <!-- <li><a href="<?php echo BASE_URL; ?>messages"><i class="fas fa-envelope"></i> Tin nhắn</a></li> -->
                <?php endif; ?>
                <li><a href="<?php echo BASE_URL; ?>auth/logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                <?php else: /* Not logged in */ ?>
                <li><a href="<?php echo BASE_URL; ?>auth/register"><i class="fas fa-user-plus"></i> Đăng ký</a></li>
                <li><a href="<?php echo BASE_URL; ?>auth/login"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a></li>
                <?php endif; ?>
            </ul>
        </aside>

        <main class="main-content">
            <?php if (isLoggedIn()): /* Only show top navbar if logged in */?>
            <nav class="top-navbar">
                <div class="welcome-text">Chào mừng, <?php echo $_SESSION['username']; ?>!</div>
                <div class="user-info">
                    <div class="notification-icon">
                        <!-- <i class="fas fa-bell"></i>
                        <span class="badge">6</span> -->
                    </div>
                    <div class="user-dropdown">
                        <div class="user-avatar" id="userAvatar"><?php echo substr($_SESSION['username'], 0, 1); ?>
                        </div>
                        <div class="user-dropdown-menu" id="userDropdownMenu">
                            <div class="user-dropdown-header">
                                <div class="avatar-small"><?php echo substr($_SESSION['username'], 0, 1); ?></div>
                                <span class="username-text"><?php echo $_SESSION['username']; ?></span>
                            </div>
                            <ul>
                                <li><a href="<?php echo BASE_URL; ?>profile"><i class="fas fa-user-circle"></i> My
                                        Profile</a></li>
                                <li><a href="<?php echo BASE_URL; ?>settings"><i class="fas fa-cog"></i> Settings</a>
                                </li>
                                <?php if (isAdmin()): ?>
                                <li><a href="<?php echo BASE_URL; ?>interns"><i class="fas fa-user-graduate"></i> Quản
                                        lý
                                        thực tập sinh</a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo BASE_URL; ?>reports"><i class="fas fa-chart-bar"></i>
                                        Reports</a>
                                </li>
                                <!-- <li><a href="<?php echo BASE_URL; ?>helpsupport"><i class="fas fa-question-circle"></i>
                                        Help/Support</a></li> -->
                                <li class="divider"></li>
                                <!-- <li class="dark-mode-toggle">
                                    <span>Chế độ tối</span>
                                    <label class="switch">
                                        <input type="checkbox" id="darkModeToggle">
                                        <span class="slider"></span>
                                    </label>
                                </li> -->
                                <li><a href="<?php echo BASE_URL; ?>auth/logout" class="logout-link"><i
                                            class="fas fa-power-off"></i> Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <?php endif; ?>
            <div class="container">

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const userAvatar = document.getElementById('userAvatar');
                    const userDropdownMenu = document.getElementById('userDropdownMenu');

                    if (userAvatar && userDropdownMenu) {
                        userAvatar.addEventListener('click', function(event) {
                            userDropdownMenu.classList.toggle('show');
                            event.stopPropagation(); // Prevent document click from immediately closing
                        });

                        document.addEventListener('click', function(event) {
                            if (!userDropdownMenu.contains(event.target) && !userAvatar.contains(event
                                    .target)) {
                                userDropdownMenu.classList.remove('show');
                            }
                        });
                    }

                    // Dark Mode Toggle (Basic functionality - requires CSS for actual theme change)
                    const darkModeToggle = document.getElementById('darkModeToggle');
                    if (darkModeToggle) {
                        // Check for saved theme preference
                        const currentTheme = localStorage.getItem('theme');
                        if (currentTheme === 'dark') {
                            document.body.classList.add('dark-mode');
                            darkModeToggle.checked = true;
                        }

                        darkModeToggle.addEventListener('change', function() {
                            if (this.checked) {
                                document.body.classList.add('dark-mode');
                                localStorage.setItem('theme', 'dark');
                            } else {
                                document.body.classList.remove('dark-mode');
                                localStorage.setItem('theme', 'light');
                            }
                        });
                    }
                });
                </script>
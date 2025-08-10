<div class="sidebar">
    <div class="sidebar-header">
        <h2>IT Internship</h2>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="/intern_management_system/dashboard"
                class="<?php echo ($active_page == 'dashboard') ? 'active' : ''; ?>">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="/intern_management_system/intern/profile"
                class="<?php echo ($active_page == 'profile') ? 'active' : ''; ?>">
                <i class="fas fa-user"></i> Hồ sơ cá nhân
            </a>
        </li>
        <li>
            <a href="/intern_management_system/intern/assignments"
                class="<?php echo ($active_page == 'assignments') ? 'active' : ''; ?>">
                <i class="fas fa-tasks"></i> Nhiệm vụ
            </a>
        </li>
        <li>
            <a href="/intern_management_system/intern/evaluations"
                class="<?php echo ($active_page == 'evaluations') ? 'active' : ''; ?>">
                <i class="fas fa-chart-line"></i> Đánh giá
            </a>
        </li>
        <li>
            <a href="/intern_management_system/messages">
                <i class="fas fa-envelope"></i> Tin nhắn
            </a>
        </li>
        <li>
            <a href="/intern_management_system/logout">
                <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
        </li>
    </ul>
</div>
<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="dashboard-content">
    <!-- Dashboard Cards -->
    <div class="dashboard-cards">
        <div class="card green">
            <h3>Thực tập sinh đang thực tập</h3>
            <div class="value"><?php echo $data['active_interns']; ?></div>
            <!-- <p>Tổng số thực tập sinh</p> -->
        </div>
        <div class="card blue">
            <h3>Chương trình đào tạo đã hoàn thành</h3>
            <div class="value"><?php echo $data['completed_training_programs']; ?></div>
            <!-- <p>Đã hoàn thành</p> -->
        </div>
        <div class="card orange">
            <h3>Thực tập sinh đạt yêu cầu</h3>
            <div class="value"><?php echo $data['qualified_interns']; ?></div>
            <!-- <p>Tổng số nhiệm vụ</p> -->
        </div>
    </div>

    <!-- Task Statistics Section -->
    <!-- <div class="dashboard-section">
        <h2>Thống kê nhiệm vụ</h2>
        <div class="task-statistics">
            <div class="task-stats-text">
                <p><strong>Nhiệm vụ đã hoàn thành:</strong> <?php echo $data['completed_tasks']; ?></p>
                <p><strong>Nhiệm vụ đang thực hiện:</strong> <?php echo $data['pending_tasks']; ?></p>
                <p><strong>Nhiệm vụ chưa bắt đầu:</strong> <?php echo $data['not_started_tasks']; ?></p>
            </div>
            <div class="task-chart">
                <div class="task-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: <?php echo $data['task_completion_rate']; ?>%"></div>
                    </div>
                    <div class="progress-text"><?php echo $data['task_completion_rate']; ?>%</div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Latest Notifications Section -->
    <div class="dashboard-section">
        <h2>Thông báo mới nhất</h2>
        <div class="notifications-list">
            <?php if (!empty($data['notifications'])): ?>
            <?php foreach ($data['notifications'] as $notification): ?>
            <div class="notification-item">
                <div class="date"><?php echo $notification['date']; ?></div>
                <div class="message"><?php echo $notification['message']; ?></div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p>Không có thông báo mới.</p>
            <?php endif; ?>
        </div>
    </div>
    <!-- Training Program Status Section -->
    <div class="dashboard-section">
        <div class="training-status-container">
            <div class="chart-container">
                <div class="pie-chart" id="trainingPieChart">
                    <div class="pie-segment completed" data-tooltip="Đã hoàn thành: 2 chương trình"></div>
                    <div class="pie-segment remaining" data-tooltip="Còn lại: 3 chương trình"></div>
                </div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <span class="legend-color completed"></span>
                        <span class="legend-text">Đã hoàn thành</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color remaining"></span>
                        <span class="legend-text">Còn lại</span>
                    </div>
                </div>
            </div>
            <div class="training-info">
                <h2>Trạng thái chương trình đào tạo</h2>
                <div class="training-summary">
                    <p><strong><?php echo $data['completed_training_programs']; ?> chương trình đã hoàn thành.</strong>
                    </p>
                    <p><strong>còn lại <?php echo $data['remaining_training_programs']; ?> chương trình.</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Pie Chart Animation
    const pieChart = document.getElementById('trainingPieChart');
    if (pieChart) {
        const segments = pieChart.querySelectorAll('.pie-segment');

        segments.forEach(segment => {
            segment.addEventListener('mouseenter', function() {
                const tooltip = this.getAttribute('data-tooltip');
                showTooltip(tooltip, this);
            });

            segment.addEventListener('mouseleave', function() {
                hideTooltip();
            });
        });
    }
});

function showTooltip(text, element) {
    // Remove existing tooltip
    hideTooltip();

    const tooltip = document.createElement('div');
    tooltip.className = 'chart-tooltip';
    tooltip.innerHTML = `
        <div class="tooltip-title">${text.split(':')[0]}</div>
        <div class="tooltip-content">Trạng thái chương trình đào tạo: ${text.split(':')[1]}</div>
    `;

    document.body.appendChild(tooltip);

    // Position tooltip
    const rect = element.getBoundingClientRect();
    tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
    tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + 'px';
}

function hideTooltip() {
    const existingTooltip = document.querySelector('.chart-tooltip');
    if (existingTooltip) {
        existingTooltip.remove();
    }
}
</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
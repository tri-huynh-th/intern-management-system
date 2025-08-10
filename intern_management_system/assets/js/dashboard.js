document.addEventListener('DOMContentLoaded', function() {
    // 1. Logic xử lý menu sidebar
    const sidebarItems = document.querySelectorAll('.sidebar-menu a');

    sidebarItems.forEach(item => {
        item.addEventListener('click', function() {
            // Xóa class 'active' khỏi tất cả các mục
            sidebarItems.forEach(i => i.classList.remove('active'));
            // Thêm class 'active' vào mục vừa click
            this.classList.add('active');
        });
    });

    // 2. Chức năng biểu đồ (Ví dụ với thư viện Chart.js)
    // Giả sử đã nhúng Chart.js vào header.php
    const internPerformanceChart = document.getElementById('intern-performance-chart');
    if (internPerformanceChart) {
        const ctx = internPerformanceChart.getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // Loại biểu đồ: bar, line, pie, ...
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4'],
                datasets: [{
                    label: 'Điểm hiệu suất trung bình',
                    data: [85, 92, 88, 95], // Dữ liệu giả định
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // 3. Xử lý các nút action trên các card
    const actionButtons = document.querySelectorAll('.card .action-btn');
    actionButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const actionType = this.getAttribute('data-action');
            const internId = this.getAttribute('data-id');
            // Gửi yêu cầu AJAX đến server để xử lý action
            console.log(`Thực hiện hành động '${actionType}' cho thực tập sinh ID: ${internId}`);
            alert(`Hành động "${actionType}" đã được thực hiện.`);
        });
    });
});
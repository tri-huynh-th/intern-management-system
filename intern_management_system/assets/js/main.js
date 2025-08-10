document.addEventListener('DOMContentLoaded', function() {
    // 1. Logic xử lý pop-up thông báo
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        // Tự động đóng alert sau 5 giây
        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000);
        
        // Thêm sự kiện click để đóng alert
        const closeBtn = alert.querySelector('.close-btn');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                alert.style.display = 'none';
            });
        }
    });

    // 2. Xử lý form validation cơ bản
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            // Lấy tất cả các input yêu cầu (có thuộc tính 'required')
            const requiredInputs = form.querySelectorAll('input[required]');
            let formIsValid = true;

            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    // Nếu input trống, hiển thị lỗi và ngăn form gửi đi
                    formIsValid = false;
                    input.style.border = '1px solid red';
                    // Bạn có thể thêm một div hiển thị thông báo lỗi cụ thể
                } else {
                    input.style.border = '1px solid #ccc';
                }
            });

            if (!formIsValid) {
                event.preventDefault();
                alert('Vui lòng điền đầy đủ các trường bắt buộc.');
            }
        });
    });

});
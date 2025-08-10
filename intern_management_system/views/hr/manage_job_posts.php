<?php
$active_page = 'manage_job_posts';
require_once '../layouts/header.php';
?>

<h2 class="mb-4">Quản lý Tin tuyển dụng</h2>

<div class="mb-3">
    <a href="/intern_management_system/hr/job/create" class="btn btn-success">
        <i class="fas fa-plus"></i> Tạo tin tuyển dụng mới
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Ngày đăng</th>
                    <th>Hạn chót</th>
                    <th>Số ứng viên</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($jobPosts)): ?>
                <?php foreach ($jobPosts as $jobPost): ?>
                <tr>
                    <td><?php echo htmlspecialchars($jobPost['title']); ?></td>
                    <td><?php echo htmlspecialchars($jobPost['posted_at']); ?></td>
                    <td><?php echo htmlspecialchars($jobPost['application_deadline']); ?></td>
                    <td>5</td>
                    <td>
                        <a href="/intern_management_system/hr/job/edit/<?php echo $jobPost['job_id']; ?>"
                            class="btn btn-sm btn-warning">Sửa</a>
                        <a href="/intern_management_system/hr/job/delete/<?php echo $jobPost['job_id']; ?>"
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa tin này?');">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Không có tin tuyển dụng nào.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>
<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>interns" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại</a>
<div class="card card-body bg-light mt-5">
    <h2>Thêm hồ sơ thực tập sinh mới</h2>
    <p>Tạo một hồ sơ thực tập sinh mới</p>
    <form action="<?php echo BASE_URL; ?>interns/add" method="post">
        <div class="form-group">
            <label for="user_id">Người dùng: <sup>*</sup></label>
            <select name="user_id" class="form-control form-control-lg <?php echo (!empty($data['user_id_err'])) ? 'is-invalid' : ''; ?>">
                <option value="">Chọn người dùng</option>
                <?php foreach ($data['available_users'] as $user): ?>
                    <option value="<?php echo $user['id']; ?>" <?php echo ($data['user_id'] == $user['id']) ? 'selected' : ''; ?>><?php echo $user['full_name'] . ' (' . $user['email'] . ')'; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="invalid-feedback"><?php echo $data['user_id_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="campaign_id">Chiến dịch: </label>
            <select name="campaign_id" class="form-control form-control-lg">
                <option value="">Chọn chiến dịch (Tùy chọn)</option>
                <?php foreach ($data['campaigns'] as $campaign): ?>
                    <option value="<?php echo $campaign['id']; ?>" <?php echo ($data['campaign_id'] == $campaign['id']) ? 'selected' : ''; ?>><?php echo $campaign['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="gpa">GPA: <sup>*</sup></label>
            <input type="text" name="gpa" class="form-control form-control-lg <?php echo (!empty($data['gpa_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['gpa']; ?>">
            <span class="invalid-feedback"><?php echo $data['gpa_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="university">Trường đại học: <sup>*</sup></label>
            <input type="text" name="university" class="form-control form-control-lg <?php echo (!empty($data['university_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['university']; ?>">
            <span class="invalid-feedback"><?php echo $data['university_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="major">Chuyên ngành: <sup>*</sup></label>
            <input type="text" name="major" class="form-control form-control-lg <?php echo (!empty($data['major_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['major']; ?>">
            <span class="invalid-feedback"><?php echo $data['major_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="start_date">Ngày bắt đầu: <sup>*</sup></label>
            <input type="date" name="start_date" class="form-control form-control-lg <?php echo (!empty($data['start_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['start_date']; ?>">
            <span class="invalid-feedback"><?php echo $data['start_date_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="end_date">Ngày kết thúc: <sup>*</sup></label>
            <input type="date" name="end_date" class="form-control form-control-lg <?php echo (!empty($data['end_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['end_date']; ?>">
            <span class="invalid-feedback"><?php echo $data['end_date_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="status">Trạng thái: <sup>*</sup></label>
            <select name="status" class="form-control form-control-lg">
                <option value="applied" <?php echo ($data['status'] == 'applied') ? 'selected' : ''; ?>>Đã ứng tuyển</option>
                <option value="interviewing" <?php echo ($data['status'] == 'interviewing') ? 'selected' : ''; ?>>Đang phỏng vấn</option>
                <option value="offered" <?php echo ($data['status'] == 'offered') ? 'selected' : ''; ?>>Đã được mời</option>
                <option value="accepted" <?php echo ($data['status'] == 'accepted') ? 'selected' : ''; ?>>Đã chấp nhận</option>
                <option value="rejected" <?php echo ($data['status'] == 'rejected') ? 'selected' : ''; ?>>Đã từ chối</option>
                <option value="in_progress" <?php echo ($data['status'] == 'in_progress') ? 'selected' : ''; ?>>Đang thực tập</option>
                <option value="completed" <?php echo ($data['status'] == 'completed') ? 'selected' : ''; ?>>Hoàn thành</option>
                <option value="terminated" <?php echo ($data['status'] == 'terminated') ? 'selected' : ''; ?>>Đã chấm dứt</option>
            </select>
        </div>
        <input type="submit" class="btn btn-success" value="Thêm hồ sơ">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>internfeedbacks" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại</a>
<div class="card card-body bg-light mt-5">
    <h2>Chỉnh sửa phản hồi thực tập sinh</h2>
    <p>Chỉnh sửa phản hồi hiện có cho thực tập sinh</p>
    <form action="<?php echo BASE_URL; ?>internfeedbacks/edit/<?php echo $data['id']; ?>" method="post">
        <div class="form-group">
            <label for="intern_id">Thực tập sinh: <sup>*</sup></label>
            <select name="intern_id"
                class="form-control form-control-lg <?php echo (!empty($data['intern_id_err'])) ? 'is-invalid' : ''; ?>">
                <option value="">Chọn thực tập sinh</option>
                <?php if (!empty($data['interns'])): ?>
                <?php foreach ($data['interns'] as $intern): ?>
                <option value="<?php echo $intern['intern_id']; ?>"
                    <?php echo ($data['intern_id'] == $intern['intern_id']) ? 'selected' : ''; ?>>
                    <?php echo $intern['intern_name'] . ' (' . $intern['email'] . ')'; ?>
                </option>
                <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <span class="invalid-feedback"><?php echo $data['intern_id_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="feedback_type">Loại phản hồi: <sup>*</sup></label>
            <select name="feedback_type"
                class="form-control form-control-lg <?php echo (!empty($data['feedback_type_err'])) ? 'is-invalid' : ''; ?>">
                <option value="">Chọn loại phản hồi</option>
                <option value="daily_progress"
                    <?php echo ($data['feedback_type'] == 'daily_progress') ? 'selected' : ''; ?>>Tiến độ hàng ngày
                </option>
                <option value="skill_assessment"
                    <?php echo ($data['feedback_type'] == 'skill_assessment') ? 'selected' : ''; ?>>Đánh giá kỹ năng
                </option>
                <option value="program_feedback"
                    <?php echo ($data['feedback_type'] == 'program_feedback') ? 'selected' : ''; ?>>Phản hồi chương
                    trình</option>
            </select>
            <span class="invalid-feedback"><?php echo $data['feedback_type_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="feedback_date">Ngày phản hồi: <sup>*</sup></label>
            <input type="date" name="feedback_date"
                class="form-control form-control-lg <?php echo (!empty($data['feedback_date_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo $data['feedback_date']; ?>">
            <span class="invalid-feedback"><?php echo $data['feedback_date_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="feedback_content">Nội dung phản hồi: <sup>*</sup></label>
            <textarea name="feedback_content"
                class="form-control form-control-lg <?php echo (!empty($data['feedback_content_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['feedback_content']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['feedback_content_err']; ?></span>
        </div>
        <input type="submit" class="btn btn-success" value="Cập nhật phản hồi">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
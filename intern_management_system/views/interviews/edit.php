<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>interviewschedules" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại</a>
<div class="card card-body bg-light mt-5">
    <h2>Chỉnh sửa lịch phỏng vấn</h2>
    <p>Chỉnh sửa lịch phỏng vấn hiện có</p>
    <form action="<?php echo BASE_URL; ?>interviewschedules/edit/<?php echo $data['id']; ?>" method="post">
        <div class="form-group">
            <label for="intern_id">Thực tập sinh: <sup>*</sup></label>
            <select name="intern_id"
                class="form-control form-control-lg <?php echo (!empty($data['intern_id_err'])) ? 'is-invalid' : ''; ?>">
                <option value="">Chọn thực tập sinh</option>
                <?php foreach ($data['interns'] as $intern): ?>
                <option value="<?php echo $intern['intern_id']; ?>"
                    <?php echo ($data['intern_id'] == $intern['intern_id']) ? 'selected' : ''; ?>>
                    <?php echo $intern['intern_name'] . ' (' . $intern['email'] . ')'; ?>
                </option>


                <?php endforeach; ?>
            </select>
            <span class="invalid-feedback"><?php echo $data['intern_id_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="interviewer_id">Người phỏng vấn: <sup>*</sup></label>
            <select name="interviewer_id"
                class="form-control form-control-lg <?php echo (!empty($data['interviewer_id_err'])) ? 'is-invalid' : ''; ?>">
                <option value="">Chọn người phỏng vấn</option>
                <?php foreach ($data['interviewers'] as $interviewer): ?>
                <option value="<?php echo $interviewer['id']; ?>"
                    <?php echo ($data['interviewer_id'] == $interviewer['id']) ? 'selected' : ''; ?>>
                    <?php echo $interviewer['full_name'] . ' (' . $interviewer['email'] . ')'; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="invalid-feedback"><?php echo $data['interviewer_id_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="interview_date">Ngày và giờ phỏng vấn: <sup>*</sup></label>
            <input type="datetime-local" name="interview_date"
                class="form-control form-control-lg <?php echo (!empty($data['interview_date_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo date('Y-m-d\TH:i', strtotime($data['interview_date'])); ?>">
            <span class="invalid-feedback"><?php echo $data['interview_date_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="location">Địa điểm:</label>
            <input type="text" name="location" class="form-control form-control-lg"
                value="<?php echo $data['location']; ?>">
        </div>
        <div class="form-group">
            <label for="status">Trạng thái: <sup>*</sup></label>
            <select name="status" class="form-control form-control-lg">
                <option value="scheduled" <?php echo ($data['status'] == 'scheduled') ? 'selected' : ''; ?>>Đã lên lịch
                </option>
                <option value="completed" <?php echo ($data['status'] == 'completed') ? 'selected' : ''; ?>>Đã hoàn
                    thành</option>
                <option value="cancelled" <?php echo ($data['status'] == 'cancelled') ? 'selected' : ''; ?>>Đã hủy
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="notes">Ghi chú:</label>
            <textarea name="notes" class="form-control form-control-lg"><?php echo $data['notes']; ?></textarea>
        </div>
        <input type="submit" class="btn btn-success" value="Cập nhật lịch phỏng vấn">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
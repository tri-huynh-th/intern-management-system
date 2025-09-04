<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>trainingprograms" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại</a>
<div class="card card-body bg-light mt-5">
    <h2>Thêm chương trình đào tạo mới</h2>
    <p>Tạo một chương trình đào tạo mới</p>
    <form action="<?php echo BASE_URL; ?>trainingprograms/add" method="post">
        <div class="form-group">
            <label for="title">Tiêu đề: <sup>*</sup></label>
            <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea name="description" class="form-control form-control-lg"><?php echo $data['description']; ?></textarea>
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
            <label for="coordinator_id">Điều phối viên: <sup>*</sup></label>
            <select name="coordinator_id" class="form-control form-control-lg <?php echo (!empty($data['coordinator_id_err'])) ? 'is-invalid' : ''; ?>">
                <option value="">Chọn điều phối viên</option>
                <?php foreach ($data['coordinators'] as $coordinator): ?>
                    <option value="<?php echo $coordinator['id']; ?>" <?php echo ($data['coordinator_id'] == $coordinator['id']) ? 'selected' : ''; ?>><?php echo $coordinator['full_name'] . ' (' . $coordinator['email'] . ')'; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="invalid-feedback"><?php echo $data['coordinator_id_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="status">Trạng thái: <sup>*</sup></label>
            <select name="status" class="form-control form-control-lg">
                <option value="planned" <?php echo ($data['status'] == 'planned') ? 'selected' : ''; ?>>Đã lên kế hoạch</option>
                <option value="in_progress" <?php echo ($data['status'] == 'in_progress') ? 'selected' : ''; ?>>Đang thực hiện</option>
                <option value="completed" <?php echo ($data['status'] == 'completed') ? 'selected' : ''; ?>>Hoàn thành</option>
            </select>
        </div>
        <input type="submit" class="btn btn-success" value="Thêm chương trình">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

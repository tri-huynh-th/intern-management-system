<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>campaigns" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại</a>
<div class="card card-body bg-light mt-5">
    <h2>Chỉnh sửa chiến dịch</h2>
    <p>Chỉnh sửa chiến dịch tuyển dụng</p>
    <form action="<?php echo BASE_URL; ?>campaigns/edit/<?php echo $data['id']; ?>" method="post">
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
            <label for="status">Trạng thái: <sup>*</sup></label>
            <select name="status" class="form-control form-control-lg">
                <option value="open" <?php echo ($data['status'] == 'open') ? 'selected' : ''; ?>>Mở</option>
                <option value="closed" <?php echo ($data['status'] == 'closed') ? 'selected' : ''; ?>>Đóng</option>
                <option value="archived" <?php echo ($data['status'] == 'archived') ? 'selected' : ''; ?>>Lưu trữ</option>
            </select>
        </div>
        <input type="submit" class="btn btn-success" value="Cập nhật">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

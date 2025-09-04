<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>internevaluations" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại</a>
<div class="card card-body bg-light mt-5">
    <h2>Chỉnh sửa đánh giá thực tập sinh</h2>
    <p>Chỉnh sửa đánh giá hiệu suất thực tập sinh</p>
    <form action="<?php echo BASE_URL; ?>internevaluations/edit/<?php echo $data['id']; ?>" method="post">
        <div class="form-group">
            <label for="intern_id">Thực tập sinh: <sup>*</sup></label>
            <select name="intern_id"
                class="form-control form-control-lg <?php echo (!empty($data['intern_id_err'])) ? 'is-invalid' : ''; ?>">
                <option value="">Chọn thực tập sinh</option>
                <?php foreach ($data['interns'] as $intern): ?>
                <option value="<?php echo $intern['intern_id']; ?>"
                    <?php echo ($data['intern_id'] == $intern['intern_id']) ? 'selected' : ''; ?>>
                    <?php echo $intern['intern_name'] . ' (' . $intern['email'] . ')'; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="invalid-feedback"><?php echo $data['intern_id_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="evaluation_date">Ngày đánh giá: <sup>*</sup></label>
            <input type="date" name="evaluation_date"
                class="form-control form-control-lg <?php echo (!empty($data['evaluation_date_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo $data['evaluation_date']; ?>">
            <span class="invalid-feedback"><?php echo $data['evaluation_date_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="overall_rating">Điểm đánh giá tổng thể (1-5): <sup>*</sup></label>
            <input type="number" name="overall_rating"
                class="form-control form-control-lg <?php echo (!empty($data['overall_rating_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo $data['overall_rating']; ?>" min="1" max="5">
            <span class="invalid-feedback"><?php echo $data['overall_rating_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="comments">Bình luận:</label>
            <textarea name="comments" class="form-control form-control-lg"><?php echo $data['comments']; ?></textarea>
        </div>
        <input type="submit" class="btn btn-success" value="Cập nhật đánh giá">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
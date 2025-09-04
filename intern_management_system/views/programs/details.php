<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo BASE_URL; ?>trainingprograms" class="btn btn-light"><i class="fa fa-backward"></i> Quay lại</a>
<br>
<h1>Chi tiết Chương trình đào tạo: <?php echo $data['program']['title']; ?></h1>
<div class="bg-light p-2 mb-3">
    <strong>Mô tả:</strong> <?php echo $data['program']['description']; ?><br>
    <strong>Ngày bắt đầu:</strong> <?php echo $data['program']['start_date']; ?><br>
    <strong>Ngày kết thúc:</strong> <?php echo $data['program']['end_date']; ?><br>
    <strong>Điều phối viên:</strong> <?php echo $data['program']['coordinator_name']; ?><br>
    <strong>Trạng thái:</strong> <?php echo $data['program']['status']; ?><br>
    <strong>Ngày tạo:</strong> <?php echo $data['program']['created_at']; ?><br>
</div>

<?php if (isAdmin() || isHR() || isCoordinator()): ?>
<a href="<?php echo BASE_URL; ?>trainingprograms/edit/<?php echo $data['program']['id']; ?>"
    class="btn btn-dark">Sửa</a>

<form class="pull-right" action="<?php echo BASE_URL; ?>trainingprograms/delete/<?php echo $data['program']['id']; ?>"
    method="post">
    <input type="submit" value="Xóa" class="btn btn-danger">
</form>
<!-- 
<h3 class="mt-4">Thực tập sinh trong chương trình</h3>
<?php if (!empty($data['interns_in_program'])): ?>
<ul>
    <?php foreach ($data['interns_in_program'] as $intern): ?>
    <li>
        <?php echo $intern['full_name'] . ' (' . $intern['email'] . ')'; ?>
        <form class="d-inline ml-2"
            action="<?php echo BASE_URL; ?>trainingprograms/removeintern/<?php echo $data['program']['id']; ?>/<?php echo $intern['intern_id']; ?>"
            method="post">
            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
        </form>
    </li>
    <?php endforeach; ?>

</ul>
<?php else: ?>
<p>Chưa có thực tập sinh nào trong chương trình này.</p>
<?php endif; ?>

<h3 class="mt-4">Thêm thực tập sinh vào chương trình</h3>
<?php if (!empty($data['interns_not_in_program'])): ?>
<form action="<?php echo BASE_URL; ?>trainingprograms/addintern/<?php echo $data['program']['id']; ?>" method="post">
    <div class="form-group">
        <select name="intern_id" class="form-control form-control-lg">
            <option value="">Chọn thực tập sinh</option>
            <?php foreach ($data['interns_not_in_program'] as $intern): ?>
            <option value="<?php echo $intern['id']; ?>">
                <?php echo $intern['full_name'] . ' (' . $intern['email'] . ')'; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="submit" class="btn btn-primary" value="Thêm thực tập sinh">
</form>
<?php else: ?>
<p>Không có thực tập sinh nào có sẵn để thêm vào chương trình này.</p>
<?php endif; ?> -->

<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
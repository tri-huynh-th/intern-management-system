<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('evaluation_message'); ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Đánh giá Thực tập sinh</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo BASE_URL; ?>internevaluations/add" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Thêm đánh giá mới
        </a>
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Thực tập sinh</th>
            <th>Người đánh giá</th>
            <th>Ngày đánh giá</th>
            <th>Điểm tổng thể</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['intern_evaluations'] as $evaluation): ?>
            <tr>
                <td><?php echo $evaluation['intern_name']; ?></td>
                <td><?php echo $evaluation['evaluator_name']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($evaluation['evaluation_date'])); ?></td>
                <td><?php echo $evaluation['overall_rating']; ?></td>
                <td>
                    <a href="<?php echo BASE_URL; ?>internevaluations/details/<?php echo $evaluation['id']; ?>" class="btn btn-info">Chi tiết</a>
                    <?php if (isAdmin() || isHR() || isCoordinator() || isMentor()): ?>
                        <a href="<?php echo BASE_URL; ?>internevaluations/edit/<?php echo $evaluation['id']; ?>" class="btn btn-warning">Sửa</a>
                        <form class="d-inline" action="<?php echo BASE_URL; ?>internevaluations/delete/<?php echo $evaluation['id']; ?>" method="post">
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>

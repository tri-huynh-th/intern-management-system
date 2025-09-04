<?php require APPROOT . '/views/inc/header.php'; ?>
<h1>Quản lý Vai trò</h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên vai trò</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['roles'] as $role): ?>
        <tr>
            <td><?php echo $role['id']; ?></td>
            <td><?php echo $role['role_name']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require APPROOT . '/views/inc/footer.php'; ?>
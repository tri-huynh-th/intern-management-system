<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="dashboard-content">
    <div class="dashboard-section">
        <h2>My Profile</h2>
        <div class="profile-info">
            <p>This is the user profile page.</p>
            <p>Username: <?php echo $_SESSION['username']; ?></p>
            <p>Role: <?php echo $_SESSION['role_name'] ?? 'User'; ?></p>
        </div>
    </div>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>

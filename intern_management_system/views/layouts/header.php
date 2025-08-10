<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Hệ thống Quản lý Thực tập sinh</title>
    <link rel="stylesheet" href="/intern_management_system/assets/css/style.css">
    <link rel="stylesheet" href="/intern_management_system/assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="dashboard-layout">
        <?php require_once 'sidebar.php'; ?>
        <div class="main-content">
            <header class="dashboard-header">
                <h3>Chào mừng, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3>
                <div class="user-info">
                    <span class="user-role"><?php echo $_SESSION['role_name']; ?></span>
                    <a href="/intern_management_system/logout" class="btn btn-primary btn-sm ml-3">Đăng xuất</a>
                </div>
            </header>
            <div class="container-fluid mt-4"></div>
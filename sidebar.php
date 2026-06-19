<div class="sidebar">
    <div class="sidebar-logo">
        <a href="admin_dashboard.php" class="logo-text">THE_ARCHIVE</a>
    </div>

    <div class="sidebar-links">
        <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
            <a href="admin_dashboard.php" class="sidebar-btn dashboard-link">DASHBOARD</a>
            <a href="add_notice.php" class="sidebar-btn btn-filled">+ NOTICE</a>
            <a href="add_category.php" class="sidebar-btn btn-outline">+ CATEGORY</a>
            <a href="logout.php" class="sidebar-btn btn-pill">LOGOUT</a>
        <?php endif; ?>
    </div>
</div>
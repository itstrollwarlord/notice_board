<nav class="navbar navbar-expand-lg sticky-top py-3">
    <a class="navbar-brand archive-logo ms-4" href="index.php">ARCHIVE</a>

    <div class="ms-auto d-flex gap-3 align-items-center me-4">
        <a href="index.php" class="btn text-white small opacity-75">HOME</a>

        <?php if(isset($_SESSION['user'])): ?>
            <?php if($_SESSION['user']['role'] == 'admin'): ?>
                <a href="admin_dashboard.php" class="btn nav-dashboard">DASHBOARD</a>
                <a href="add_notice.php" class="btn nav-notice">+ NOTICE</a>
                <a href="add_category.php" class="btn nav-category">+ CATEGORY</a>
            <?php endif; ?>
            
            <a href="logout.php" class="btn nav-logout" style="background: #ef4444 !important; color: white !important;">LOGOUT</a>

        <?php else: ?>
            <a href="login.php" class="btn btn-outline-info btn-sm">LOGIN</a>
        <?php endif; ?>
    </div>
</nav>
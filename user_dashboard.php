<?php
session_start();
include "db.php"; 
include "header.php"; // Loads Space Grotesk and Dark Theme
include "navbar.php"; // Loads the sleek navigation bar

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<div class="container mt-5">
    <div class="mb-5">
        <h1 class="display-5 fw-bold text-white">The Registry</h1>
        <p class="text-muted small tracking-widest">CURRENT BROADCASTS FOR <?php echo strtoupper($_SESSION['user']['name']); ?></p>
    </div>

    <div class="row g-4">
        <?php
        $result = mysqli_query($conn, "SELECT notices.*, categories.name AS category FROM notices JOIN categories ON notices.category_id = categories.id ORDER BY notices.created_at DESC");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="col-md-6 col-lg-4 notice-card">
                <div class="card h-100 p-4">
                    <div class="mb-3">
                        <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2 small">
                            <?php echo strtoupper($row['category']); ?>
                        </span>
                    </div>
                    <h4 class="fw-bold text-white mb-3"><?php echo $row['title']; ?></h4>
                    <p class="text-muted mb-0 small"><?php echo $row['description']; ?></p>
                </div>
            </div>
        <?php 
            } 
        } else {
            echo "<div class='col-12 text-center py-5'><p class='text-muted'>No active transmissions found.</p></div>";
        }
        ?>
    </div>
</div>

<?php include "footer.php"; ?>
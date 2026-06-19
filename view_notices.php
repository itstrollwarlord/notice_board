<?php
include "db.php";
include "navbar.php";
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Notices</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f4f6f9;">

<div class="container mt-4">

    <h2 class="mb-4">All Notices</h2>

    <?php
    $result = mysqli_query($conn,
    "SELECT notices.*, categories.name AS category
     FROM notices
     JOIN categories ON notices.category_id = categories.id
     ORDER BY notices.created_at DESC");

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
    ?>

    <div class="card mb-3 shadow-sm">
        <div class="card-body">

            <h4 class="card-title"><?php echo $row['title']; ?></h4>

            <p class="card-text">
                <?php echo $row['description']; ?>
            </p>

            <span class="badge bg-info">
                <?php echo $row['category']; ?>
            </span>

            <div class="mt-2 text-muted">
                <?php echo $row['created_at']; ?>
            </div>

        </div>
    </div>

    <?php
        }

    } else {
        echo "<p>No notices found.</p>";
    }
    ?>

</div>

</body>
</html>
<?php
session_start();
include "db.php";
include "header.php";
include "navbar.php";

// Access Control
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<style>
    /* Professional Sea-Glass Card Styling */
    .ui-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 25px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .ui-card:hover {
        transform: translateY(-8px);
        border-color: rgba(79, 209, 197, 0.4);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
    }

    .category-badge {
        font-size: 0.65rem;
        font-weight: 800;
        letter-spacing: 2px;
        color: #4fd1c5;
        border: 1px solid rgba(79, 209, 197, 0.3);
        padding: 4px 10px;
        border-radius: 4px;
        background: rgba(79, 209, 197, 0.05);
    }

    .action-btn {
        font-size: 0.7rem;
        font-weight: bold;
        letter-spacing: 1px;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 4px;
        transition: 0.2s;
    }

    .action-btn.edit {
        color: #4fd1c5;
        border: 1px solid rgba(79, 209, 197, 0.5);
    }

    .action-btn.edit:hover {
        background: #4fd1c5;
        color: #000;
    }

    .action-btn.delete {
        color: #ff4d4d;
        border: 1px solid rgba(255, 77, 77, 0.5);
    }

    .action-btn.delete:hover {
        background: #ff4d4d;
        color: #fff;
    }

    .tracking-widest {
        letter-spacing: 3px;
    }
</style>

<div class="container mt-5">

    <div class="mb-5">
        <h1 class="display-6 fw-bold text-white mb-2" style="font-family: 'Syncopate', sans-serif; letter-spacing: 4px;">
            ARCHIVE VAULT
        </h1>
        <p style="color: rgba(79,209,197,0.7); font-size: 0.75rem; letter-spacing:2px; font-weight: bold;">
            SEA-GLASS INTERFACE ACTIVE // ENCRYPTED_ACCESS
        </p>
    </div>

    <div class="row g-4">

        <?php
        // Fetching notices with category names
        $query = "SELECT notices.*, categories.name AS category 
                  FROM notices 
                  LEFT JOIN categories ON notices.category_id = categories.id 
                  ORDER BY notices.created_at DESC";
        
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <div class="col-md-4">
            <div class="ui-card h-100 d-flex flex-column">

                <div class="mb-3">
                    <span class="category-badge">
                        <?php echo strtoupper($row['category'] ?? 'UNCATEGORIZED'); ?>
                    </span>
                </div>

                <h4 class="fw-bold text-white mb-3" style="font-size: 1.2rem;">
                    <?php echo htmlspecialchars($row['title']); ?>
                </h4>

                <p style="color: #cbd5e1; font-size: 0.9rem; line-height: 1.6; flex-grow:1; opacity: 0.8;">
                    <?php 
                        $desc = $row['description'];
                        echo (strlen($desc) > 120) ? htmlspecialchars(substr($desc, 0, 120)) . "..." : htmlspecialchars($desc); 
                    ?>
                </p>

                <div class="card-actions d-flex gap-2 mt-4">
                    <a href="edit_notice.php?id=<?php echo $row['id']; ?>" class="action-btn edit">
                        EDIT
                    </a>
                    <a href="delete_notice.php?id=<?php echo $row['id']; ?>" 
                       class="action-btn delete" 
                       onclick="return confirm('WARNING: Are you sure you want to BURN this record? This cannot be undone.');">
                        BURN
                    </a>
                </div>

            </div>
        </div>

        <?php 
            } 
        } else { 
        ?>
            <div class="col-12 text-center py-5">
                <div style="border: 1px dashed rgba(255,255,255,0.1); padding: 50px; border-radius: 15px;">
                    <p class="text-muted tracking-widest small mb-0">THE ARCHIVE IS CURRENTLY EMPTY</p>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

<?php include "footer.php"; ?>
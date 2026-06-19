<?php
session_start();
include "db.php";
include "header.php";
include "navbar.php";
?>

<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-white mb-2" style="font-family: 'Syncopate', sans-serif; letter-spacing: 5px;">PUBLIC ARCHIVE</h1>
        <p class="tracking-widest small opacity-75" style="color: var(--sea-solid)">SYNCHRONIZED BROADCAST NODES</p>
    </div>

    <div class="row">
        <?php
        $sql = "SELECT notices.*, categories.name AS cat_name FROM notices 
                JOIN categories ON notices.category_id = categories.id 
                ORDER BY notices.created_at DESC";
        $result = mysqli_query($conn, $sql);

        if($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="ui-card h-100">
                        <div class="mb-3">
                            <span class="category-badge"><?php echo strtoupper($row['cat_name']); ?></span>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: var(--sea-solid);"><?php echo strtoupper($row['title']); ?></h4>
                        <p class="small opacity-75" style="color: #cbd5e1;"><?php echo $row['description']; ?></p>
                        
                        <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
                            <div class="mt-3 border-top border-secondary pt-2">
                                <a href="edit_notice.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">EDIT</a>
                            </div>
                        <?php endif; ?>

                        <div class="mt-auto pt-3 border-top border-secondary opacity-25 small">
                            TS // <?php echo date('d.M.Y', strtotime($row['created_at'])); ?>
                        </div>
                    </div>
                </div>
                <?php 
            }
        } else {
            echo '<div class="col-12 text-center text-white opacity-50 mt-5">NO ACTIVE BROADCASTS FOUND</div>';
        }
        ?>
    </div>
</div>
<?php include "footer.php"; ?>
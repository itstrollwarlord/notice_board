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
    /* 1. ANIMATION: The "Breathing" Pulse for the Neon Border */
    @keyframes neonPulse {
        0% { box-shadow: 0 0 15px rgba(79, 209, 197, 0.1); border-color: rgba(79, 209, 197, 0.2); }
        50% { box-shadow: 0 0 25px rgba(79, 209, 197, 0.25); border-color: rgba(79, 209, 197, 0.5); }
        100% { box-shadow: 0 0 15px rgba(79, 209, 197, 0.1); border-color: rgba(79, 209, 197, 0.2); }
    }

    body {
        background-color: #0b0e11;
        font-family: 'Inter', sans-serif;
    }

    /* 2. THE GLASS PANEL: Container with Neon Pulse */
    .glass-panel {
        background: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(15px);
        padding: 50px;
        border-radius: 20px;
        border: 1px solid rgba(79, 209, 197, 0.2);
        animation: neonPulse 4s infinite ease-in-out; /* The breathing effect */
        transition: transform 0.4s ease;
    }

    .glass-panel:focus-within {
        transform: scale(1.01); /* Subtle "pop" when interacting */
    }

    /* 3. TYPOGRAPHY & LABELS */
    .custom-label {
        color: rgba(255, 255, 255, 0.6) !important;
        font-size: 0.75rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 12px;
        display: block;
    }

    /* 4. INPUTS, SELECTS, & TEXTAREA */
    .form-control, .form-select {
        background-color: rgba(0, 0, 0, 0.5) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #fff !important;
        padding: 14px 18px !important;
        border-radius: 10px !important;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4fd1c5 !important;
        box-shadow: 0 0 15px rgba(79, 209, 197, 0.4) !important;
        background-color: rgba(0, 0, 0, 0.7) !important;
        outline: none;
    }

    /* 5. THE BUTTON: High-Fidelity Glow */
    .btn-primary {
        background-color: #0062ff !important;
        border: none !important;
        border-radius: 10px !important;
        letter-spacing: 3px;
        font-weight: 800;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .btn-primary:hover {
        background-color: #0052d4 !important;
        box-shadow: 0 0 30px rgba(0, 98, 255, 0.5);
        transform: translateY(-3px);
    }

    /* Spacing Refinement */
    .notice-section { margin-bottom: 35px; }
</style>

<div class="container mt-5 d-flex justify-content-center">
    <div class="glass-panel w-100" style="max-width: 650px;">
        
        <div class="text-center mb-5">
            <h2 class="fw-bold text-white mb-2" style="font-family: 'Syncopate', sans-serif; letter-spacing: 6px;">NEW NOTICE</h2>
            <p class="small text-uppercase" style="color: #4fd1c5; letter-spacing: 3px; font-weight: bold; opacity: 0.9;">
                BROADCAST TO ALL CONNECTED NODES
            </p>
        </div>
        
        <form action="process_notice.php" method="POST" id="noticeForm" onsubmit="return validateNoticeForm()">
            
            <div class="notice-section">
                <label class="custom-label">Notice Title</label>
                <input type="text" name="title" id="notice_title" class="form-control shadow-none" 
                       placeholder="e.g. CRITICAL SYSTEM PATCH" required autocomplete="off">
            </div>

            <div class="notice-section">
                <label class="custom-label">Classification</label>
                <select name="category_id" class="form-select shadow-none">
                    <?php
                    $cats = mysqli_query($conn, "SELECT * FROM categories");
                    while($c = mysqli_fetch_assoc($cats)) {
                        echo "<option value='".$c['id']."'>".strtoupper($c['name'])."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="notice-section" style="margin-bottom: 45px;">
                <label class="custom-label">Content Body</label>
                <textarea name="description" id="notice_body" class="form-control shadow-none" 
                          rows="6" placeholder="ENTER SYSTEM LOGS OR BROADCAST DETAILS..." required></textarea>
            </div>

            <button type="submit" name="submit_notice" class="btn btn-primary w-100 py-3">
                INITIATE BROADCAST
            </button>
        </form>
    </div>
</div>

<script>
function validateNoticeForm() {
    let title = document.getElementById("notice_title").value;
    let body = document.getElementById("notice_body").value;

    if (title.trim().length < 5) {
        alert("PROTOCOL ERROR: Title must be at least 5 characters.");
        return false;
    }
    if (body.trim().length < 10) {
        alert("PROTOCOL ERROR: Broadcast body is insufficient.");
        return false;
    }
    return true;
}
</script>

<?php include "footer.php"; ?>
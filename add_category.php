<?php
session_start();
include "db.php";
include "header.php";
include "navbar.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $query = "INSERT INTO categories (name) VALUES ('$name')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Category Indexed'); window.location='admin_dashboard.php';</script>";
    }
}
?>

<style>
    @keyframes neonPulse {
        0% { box-shadow: 0 0 15px rgba(79, 209, 197, 0.1); border-color: rgba(79, 209, 197, 0.2); }
        50% { box-shadow: 0 0 25px rgba(79, 209, 197, 0.25); border-color: rgba(79, 209, 197, 0.5); }
        100% { box-shadow: 0 0 15px rgba(79, 209, 197, 0.1); border-color: rgba(79, 209, 197, 0.2); }
    }

    body { background-color: #0b0e11; font-family: 'Inter', sans-serif; }

    .glass-form-container {
        background: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(15px);
        padding: 50px 40px;
        border-radius: 20px;
        border: 1px solid rgba(79, 209, 197, 0.2); 
        animation: neonPulse 4s infinite ease-in-out;
    }

    .form-control {
        background-color: rgba(0, 0, 0, 0.5) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #fff !important;
        padding: 15px !important;
        border-radius: 10px !important;
        box-shadow: none !important; /* Glow Removed */
    }

    .form-control:focus {
        border-color: #4fd1c5 !important; 
        box-shadow: none !important; /* Glow Removed */
        background-color: rgba(0, 0, 0, 0.7) !important;
        outline: none;
    }

    .custom-label {
        color: rgba(255, 255, 255, 0.6) !important;
        font-size: 0.75rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 15px;
        display: block;
    }

    .btn-primary {
        background-color: #0062ff !important;
        border: none !important;
        border-radius: 10px !important;
        letter-spacing: 2px;
        font-weight: 800;
        padding: 15px 0;
        transition: all 0.4s ease;
    }

    .btn-primary:hover {
        background-color: #0052d4 !important;
        box-shadow: 0 0 30px rgba(0, 98, 255, 0.4);
        transform: translateY(-3px);
    }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 85vh;">
    <div class="glass-form-container w-100" style="max-width: 450px;">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-white mb-2" style="font-family: 'Syncopate', sans-serif; letter-spacing: 6px;">CLASSIFY</h2>
            <p class="small text-uppercase" style="color: #4fd1c5; letter-spacing: 2px; opacity: 0.9; font-weight: bold;">EXPAND THE ARCHIVE CLASSIFICATION</p>
        </div>
        <form method="POST">
            <div class="mb-5">
                <label class="custom-label">Category Name</label>
                <input type="text" name="name" class="form-control shadow-none" placeholder="e.g. SYSTEM UPDATE" required autofocus autocomplete="off">
            </div>
            <button name="add" type="submit" class="btn btn-primary w-100 fw-bold">INDEX CATEGORY</button>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>
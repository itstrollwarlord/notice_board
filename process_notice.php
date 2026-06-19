<?php
session_start();
include "db.php";

// Only allow logged-in admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // IMPORTANT: Matching 'description' from your form name attribute
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? ''); // Changed from 'content' to 'description'
    $category_id = $_POST['category_id'] ?? null;

    // Server-side Validation
    if (empty($title) || empty($description) || empty($category_id)) {
        echo "<script>alert('All fields are required!'); window.location='add_notice.php';</script>";
        exit();
    }

    // Prevent SQL injection
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $category_id = intval($category_id);

    // Insert query (Ensure your column name in DB is 'description')
    $sql = "INSERT INTO notices (title, description, category_id, created_at) 
            VALUES ('$title', '$description', $category_id, NOW())";

    if (mysqli_query($conn, $sql)) {
        header("Location: admin_dashboard.php?status=broadcasted");
        exit();
    } else {
        echo "Protocol Error: " . mysqli_error($conn);
    }

} else {
    header("Location: admin_dashboard.php");
    exit();
}
?>
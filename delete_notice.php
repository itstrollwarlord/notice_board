<?php
include "db.php";
include "navbar.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM notices WHERE id=$id");

header("Location: admin_dashboard.php");
?>
<?php
session_start();
include "db.php";
include "header.php";
include "navbar.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

if (isset($_POST['update'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);

    mysqli_query($conn,
    "UPDATE notices 
     SET title='$title', description='$desc' 
     WHERE id=$id");

    header("Location: admin_dashboard.php");
    exit();
}

$data = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT * FROM notices WHERE id=$id")
);
?>

<div class="container d-flex justify-content-center align-items-center py-5">

    <div class="glass-form-container w-100" style="max-width: 700px;">

        <!-- HEADER -->
        <div class="text-center mb-5">

            <h2 class="fw-bold text-white"
                style="font-family: 'Syncopate', sans-serif; letter-spacing: 2px;">
                REVISE_NOTICE
            </h2>

            <p class="small opacity-75 mt-3"
               style="color: var(--sea-green-solid); letter-spacing: 3px;">
                MODIFYING RECORD #<?php echo $id; ?>
            </p>

        </div>

        <!-- FORM -->
        <form method="POST">

            <!-- TITLE -->
            <div class="mb-4">

                <label class="small text-uppercase mb-2 d-block"
                       style="color: var(--text-silver); letter-spacing: 2px;">
                    Notice Title
                </label>

                <input
                    type="text"
                    name="title"
                    class="form-control"
                    value="<?php echo htmlspecialchars($data['title']); ?>"
                    required
                >

            </div>

            <!-- DESCRIPTION -->
            <div class="mb-5">

                <label class="small text-uppercase mb-2 d-block"
                       style="color: var(--text-silver); letter-spacing: 2px;">
                    Content Body
                </label>

                <textarea
                    name="desc"
                    class="form-control"
                    rows="8"
                    placeholder="ENTER UPDATED CONTENT..."
                    required><?php echo htmlspecialchars($data['description']); ?></textarea>

            </div>

            <!-- BUTTONS -->
            <div class="d-grid gap-3">

                <button
                    type="submit"
                    name="update"
                    class="btn btn-primary py-3 fw-bold">
                    COMMIT CHANGES
                </button>

                <a href="admin_dashboard.php"
                   class="btn btn-outline-light py-3">
                    CANCEL REVISION
                </a>

            </div>

        </form>

    </div>

</div>

<?php include "footer.php"; ?>
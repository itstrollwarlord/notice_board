<?php
session_start();
include "db.php";
include "header.php";
include "navbar.php";

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = md5($_POST['password']); 
    // Force lowercase to match DB 'admin' or 'student'
    $selected_role = mysqli_real_escape_string($conn, strtolower(trim($_POST['role']))); 

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND role='$selected_role' LIMIT 1";
    $res = mysqli_query($conn, $sql);
    
    if($res && mysqli_num_rows($res) > 0) {
        $user = mysqli_fetch_assoc($res);
        $_SESSION['user'] = $user;
        
        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error_msg = "ACCESS DENIED: Credentials do not match the selected Node.";
    }
}
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 85vh;">
    <div class="ui-card w-100" style="max-width: 450px;">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-white mb-2" style="font-family: 'Syncopate', sans-serif;">ACCESS GATE</h2>
            <p class="tracking-widest small opacity-75" style="color: var(--sea-solid)">SECURE NODE AUTHENTICATION</p>
        </div>

        <?php if($error_msg): ?>
            <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger small text-center mb-4">
                <?php echo $error_msg; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <div class="mb-4">
                <label class="small text-uppercase mb-2 opacity-50 text-white">Identifier</label>
                <input type="email" name="email" class="form-control bg-dark border-secondary text-white" required>
            </div>

            <div class="mb-4">
                <label class="small text-uppercase mb-2 opacity-50 text-white">Secret Key</label>
                <input type="password" name="password" class="form-control bg-dark border-secondary text-white" required>
            </div>

            <div class="mb-5">
                <label class="small text-uppercase mb-2 opacity-50 text-white">Select Access Level</label>
                <div class="d-flex gap-2">
                    <div class="flex-fill">
                        <input type="radio" class="btn-check" name="role" id="adminNode" value="admin" checked>
                        <label class="btn btn-outline-info w-100 py-2 small fw-bold" for="adminNode">ADMIN </label>
                    </div>
                    <div class="flex-fill">
                        <input type="radio" class="btn-check" name="role" id="studentNode" value="student">
                        <label class="btn btn-outline-info w-100 py-2 small fw-bold" for="studentNode">STUDENT </label>
                    </div>
                </div>
            </div>

            <button type="submit" name="login" class="btn w-100 py-3" style="background: var(--sea-solid); color: #0f1216; font-weight: 700;">ENTER</button>
        </form>
    </div>
</div>
<?php include "footer.php"; ?>
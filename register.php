<?php
include "db.php";
include "navbar.php";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = "user";

    mysqli_query($conn, "INSERT INTO users(name,email,password,role)
    VALUES('$name','$email','$password','$role')");
    echo "Registered Successfully";
}
?>

<form method="POST">
    <input name="name" placeholder="Name"><br>
    <input name="email" placeholder="Email"><br>
    <input name="password" type="password"><br>
    <button name="register">Register</button>
</form>
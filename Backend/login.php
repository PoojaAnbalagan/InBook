<?php
include('../db.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // hash password to match database

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        echo "<h2>Welcome, $username!</h2>";
    } else {
        echo "<h3>Invalid username or password!</h3>";
    }
}
?>

<?php
include '../db.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // encrypt password

    // Check if username exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        echo "<h3>Username already taken!</h3>";
    } else {
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "<h3>Registration successful! <a href='login.html'>Login Now</a></h3>";
        } else {
            echo "<h3>Error: " . mysqli_error($conn) . "</h3>";
        }
    }
}
?>

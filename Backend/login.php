
<?php
include '../db.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location: ../Frontend/index.html");
        exit();
    } else {
        echo "<h3>Invalid username or password!</h3>";
    }
}
?>

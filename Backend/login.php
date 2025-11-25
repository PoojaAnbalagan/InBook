<?php
session_start();
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        header("Location: ../Frontend/Login/login.html?error=empty");
        exit();
    }
    
    // Check user
    $stmt = $conn->prepare("SELECT username, email, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            // Password correct - create session
            
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['last_activity'] = time();
            
            // Redirect to dashboard
            header("Location: ../Frontend/Dashboard.php");
            exit();
        } else {
            // Wrong password
            header("Location: ../Frontend/Login/login.html?error=wrong");
            exit();
        }
    } else {
        // User not found
        header("Location: ../Frontend/Login/login.html?error=notfound");
        exit();
    }
    
    // $stmt->close();
    // $conn->close();
} else {
    // Not a POST request
    header("Location: ../Frontend/Login/login.html");
    exit();
}
?>
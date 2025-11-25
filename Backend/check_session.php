<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // User is not logged in, redirect to login page
    header("Location: ../Frontend/Login/login.html");
    exit();
}

// Optional: Check if session is expired (e.g., after 2 hours of inactivity)
$session_timeout = 7200; // 2 hours in seconds

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
    // Session expired
    session_unset();
    session_destroy();
    header("Location: Login/login.html?error=session_expired");
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();
?>
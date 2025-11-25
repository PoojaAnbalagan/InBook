<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../Frontend/Login/login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $court_id = mysqli_real_escape_string($conn, $_POST['court_id']);
    $booking_date = mysqli_real_escape_string($conn, $_POST['booking_date']);
    $time_slot = mysqli_real_escape_string($conn, $_POST['time_slot']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    
    // Check if court is already booked for this slot using prepared statement
    $check = "SELECT * FROM bookings 
              WHERE court_id = ? 
              AND booking_date = ? 
              AND time_slot = ?
              AND status != 'cancelled'";
    
    $stmt = mysqli_prepare($conn, $check);
    mysqli_stmt_bind_param($stmt, "iss", $court_id, $booking_date, $time_slot);
    mysqli_stmt_execute($stmt);
    $check_result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($check_result) > 0) {
        mysqli_stmt_close($stmt);
        echo "<script>alert('This time slot is already booked!'); window.history.back();</script>";
    } else {
        mysqli_stmt_close($stmt);
        
        // Insert booking using prepared statement
        $sql = "INSERT INTO bookings (username, court_id, booking_date, time_slot, price, status, created_at) 
                VALUES (?, ?, ?, ?, ?, 'confirmed', NOW())";
        
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sissd", $username, $court_id, $booking_date, $time_slot, $price);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            echo "<script>alert('Court booked successfully!'); window.location.href='../Frontend/my-bookings.php';</script>";
        } else {
            mysqli_stmt_close($stmt);
            echo "<script>alert('Booking failed: " . mysqli_error($conn) . "'); window.history.back();</script>";
        }
    }
}
?>
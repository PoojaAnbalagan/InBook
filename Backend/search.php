<?php
session_start();
include '../db.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set header for JSON response
header('Content-Type: application/json');

// Check authentication
if (!isset($_SESSION['username'])) {
    echo json_encode(['error' => 'Not authenticated']);
    exit();
}

// Get and sanitize inputs
$location = mysqli_real_escape_string($conn, $_GET['location'] ?? '');
$sport = mysqli_real_escape_string($conn, $_GET['sport'] ?? '');
$date = mysqli_real_escape_string($conn, $_GET['date'] ?? '');
$time_slot = mysqli_real_escape_string($conn, $_GET['time'] ?? '');

// Validate required fields
if (empty($location) || empty($sport) || empty($date) || empty($time_slot)) {
    echo json_encode(['error' => 'Missing required fields']);
    exit();
}

// Search available courts with proper JOIN
$sql = "SELECT c.*, 
        CASE 
            WHEN b.id IS NULL THEN 'available'
            ELSE 'unavailable'
        END as availability
        FROM courts c
        LEFT JOIN bookings b ON c.id = b.court_id 
            AND b.booking_date = ? 
            AND b.time_slot = ?
            AND b.status != 'cancelled'
        WHERE c.location = ? 
        AND c.sport = ?
        ORDER BY c.name";

// Use prepared statement to prevent SQL injection
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    echo json_encode(['error' => 'Database error: ' . mysqli_error($conn)]);
    exit();
}

mysqli_stmt_bind_param($stmt, "ssss", $date, $time_slot, $location, $sport);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$courts = [];
while($row = mysqli_fetch_assoc($result)) {
    $courts[] = $row;
}

mysqli_stmt_close($stmt);

// Return results
if (empty($courts)) {
    echo json_encode(['message' => 'No courts found matching your criteria', 'courts' => []]);
} else {
    echo json_encode(['success' => true, 'courts' => $courts]);
}
?>
<?php
session_start();
include "config.php"; // Include your database connection

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Insert logout activity log into the database
    $username = $_SESSION['username'];
    $logout_time = date('Y-m-d H:i:s');
    $activity_description = "User logged out at " . $logout_time;

    $insert_log = "INSERT INTO activity_log (username, activity_type, activity_description) 
                   VALUES ('$username', 'Logout', '$activity_description')";
    mysqli_query($conn, $insert_log);

    // Destroy the session
    session_destroy();
}

// Redirect to login page after logout
header("Location: login.php");
exit();
?>
